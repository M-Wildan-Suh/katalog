<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use App\Models\ArticleShow;
use App\Models\ArticleTag;
use App\Models\Banner;
use App\Models\Leadcall;
use App\Models\Package;
use App\Models\PhoneNumber;
use App\Models\Portfolio;
use App\Models\TeamGallery;
use App\Models\Template;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class PageController extends Controller
{
    public function home(Request $request)
    {
        Paginator::currentPageResolver(function () use ($request) {
            return $request->route('page', 1); // default ke halaman 1
        });
        $data = ArticleShow::where('status', 'publish')
            ->latest()->simplePaginate(6);

        $category = ArticleCategory::all();

        $usedImages = [];

        $category->each(function ($cat) use (&$usedImages) {
            // cari artikel yang punya banner unik
            $article = $cat->articles->first(function ($article) use (&$usedImages) {
                $banner = $article->articlebanner->first();
                if ($banner && !in_array($banner->id, $usedImages)) {
                    $usedImages[] = $banner->id;
                    return true;
                }
                return false;
            });

            // simpan ke attribute tambahan
            $cat->thumbnail = $article && $article->articlebanner->first()
                ? $article->articlebanner->first()->image
                : null;
        });

        $data->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            $data->articles->articletag;
            $data->articles->user;
            return $data;
        });

        $hp = PhoneNumber::first()->no_tlp;

        $leadcall = Leadcall::first();

        $trend = ArticleShow::orderBy('view', 'desc')
            ->where('status', 'publish')
            ->take(6)->get();

        $banner = Banner::first();

        return view('guest.home', compact('data', 'banner', 'trend', 'category', 'hp', 'leadcall'));
    }

    public function article(Request $request, $username = null, $category = null, $tag = null)
    {
        if ($username) {
            $data = ArticleShow::whereHas('articles.user', function ($query) use ($username) {
                $query->where('slug', $username);
            })
                ->where('status', 'publish')->latest()->simplePaginate(12);

            $user = User::where('slug', $username)->first();
            $title = 'Penulis : ' . $user->name;
        } elseif ($category) {
            $data = ArticleShow::whereHas('articles.articleCategory', function ($query) use ($category) {
                $query->where('slug', $category);
            })
                ->where('status', 'publish')->latest()->simplePaginate(12);

            $category = ArticleCategory::where('slug', $category)->first()->category;
            $title = 'Kategori : ' . $category;
        } elseif ($tag) {
            $data = ArticleShow::whereHas('articles.articleTag', function ($query) use ($tag) {
                $query->where('slug', $tag);
            })
                ->where('status', 'publish')->latest()->simplePaginate(12);

            $tag = ArticleTag::where('slug', $tag)->first()->tag;
            $title = 'Tag : ' . $tag;
        } elseif ($request->search) {
            $data = ArticleShow::where('status', 'publish')
                ->where(function ($query) use ($request) {
                    $query->where('judul', 'like', '%' . $request->search . '%')
                        ->orWhereHas('articles.articleCategory', function ($q) use ($request) {
                            $q->where('category', 'like', '%' . $request->search . '%');
                        })
                        ->orWhereHas('articles.articleTag', function ($q) use ($request) {
                            $q->where('tag', 'like', '%' . $request->search . '%');
                        });
                })
                ->latest()
                ->simplePaginate(12);

            $title = 'Pencarian : ' . $request->search;
        } else {
            $data = ArticleShow::where('status', 'publish')
                ->latest()->simplePaginate(12);

            $title = 'Desain Tipe Simpel';
        }

        $data->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            $data->articles->articletag;
            $data->articles->user;
            return $data;
        });

        if ($request->ajax()) {
            return view('components.guest.product', compact('data'))->render();
        }

        $hp = PhoneNumber::first()->no_tlp;

        $leadcall = Leadcall::first();

        $category = ArticleCategory::all();

        return view('guest.article', compact('data', 'title', 'category', 'hp', 'leadcall'));
    }

    public function category()
    {
        $category = ArticleCategory::orderBy('category', 'asc')->get();


        $catsection = ArticleCategory::withCount('articles')
            ->having('articles_count', '>=', 4)
            ->take(6)
            ->get();

        $catsection->transform(function ($cat) {
            // Ambil semua ArticleShow dari setiap artikel di kategori
            $cat->articles = ArticleShow::whereHas('articles.articleCategory', function ($query) use ($cat) {
                $query->where('slug', $cat->slug);
            })
                ->where('status', 'publish')->latest()->paginate(12);

            $cat->articles->transform(function ($data) {
                $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
                $data->articles->articletag;
                $data->articles->user;
                return $data;
            });

            return $cat;
        });

        $hp = PhoneNumber::first()->no_tlp;

        $leadcall = Leadcall::first();

        return view('guest.category', compact('category', 'catsection', 'hp', 'leadcall'));
    }

    public function business($slug)
    {
        $data = ArticleShow::where('slug', $slug)
            ->with('articles.articleCategory')
            ->first();

        if (!$data) {
            return redirect()->route('not.found');
        }

        $categoryIds = $data->articles->articlecategory->pluck('id');
        $totalCategories = $categoryIds->count();

        // Query gabungan
        $related = ArticleShow::where('article_shows.id', '!=', $data->id)
            ->where('article_shows.status', 'publish')
            ->withCount(['articles as match_count' => function ($query) use ($categoryIds) {
                $query->whereHas('articleCategory', function ($q) use ($categoryIds) {
                    $q->whereIn('article_categories.id', $categoryIds);
                });
            }])
            ->orderByRaw("CASE WHEN match_count = ? THEN 1 ELSE 2 END", [$totalCategories])
            ->orderByDesc('match_count')
            ->take(2)
            ->get();

        $data->view = $data->view + 1;

        $data->save();

        $template = $data->template;

        // dd($data->articles->phoneNumber);
        if ($data->phoneNumber) {
            $data->no_tlp = $data->phoneNumber->no_tlp;
        } elseif ($data->articles->articlecategory->first()?->phonenumber) {
            $data->no_tlp = $data->articles->articlecategory->first()->phoneNumber->no_tlp;
        } else {
            $data->no_tlp = optional(PhoneNumber::first())->no_tlp;
        }

        $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
        // dd($data->articles);

        $hp = PhoneNumber::first()->no_tlp;

        $leadcall = Leadcall::first();

        $category = ArticleCategory::all();

        return view('guest.business', compact('data', 'related', 'template', 'category', 'hp', 'leadcall'));
    }

    public function contact()
    {
        $data = TeamGallery::all();

        $category = ArticleCategory::all();

        $hp = PhoneNumber::first()->no_tlp;

        $leadcall = Leadcall::first();

        return view('guest.contact', compact('category', 'hp', 'leadcall', 'data'));
    }

    public function priceList()
    {
        $category = ArticleCategory::all();

        $hp = PhoneNumber::first()->no_tlp;

        $leadcall = Leadcall::first();

        $plans = Package::with('packageitem')->get();

        $plans = $plans->map(function ($package) {
            // ubah video package (akses array-style biar aman dari warning)
            if (!empty($package['video'])) {
                $package['video'] = convertToEmbed($package['video']);
            }

            // ubah video di setiap packageitem
            if ($package->relationLoaded('packageitem')) {
                $package->packageitem->transform(function ($item) {
                    if (!empty($item['video'])) {
                        $item['video'] = convertToEmbed($item['video']);
                    }
                    return $item;
                });
            }

            return $package;
        });


        return view('guest.price-list', compact('category', 'hp', 'leadcall', 'plans'));
    }

    public function portfolio(Request $request)
    {
        $data = Portfolio::latest()->simplePaginate(12);

        if ($request->ajax()) {
            return view('components.guest.portfolio', compact('data'))->render();
        }

        $category = ArticleCategory::all();

        $hp = PhoneNumber::first()->no_tlp;

        $leadcall = Leadcall::first();

        return view('guest.portfolio', compact('category', 'hp', 'leadcall', 'data'));
    }

    public function notFound()
    {
        $category = ArticleCategory::all();

        $hp = PhoneNumber::first()->no_tlp;

        $leadcall = Leadcall::first();

        return response()->view('guest.pagenotfound', compact('category', 'hp', 'leadcall'), 404);
    }

    public function test()
    {
        $duplikatJudul = ArticleShow::select('judul')
            ->groupBy('judul')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('judul');

        if ($duplikatJudul->isEmpty()) {
            return response()->json([
                'status' => 'ok',
                'message' => 'Tidak ada judul yang duplikat.',
                'data' => []
            ]);
        }

        return response()->json([
            'status' => 'duplikat',
            'message' => 'Ditemukan judul yang duplikat.',
            'data' => $duplikatJudul
        ]);
    }
}

if (!function_exists('convertToEmbed')) {
    function convertToEmbed($url)
    {
        if (empty($url)) return null;

        // Format: https://youtu.be/{id}
        if (preg_match('/youtu\.be\/([^\?]+)/', $url, $matches)) {
            $id = $matches[1];
        }
        // Format: https://www.youtube.com/watch?v={id}
        elseif (preg_match('/v=([^\&]+)/', $url, $matches)) {
            $id = $matches[1];
        }
        // Format: https://youtube.com/shorts/{id}
        elseif (preg_match('/shorts\/([^\?]+)/', $url, $matches)) {
            $id = $matches[1];
        } else {
            return $url; // bukan link YouTube yang dikenal
        }

        return "https://www.youtube.com/embed/" . $id;
    }
}