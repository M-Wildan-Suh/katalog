<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use App\Models\ArticleShow;
use App\Models\ArticleTag;
use App\Models\User;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setLastModificationDate(now()))
            ->add(Url::create('/desain')->setLastModificationDate(now()));

        $perPage = 12;
        $totalArticles = ArticleShow::where('status', 'publish')->count();
        $totalPages = ceil($totalArticles / $perPage);

        for ($page = 1; $page <= $totalPages; $page++) {
            $sitemap->add(
                Url::create("/desain/page/{$page}")->setLastModificationDate(now())
            );
        }

        foreach (User::all() as $model) {
            $slug = $model->slug;
            $baseUrl = "/penulis/{$slug}";
            $lastMod = $model->updated_at;
        
            $sitemap->add(Url::create($baseUrl)->setLastModificationDate($lastMod));
        
            $articleIds = $model->articles()->pluck('id');
            $articleCount = ArticleShow::where('status', 'publish')
                ->whereIn('article_id', $articleIds)
                ->count();
            $pages = ceil($articleCount / $perPage);
        
            for ($page = 1; $page <= $pages; $page++) {
                $sitemap->add(Url::create("{$baseUrl}/page/{$page}")->setLastModificationDate($lastMod));
            }
        }
        
        foreach (ArticleCategory::all() as $model) {
            $slug = $model->slug;
            $baseUrl = "/kategori/{$slug}";
            $lastMod = $model->updated_at;
        
            $sitemap->add(Url::create($baseUrl)->setLastModificationDate($lastMod));
        
            $articleIds = $model->articles()->pluck('articles.id');
            $articleCount = ArticleShow::where('status', 'publish')
                ->whereIn('article_id', $articleIds)
                ->count();
            $pages = ceil($articleCount / $perPage);
        
            for ($page = 1; $page <= $pages; $page++) {
                $sitemap->add(Url::create("{$baseUrl}/page/{$page}")->setLastModificationDate($lastMod));
            }
        }
        
        foreach (ArticleTag::all() as $model) {
            $slug = $model->slug;
            $baseUrl = "/tag/{$slug}";
            $lastMod = $model->updated_at;
        
            $sitemap->add(Url::create($baseUrl)->setLastModificationDate($lastMod));
        
            $articleIds = $model->articles()->pluck('articles.id'); // penting: ambil id dari tabel articles
            $articleCount = ArticleShow::where('status', 'publish')
                ->whereIn('article_id', $articleIds)
                ->count();
            $pages = ceil($articleCount / $perPage);
        
            for ($page = 1; $page <= $pages; $page++) {
                $sitemap->add(Url::create("{$baseUrl}/page/{$page}")->setLastModificationDate($lastMod));
            }
        }

        foreach (ArticleShow::where('status', 'publish')->get() as $model ) {
            $sitemap->add(Url::create($model->public_path)->setLastModificationDate($model->updated_at));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
        // return response()->download(public_path('sitemap.xml'));
        return redirect('/sitemap.xml');
    }
}
