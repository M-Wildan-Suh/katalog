<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleShow;
use App\Models\ArticleTag;
use App\Models\GuardianWeb;
use App\Models\PhoneNumber;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class ArticleApiController extends Controller
{
    private function findWebByCode($code)
    {
        $web = GuardianWeb::where('code', $code)->first();

        if (!$web) {
            return response()->json([
                'success' => false,
                'message' => 'Kode tidak ditemukan.',
            ], 404);
        }

        return $web;
    }

    public function index(Request $request, $code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $articleIds = $web->articles->pluck('id');

        $perPage = 12;

        $articles = ArticleShow::whereIn('article_id', $articleIds)
            ->where('status', 'publish')
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->when($request->search, function ($query, $search) {
                return $query->where('judul', 'like', '%' . $search . '%');
            })
            ->latest()
            ->paginate($perPage);

        $trend = ArticleShow::whereIn('article_id', $articleIds)
            ->where('status', 'publish')
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->orderBy('view', 'desc')->take(6)->get();

        $articles->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            return $data;
        });
        
        $trend->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            return $data;
        });

        $categories = ArticleCategory::whereHas('articles', function ($query) use ($articleIds) {
            $query->whereIn('articles.id', $articleIds);
        })->get();

        return response()->json([
            'success' => true,
            'data' => $articles,
            'trend' => $trend,
            'categories' => $categories,
        ]);
    }

    public function indexUser(Request $request, $user, $code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $user = User::where('slug', $user)->first();

        $articleIds = $web->articles->pluck('id');

        $perPage = 12;

        $articles = ArticleShow::whereIn('article_id', $articleIds)
            ->where('status', 'publish')
            ->whereHas('articles.user', function ($query) use ($user) {
                $query->where('id', $user->id);
            })
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->latest()
            ->paginate($perPage);

        $articles->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            return $data;
        });
        
        $categories = ArticleCategory::whereHas('articles', function ($query) use ($articleIds) {
            $query->whereIn('articles.id', $articleIds);
        })->get();

        return response()->json([
            'success' => true,
            'data' => $articles,
            'user' => $user->name,
            'categories' => $categories
        ]);
    }

    public function indexCategory($category, $code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $category = ArticleCategory::where('slug', $category)->first();
    

        $articleIds = $web->articles->pluck('id');

        $perPage = 12;

        $articles = ArticleShow::whereIn('article_id', $articleIds)
            ->where('status', 'publish')
            ->whereHas('articles.articlecategory', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->latest()
            ->paginate($perPage);

        $articles->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            return $data;
        });
        
        $categories = ArticleCategory::whereHas('articles', function ($query) use ($articleIds) {
            $query->whereIn('articles.id', $articleIds);
        })->get();

        return response()->json([
            'success' => true,
            'data' => $articles,
            'category' => $category->category,
            'categories' => $categories,
        ]);
    }

    public function indexTag($tag, $code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $tag = ArticleTag::where('slug', $tag)->first();
    

        $articleIds = $web->articles->pluck('id');

        $perPage = 12;

        $articles = ArticleShow::whereIn('article_id', $articleIds)
            ->where('status', 'publish')
            ->whereHas('articles.articletag', function ($query) use ($tag) {
                $query->where('tag_id', $tag->id);
            })
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->latest()
            ->paginate($perPage);

        $articles->transform(function ($data) {
            $data->date = Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y');
            return $data;
        });

        $categories = ArticleCategory::whereHas('articles', function ($query) use ($articleIds) {
            $query->whereIn('articles.id', $articleIds);
        })->get();

        return response()->json([
            'success' => true,
            'data' => $articles,
            'tag' => $tag->tag,
            'categories' => $categories,
        ]);
    }

    public function landingPage($slug, $code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $articleIds = $web->articles->pluck('id');

        $articles = ArticleShow::whereIn('article_id', $articleIds)
            ->where('slug', $slug)
            ->where('status', 'publish')
            ->with(['articles.articletag', 'articles.articlecategory', 'articles.user', 'articleshowgallery', 'phoneNumber', 'template'])
            ->first();

        $articles->view = $articles->view + 1;

        $articles->save();

        if ($articles->phoneNumber) {
            $articles->no_tlp = $articles->phoneNumber->no_tlp;
        } elseif ($articles->articles->articlecategory->first()?->phonenumber) {
            $articles->no_tlp = $articles->articles->articlecategory->first()->phoneNumber->no_tlp;
        } else {
            $articles->no_tlp = optional(PhoneNumber::first())->no_tlp;
        }

        $categories = ArticleCategory::whereHas('articles', function ($query) use ($articleIds) {
            $query->whereIn('articles.id', $articleIds);
        })->get();

        if (!$articles) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan.',
            ], 404); // Bisa pakai 404 atau 200 tergantung standar kamu
        }
        
        return response()->json([
            'success' => true,
            'data' => $articles,
            'categories' => $categories,
        ]);
    }

    public function sitemap($code) {
        $web = $this->findWebByCode($code);

        if ($web instanceof \Illuminate\Http\JsonResponse) {
            return $web; // Return error jika tidak ditemukan
        }

        $articleIds = $web->articles->pluck('id');
        $perPage = 12;

        $pages = [];
    
        // Artikel Utama
        $totalArticles = ArticleShow::where('status', 'publish')
            ->whereIn('article_id', $articleIds)
            ->count();
            
        $totalPages = ceil($totalArticles / $perPage);
        for ($page = 1; $page <= $totalPages; $page++) {
            $pages[] = [
                'url' => "/artikel/page/{$page}",
                'updated_at' => now(),
            ];
        }
    
        // Penulis
        foreach (User::all() as $user) {
            $articleCount = ArticleShow::where('status', 'publish')
                ->whereIn('article_id', $user->articles()->pluck('id')->intersect($articleIds))
                ->count();
            if ($articleCount == 0) continue;
    
            $pages[] = [
                'url' => "/penulis/{$user->slug}",
                'updated_at' => $user->updated_at,
            ];
    
            $totalPages = ceil($articleCount / $perPage);
            for ($page = 1; $page <= $totalPages; $page++) {
                $pages[] = [
                    'url' => "/penulis/{$user->slug}/page/{$page}",
                    'updated_at' => $user->updated_at,
                ];
            }
        }
    
        // Kategori
        foreach (ArticleCategory::all() as $category) {
            $articleCount = ArticleShow::where('status', 'publish')
                ->whereIn('article_id', $category->articles()->pluck('articles.id')->intersect($articleIds))
                ->count();
            if ($articleCount == 0) continue;
    
            $pages[] = [
                'url' => "/kategori/{$category->slug}",
                'updated_at' => $category->updated_at,
            ];
    
            $totalPages = ceil($articleCount / $perPage);
            for ($page = 1; $page <= $totalPages; $page++) {
                $pages[] = [
                    'url' => "/kategori/{$category->slug}/page/{$page}",
                    'updated_at' => $category->updated_at,
                ];
            }
        }
    
        // Tag
        foreach (ArticleTag::all() as $tag) {
            $articleCount = ArticleShow::where('status', 'publish')
                ->whereIn('article_id', $tag->articles()->pluck('articles.id')->intersect($articleIds))
                ->count();
            if ($articleCount == 0) continue;
    
            $pages[] = [
                'url' => "/tag/{$tag->slug}",
                'updated_at' => $tag->updated_at,
            ];
    
            $totalPages = ceil($articleCount / $perPage);
            for ($page = 1; $page <= $totalPages; $page++) {
                $pages[] = [
                    'url' => "/tag/{$tag->slug}/page/{$page}",
                    'updated_at' => $tag->updated_at,
                ];
            }
        }

        $articles = ArticleShow::where('status', 'publish')
            ->whereIn('article_id', $articleIds)
            ->get();

        foreach ($articles as $item) {
            $pages[] = [
                'url' => "/{$item->slug}",
                'updated_at' => $item->updated_at,
            ];
        }
    
        return response()->json([
            'pages' => $pages
        ]);
    }
}
