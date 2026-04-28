<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleBanner;
use App\Models\ArticleCategory;
use App\Models\ArticleGallery;
use App\Models\ArticleShow;
use App\Models\ArticleShowGallery;
use App\Models\ArticleTag;
use App\Models\PhoneNumber;
use App\Models\SourceCode;
use App\Services\Ai\GeminiArticleGenerator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ArticlePageController extends Controller
{
    public function index(Request $request, $status = null, $filtercat = null)
    {
        $category = ArticleCategory::all();
        $filter = $status === 'schedule' ? 1 : 0;

        $data = Article::with('articleshow')
            ->whereIn('article_type', [Article::TYPE_ARTICLE_UNIQUE, Article::TYPE_ARTICLE_SPINTAX])
            ->when($filtercat && $filtercat !== 'all', function ($query) use ($filtercat) {
                $query->whereHas('articlecategory', function ($q) use ($filtercat) {
                    $q->where('category_id', $filtercat);
                });
            })
            ->when($request->search, function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->when($status !== 'all' && $status, function ($query) use ($status, $filter) {
                $query->where('schedule', $filter);
                if ($status === 'private') {
                    $query->whereHas('articleshow', function ($q) {
                        $q->where('status', 'private');
                    });
                } else {
                    $query->whereDoesntHave('articleshow', function ($q) {
                        $q->where('status', 'private');
                    });
                }

                return $query;
            })
            ->latest()
            ->simplePaginate(20);

        if ($request->ajax()) {
            return view('admin.article-page.row', compact('data'))->render();
        }

        return view('admin.article-page.index', compact('data', 'category', 'status', 'filtercat'));
    }

    public function create(Request $request)
    {
        $type = $request->get('type', 'unique');
        $tag = ArticleTag::all();
        $category = ArticleCategory::all();
        $first = PhoneNumber::orderBy('id')->first();
        $phonenumber = $first
            ? PhoneNumber::where('id', '!=', $first->id)->get()
            : collect();

        if ($type === 'spintax') {
            return view('admin.article-page.create-spintax', compact('tag', 'category'));
        }

        return view('admin.article-page.create-unique', compact('tag', 'phonenumber', 'category'));
    }

    public function aiSettings()
    {
        $sourceCodes = SourceCode::orderBy('title')->get();

        return view('admin.article-page.ai-settings', compact('sourceCodes'));
    }

    public function handleAiSettings(Request $request)
    {
        $validated = $request->validate([
            'tema' => 'required|string|max:255',
            'article_type' => 'required|in:unique,spintax',
            'action_type' => 'required|in:instant,review',
            'source_code_barang' => 'nullable|required_if:article_type,spintax|exists:source_codes,id',
            'source_code_lokasi' => 'nullable|required_if:article_type,spintax|exists:source_codes,id',
        ]);

        if (
            $validated['article_type'] === 'spintax'
            && ($validated['source_code_barang'] ?? null) === ($validated['source_code_lokasi'] ?? null)
        ) {
            throw ValidationException::withMessages([
                'source_code_lokasi' => 'Short code lokasi harus berbeda dari short code barang.',
            ]);
        }

        $selectedSourceCodes = $validated['article_type'] === 'spintax'
            ? [
                'barang' => SourceCode::findOrFail($validated['source_code_barang']),
                'lokasi' => SourceCode::findOrFail($validated['source_code_lokasi']),
            ]
            : [];

        try {
            $generated = app(GeminiArticleGenerator::class)->generate(
                $validated['tema'],
                $validated['article_type'],
                $selectedSourceCodes
            );
        } catch (\Throwable $e) {
            Log::warning('Gemini article generation failed', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->route('article-page.ai-settings')
                ->withInput($request->only('tema', 'article_type'))
                ->withErrors([
                    'gemini' => $e->getMessage(),
                ]);
        }

        if ($validated['action_type'] === 'review') {
            return redirect()
                ->route('article-page.create', [
                    'type' => $validated['article_type'],
                    'from_ai_settings' => 1,
                    'tema' => $validated['tema'],
                ])
                ->withInput($this->buildGeneratedOldInput($generated))
                ->with('success', 'Draft artikel berhasil dibuat dari Gemini. Silakan cek dulu sebelum simpan.');
        }

        return $this->storeGeneratedArticle($generated);
    }

    public function store(Request $request)
    {
        return $this->isSpintaxRequest($request)
            ? $this->storeSpintax($request)
            : $this->storeUnique($request);
    }

    public function show(Article $article)
    {
        $tagid = $article->articletag->pluck('id')->toArray();
        $tag = ArticleTag::whereNotIn('id', $tagid)->get();
        $categoryid = $article->articlecategory->pluck('id')->toArray();
        $category = ArticleCategory::whereNotIn('id', $categoryid)->get();

        if ($article->article_type === Article::TYPE_ARTICLE_SPINTAX) {
            return view('admin.article-page.edit-spintax', compact('article', 'tag', 'category'));
        }

        $this->ensureArticleUniqueType($article);
        $articleShow = $article->articleshow()->firstOrFail();
        $first = PhoneNumber::orderBy('id')->first();
        $phonenumber = $first
            ? PhoneNumber::where('id', '!=', $first->id)->where('id', '!=', $articleShow->phone_number_id)->get()
            : collect();

        return view('admin.article-page.edit-unique', compact('article', 'articleShow', 'tag', 'phonenumber', 'category'));
    }

    public function update(Request $request, Article $article)
    {
        return $article->article_type === Article::TYPE_ARTICLE_SPINTAX
            ? $this->updateSpintax($request, $article)
            : $this->updateUnique($request, $article);
    }

    public function destroy(Article $article)
    {
        foreach ($article->articlebanner as $item) {
            $path = public_path('storage/images/article/banner/' . $item->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        foreach ($article->articlegallery as $item) {
            $path = public_path('storage/images/article/gallery/' . $item->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $article->delete();

        return redirect()->back();
    }

    public function spin($id, Request $request)
    {
        $article = Article::where('article_type', Article::TYPE_ARTICLE_SPINTAX)->findOrFail($id);

        $count = new \stdClass();
        $count->all = ArticleShow::where('article_id', $id)->count();
        $count->schedule = ArticleShow::where('article_id', $id)->where('status', 'schedule')->count();
        $count->publish = ArticleShow::where('article_id', $id)->where('status', 'publish')->count();
        $count->private = ArticleShow::where('article_id', $id)->where('status', 'private')->count();

        $data = ArticleShow::where('article_id', $id)
            ->when($request->search, function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->search . '%');
            })
            ->paginate(10);

        return view('admin.article-page.index-spin', compact('article', 'data', 'count'));
    }

    public function shuffle($id)
    {
        $article = Article::where('article_type', Article::TYPE_ARTICLE_SPINTAX)->findOrFail($id);
        $articleshow = $article->articleshow;

        foreach ($articleshow as $item) {
            ArticleShowGallery::where('article_show_id', $item->id)->delete();

            $item->banner = $article->articlebanner->isNotEmpty()
                ? $article->articlebanner->random()->image
                : null;

            $galleries = $article->articlegallery->shuffle()->take(6);
            foreach ($galleries as $gallery) {
                $showGallery = new ArticleShowGallery;
                $showGallery->article_show_id = $item->id;
                $showGallery->article_gallery_id = $gallery->id;
                $showGallery->image = $gallery->image;
                $showGallery->image_alt = $gallery->image_alt;
                $showGallery->save();
            }

            $item->save();
        }

        return redirect()->back();
    }

    public function generatearticle($id, Request $request)
    {
        $article = Article::where('article_type', Article::TYPE_ARTICLE_SPINTAX)->findOrFail($id);

        $hasScheduleStatus = $article->articleshow()->where('status', 'schedule')->exists();
        $article->schedule = $hasScheduleStatus ? true : $request->schedule;
        $article->save();

        $total = (int) $request->total;
        $maxAttempts = 1000;
        $attempts = 0;
        $savedCount = 0;

        while ($savedCount < $total && $attempts < $maxAttempts) {
            $spinnedTitle = $this->spinText($article->judul);
            $spinnedBody = $this->spinText($article->article);
            $combinedText = $spinnedTitle . ' ' . $spinnedBody;

            preg_match_all('/\[[^\]]+\]/', $combinedText, $matches);
            $tags = array_unique($matches[0] ?? []);

            foreach ($tags as $tag) {
                $source = SourceCode::where('title', $tag)->first();
                if ($source) {
                    $options = array_map('trim', explode(',', $source->content));
                    $replacement = $options[array_rand($options)];
                    $spinnedTitle = str_replace($tag, $replacement, $spinnedTitle);
                    $spinnedBody = str_replace($tag, $replacement, $spinnedBody);
                }
            }

            $spinnedBody = str_replace('[pa_judul]', $spinnedTitle, $spinnedBody);

            $isDuplicate = ArticleShow::where('judul', $spinnedTitle)
                ->orWhere('article', $spinnedBody)
                ->exists();

            if (!$isDuplicate) {
                $newArticleShow = new ArticleShow;
                $newArticleShow->article_id = $article->id;
                $newArticleShow->judul = $spinnedTitle;
                $newArticleShow->slug = ArticleShow::buildSlug($newArticleShow->judul, $article->article_type);
                $newArticleShow->article = $spinnedBody;
                $newArticleShow->banner = $article->articlebanner->isNotEmpty() ? $article->articlebanner->random()->image : null;
                $newArticleShow->status = $request->schedule == true ? 'schedule' : 'publish';
                $newArticleShow->save();

                $galleries = $article->articlegallery->shuffle()->take(6);
                foreach ($galleries as $gallery) {
                    $showGallery = new ArticleShowGallery;
                    $showGallery->article_show_id = $newArticleShow->id;
                    $showGallery->article_gallery_id = $gallery->id;
                    $showGallery->image = $gallery->image;
                    $showGallery->image_alt = $gallery->image_alt;
                    $showGallery->save();
                }

                $savedCount++;
            }

            $attempts++;
        }

        return redirect()->back()->with('status', "$savedCount artikel berhasil dibuat.");
    }

    public function generatearticledestroy($id, Request $request)
    {
        $ids = ArticleShow::where('article_id', $id)
            ->orderBy('created_at', 'asc')
            ->limit($request->total)
            ->pluck('id');

        ArticleShow::whereIn('id', $ids)->delete();

        return redirect()->back();
    }

    private function storeUnique(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required|max:255',
                'category' => 'array',
                'tag' => 'array',
                'article' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->redirectWithFormError($request, $e);
        }

        $this->ensureUniqueArticleShowSlug($request->judul, Article::TYPE_ARTICLE_UNIQUE);

        $newarticle = new Article;
        $newarticle->user_id = Auth::id();
        $newarticle->judul = $request->judul;
        $newarticle->price = $request->price;
        $newarticle->article = $request->article;
        $newarticle->article_type = Article::TYPE_ARTICLE_UNIQUE;
        $newarticle->link_domain = $request->domain;
        $newarticle->schedule = $request->status === 'schedule';
        $this->fillVideoLink($newarticle, $request->link);
        $newarticle->save();

        $newbanner = $this->storeSingleBanner($request, $newarticle->id);
        $this->syncTags($newarticle, $request->tag);
        $this->syncCategories($newarticle, $request->category);
        $this->storeGallery($request, $newarticle->id);

        $newarticleshow = new ArticleShow;
        $this->fillPhoneNumber($newarticleshow, $request->no_tlp);
        $newarticleshow->article_id = $newarticle->id;
        $newarticleshow->banner = $newbanner?->image;
        $newarticleshow->judul = $newarticle->judul;
        $newarticleshow->slug = ArticleShow::buildSlug($newarticleshow->judul, $newarticle->article_type);
        $newarticleshow->article = $newarticle->article;
        $newarticleshow->status = $request->status;
        $newarticleshow->telephone = $request->tlp;
        $newarticleshow->whatsapp = $request->wa;

        if ($request->status === 'schedule') {
            $newarticleshow->created_at = $request->release;
        }

        $newarticleshow->save();

        foreach (ArticleGallery::where('article_id', $newarticle->id)->get() as $item) {
            $newgalleryshow = new ArticleShowGallery;
            $newgalleryshow->article_show_id = $newarticleshow->id;
            $newgalleryshow->article_gallery_id = $item->id;
            $newgalleryshow->image = $item->image;
            $newgalleryshow->image_alt = $item->image_alt;
            $newgalleryshow->save();
        }

        return redirect()->route('article-page.index')->with('success', 'Artikel berhasil disimpan.');
    }

    private function storeSpintax(Request $request)
    {
        try {
            $request->validate([
                'judul' => 'required',
                'category' => 'array',
                'tag' => 'array',
                'article' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->redirectWithFormError($request, $e);
        }

        $newarticle = new Article;
        $newarticle->user_id = Auth::id();
        $newarticle->judul = $request->judul;
        $newarticle->article = $request->article;
        $newarticle->article_type = Article::TYPE_ARTICLE_SPINTAX;
        $this->fillVideoLink($newarticle, $request->link);
        $newarticle->save();

        $this->storeMultipleBanners($request, $newarticle->id);
        $this->syncTags($newarticle, $request->tag);
        $this->syncCategories($newarticle, $request->category);
        $this->storeGallery($request, $newarticle->id);

        return redirect()->route('article-page.index')->with('success', 'Artikel berhasil disimpan.');
    }

    private function updateUnique(Request $request, Article $article)
    {
        $this->ensureArticleUniqueType($article);
        $articleShow = $article->articleshow()->firstOrFail();

        try {
            $request->validate([
                'judul' => [
                    'required',
                    'max:255',
                ],
                'category' => 'array',
                'tag' => 'array',
                'article' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->redirectWithFormError($request, $e);
        }

        $this->ensureUniqueArticleShowSlug($request->judul, $article->article_type, $articleShow->id);

        $article->judul = $request->judul;
        $article->price = $request->price;
        $article->article = $request->article;
        $article->link_domain = $request->domain;
        $article->schedule = $request->status === 'schedule';
        $this->fillVideoLink($article, $request->link);
        $article->save();

        $banner = $this->updateBanner($request, $articleShow, $article);
        $this->syncTags($article, $request->tag, true);
        $this->syncCategories($article, $request->category, true);
        $this->fillPhoneNumber($articleShow, $request->no_tlp);

        if ($banner) {
            $articleShow->banner = $banner->image;
        }

        $articleShow->judul = $article->judul;
        $articleShow->slug = ArticleShow::buildSlug($articleShow->judul, $article->article_type);
        $articleShow->article = $article->article;
        $articleShow->telephone = $request->tlp;
        $articleShow->whatsapp = $request->wa;

        if ($request->status === 'schedule') {
            $articleShow->created_at = $request->release;
        } elseif ($articleShow->status === 'schedule') {
            $articleShow->created_at = now();
        }

        $articleShow->status = $request->status;
        $articleShow->save();

        return redirect()->back()->with('success', 'Artikel berhasil diperbarui.');
    }

    private function updateSpintax(Request $request, Article $article)
    {
        $this->ensureArticleSpintaxType($article);

        try {
            $request->validate([
                'judul' => [
                    'required',
                ],
                'category' => 'array',
                'tag' => 'array',
                'article' => 'required',
            ]);
        } catch (ValidationException $e) {
            return $this->redirectWithFormError($request, $e);
        }

        $article->judul = $request->judul;
        $article->article = $request->article;
        $this->fillVideoLink($article, $request->link);
        $article->save();

        $this->syncTags($article, $request->tag, true);
        $this->syncCategories($article, $request->category, true);

        return redirect()->back()->with('success', 'Artikel berhasil diperbarui.');
    }

    private function formatCount($number)
    {
        if ($number >= 1000) {
            return round($number / 1000, 1) . 'k';
        }

        return (string) $number;
    }

    private function spinText($text)
    {
        while (preg_match('/\{([^{}]*)\}/', $text)) {
            $text = preg_replace_callback('/\{([^{}]*)\}/', function ($matches) {
                $options = explode('|', $matches[1]);
                return $options[array_rand($options)];
            }, $text);
        }

        return $text;
    }

    private function fillVideoLink(Article $article, ?string $link): void
    {
        $link = $link ?? '';

        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $link, $matches)) {
            $videoId = $matches[1];
            $article->video_type = 'youtube';
            $article->youtube = "https://www.youtube.com/embed/{$videoId}";
            $article->tiktok = null;
        } elseif (preg_match('/(?:www\.)?tiktok\.com\/(@[\w.-]+)\/video\/(\d+)/', $link, $matches)) {
            $article->video_type = 'tiktok';
            $article->youtube = null;
            $article->tiktok = "https://www.tiktok.com/{$matches[0]}";
        } else {
            $article->video_type = 'none';
            $article->youtube = null;
            $article->tiktok = null;
        }
    }

    private function fillPhoneNumber(ArticleShow $articleShow, ?string $phone): void
    {
        if (!$phone) {
            $articleShow->phone_number_id = null;
            return;
        }

        if (substr($phone, 0, 1) === '0') {
            $phone = '+62' . substr($phone, 1);
        }

        $phoneNumber = PhoneNumber::firstOrCreate([
            'no_tlp' => $phone,
            'type' => 'article',
        ]);

        $articleShow->phone_number_id = $phoneNumber->id;
    }

    private function syncTags(Article $article, ?array $tags, bool $sync = false): void
    {
        if (!$tags) {
            if ($sync) {
                $article->articletag()->sync([]);
            }
            return;
        }

        $tagIds = [];
        foreach (array_map(fn($item) => ucfirst($item), $tags) as $tagName) {
            $formattedTagName = Str::title($tagName);
            $slug = Str::slug($tagName);
            $tag = ArticleTag::firstOrCreate(['slug' => $slug], ['tag' => $formattedTagName]);
            $tagIds[] = $tag->id;
        }

        $sync ? $article->articletag()->sync($tagIds) : $article->articletag()->attach($tagIds);
    }

    private function syncCategories(Article $article, ?array $categories, bool $sync = false): void
    {
        if (!$categories) {
            if ($sync) {
                $article->articlecategory()->sync([]);
            }
            return;
        }

        $categoryIds = [];
        foreach (array_map(fn($item) => ucfirst($item), $categories) as $categoryName) {
            $formattedCategoryName = Str::title($categoryName);
            $slug = Str::slug($categoryName);
            $category = ArticleCategory::firstOrCreate(['slug' => $slug], ['category' => $formattedCategoryName]);
            $categoryIds[] = $category->id;
        }

        $sync ? $article->articlecategory()->sync($categoryIds) : $article->articlecategory()->attach($categoryIds);
    }

    private function storeSingleBanner(Request $request, int $articleId): ?ArticleBanner
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $newbanner = new ArticleBanner;
        $newbanner->article_id = $articleId;

        $imageFile = $request->file('image');
        $imageName = time();
        $imagePath = public_path('storage/images/article/banner/');

        if (!File::exists($imagePath)) {
            File::makeDirectory($imagePath, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($imageFile->getPathname());
        $image->save($imagePath . $imageName . '.webp');

        $newbanner->image = $imageName . '.webp';
        $newbanner->image_alt = $imageName;
        $newbanner->save();

        return $newbanner;
    }

    private function storeMultipleBanners(Request $request, int $articleId): void
    {
        if (!$request->has('image_banner') || empty($request->image_banner)) {
            return;
        }

        foreach ($request->image_banner as $image) {
            $newbanner = new ArticleBanner;
            $newbanner->article_id = $articleId;

            if ($image instanceof \Illuminate\Http\UploadedFile && $image->isValid()) {
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $currentDate = now()->format('YmdHis');
                $imageName = $originalName . '_' . $currentDate;
                $imagePath = public_path('storage/images/article/banner/');

                if (!File::exists($imagePath)) {
                    File::makeDirectory($imagePath, 0755, true);
                }

                $manager = new ImageManager(new Driver());
                $imageOptimized = $manager->read($image->getPathname());
                $imageOptimized->save($imagePath . $imageName . '.webp');

                $newbanner->image = $imageName . '.webp';
                $newbanner->image_alt = $imageName;
            }

            $newbanner->save();
        }
    }

    private function updateBanner(Request $request, ArticleShow $articleShow, Article $article): ?ArticleBanner
    {
        if (!$request->hasFile('image')) {
            return null;
        }

        $banner = ArticleBanner::where('article_id', $articleShow->article_id)->first();
        if ($banner) {
            $path = public_path('storage/images/article/banner/' . $banner->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $imageFile = $request->file('image');
        $imageName = time();
        $imagePath = public_path('storage/images/article/banner/');

        if (!File::exists($imagePath)) {
            File::makeDirectory($imagePath, 0755, true);
        }

        $manager = new ImageManager(new Driver());
        $image = $manager->read($imageFile->getPathname());
        $image->save($imagePath . $imageName . '.webp');

        if (!$banner) {
            $banner = new ArticleBanner();
            $banner->article_id = $article->id;
        }

        $banner->image = $imageName . '.webp';
        $banner->image_alt = $imageName;
        $banner->save();

        return $banner;
    }

    private function storeGallery(Request $request, int $articleId): void
    {
        if (!$request->has('image_gallery') || empty($request->image_gallery)) {
            return;
        }

        foreach ($request->image_gallery as $image) {
            $newgallery = new ArticleGallery;
            $newgallery->article_id = $articleId;

            if ($image instanceof \Illuminate\Http\UploadedFile && $image->isValid()) {
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $currentDate = now()->format('YmdHis');
                $imageName = $originalName . '_' . $currentDate;
                $imagePath = public_path('storage/images/article/gallery/');

                if (!File::exists($imagePath)) {
                    File::makeDirectory($imagePath, 0755, true);
                }

                $manager = new ImageManager(new Driver());
                $imageOptimized = $manager->read($image->getPathname());
                $imageOptimized->save($imagePath . $imageName . '.webp');

                $newgallery->image = $imageName . '.webp';
                $newgallery->image_alt = $imageName;
            }

            $newgallery->save();
        }
    }

    private function redirectWithFormError(Request $request, ValidationException $e)
    {
        Session::forget('_old_input');

        $oldInput = $request->except(['_token', 'image']);
        if ($request->has('category')) {
            $oldInput['category'] = collect($request->category)
                ->map(fn($item) => (object) ['category' => $item])
                ->pipe(fn($collection) => new \Illuminate\Database\Eloquent\Collection($collection->all()));
        }
        if ($request->has('tag')) {
            $oldInput['tag'] = collect($request->tag)
                ->map(fn($item) => (object) ['tag' => $item])
                ->pipe(fn($collection) => new \Illuminate\Database\Eloquent\Collection($collection->all()));
        }

        Session::flashInput($oldInput);

        return redirect()->back()->withErrors($e->validator);
    }

    private function ensureArticleUniqueType(Article $article): void
    {
        abort_unless($article->article_type === Article::TYPE_ARTICLE_UNIQUE, 404);
    }

    private function ensureArticleSpintaxType(Article $article): void
    {
        abort_unless($article->article_type === Article::TYPE_ARTICLE_SPINTAX, 404);
    }

    private function isSpintaxRequest(Request $request): bool
    {
        return $request->input('type') === 'spintax';
    }

    private function buildGeneratedOldInput(array $generated): array
    {
        return [
            'judul' => $generated['judul'],
            'article' => $generated['article'],
            'price' => $generated['price'] ?? 0,
            'category' => $this->makeNamedCollection($generated['category'] ?? [], 'category'),
            'tag' => $this->makeNamedCollection($generated['tag'] ?? [], 'tag'),
            'type' => $generated['type'] ?? 'unique',
        ];
    }

    private function makeNamedCollection(array $items, string $key): Collection
    {
        return new Collection(
            collect($items)
                ->map(fn ($item) => (object) [$key => $item])
                ->all()
        );
    }

    private function storeGeneratedArticle(array $generated)
    {
        return ($generated['type'] ?? 'unique') === 'spintax'
            ? $this->storeGeneratedSpintax($generated)
            : $this->storeGeneratedUnique($generated);
    }

    private function storeGeneratedUnique(array $generated)
    {
        $this->ensureUniqueArticleShowSlug($generated['judul'], Article::TYPE_ARTICLE_UNIQUE);

        $newarticle = new Article;
        $newarticle->user_id = Auth::id();
        $newarticle->judul = $generated['judul'];
        $newarticle->price = (int) ($generated['price'] ?? 0);
        $newarticle->article = $generated['article'];
        $newarticle->article_type = Article::TYPE_ARTICLE_UNIQUE;
        $newarticle->link_domain = null;
        $newarticle->schedule = false;
        $newarticle->video_type = 'none';
        $newarticle->youtube = null;
        $newarticle->tiktok = null;
        $newarticle->save();

        $this->syncTags($newarticle, $generated['tag'] ?? []);
        $this->syncCategories($newarticle, $generated['category'] ?? []);

        $newarticleshow = new ArticleShow;
        $newarticleshow->article_id = $newarticle->id;
        $newarticleshow->banner = null;
        $newarticleshow->judul = $newarticle->judul;
        $newarticleshow->slug = ArticleShow::buildSlug($newarticleshow->judul, $newarticle->article_type);
        $newarticleshow->article = $newarticle->article;
        $newarticleshow->template_id = null;
        $newarticleshow->status = 'private';
        $newarticleshow->telephone = true;
        $newarticleshow->whatsapp = true;
        $newarticleshow->save();

        return redirect()
            ->route('article-page.show', ['article' => $newarticle->id])
            ->with('success', 'Artikel AI berhasil dibuat sebagai draft private.');
    }

    private function storeGeneratedSpintax(array $generated)
    {
        $newarticle = new Article;
        $newarticle->user_id = Auth::id();
        $newarticle->judul = $generated['judul'];
        $newarticle->price = 0;
        $newarticle->article = $generated['article'];
        $newarticle->article_type = Article::TYPE_ARTICLE_SPINTAX;
        $newarticle->schedule = false;
        $newarticle->video_type = 'none';
        $newarticle->youtube = null;
        $newarticle->tiktok = null;
        $newarticle->save();

        $this->syncTags($newarticle, $generated['tag'] ?? []);
        $this->syncCategories($newarticle, $generated['category'] ?? []);

        return redirect()
            ->route('article-page.show', ['article' => $newarticle->id])
            ->with('success', 'Artikel spintax dari AI berhasil dibuat. Silakan lanjutkan pengecekan di halaman edit.');
    }

    private function ensureUniqueArticleShowSlug(string $title, string $articleType, ?int $ignoreId = null): void
    {
        $slug = ArticleShow::buildSlug($title, $articleType);

        $exists = ArticleShow::where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'judul' => 'Judul ini menghasilkan URL yang sudah dipakai.',
            ]);
        }
    }
}
