<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleBannerController;
use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleGalleryController;
use App\Http\Controllers\ArticleGeneratedController;
use App\Http\Controllers\ArticleShowController;
use App\Http\Controllers\ArticleShowGalleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PhoneNumberController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\SourceCodeController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
use App\Models\ArticleCategory;
use App\Models\portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('daily_schedule')->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');
    Route::get('/page/{page?}', [PageController::class, 'home'])->name('pagearticle');
    
    Route::get('/desain', function(Request $request) {
        return app(PageController::class)->article($request, null, null, null);
    })->name('allarticle');
    Route::get('/desain/page/{page?}', function(Request $request) {
        return app(PageController::class)->article($request, null, null, null);
    })->name('pageallarticle');
    
    Route::get('/pembuat/{username}', [PageController::class, 'article'])->name('author');
    Route::get('/pemmbuat/{username}/page/{page?}', [PageController::class, 'article'])->name('pageauthor');
    
    Route::get('/tipe-desain/{category}', function(Request $request, $category) {
        return app(PageController::class)->article($request, null, $category, null);
    })->name('category');
    Route::get('/tipe-desain/{category}/page/{page?}', function(Request $request, $category) {
        return app(PageController::class)->article($request, null, $category, null);
    })->name('pagecategory');
    
    Route::get('/tag/{tag}', function(Request $request, $tag) {
        return app(PageController::class)->article($request, null, null, $tag);
    })->name('tag');
    Route::get('/tag/{tag}/page/{page?}', function(Request $request, $tag) {
        return app(PageController::class)->article($request, null, null, $tag);
    })->name('pagetag');

    Route::get('/kategori', [PageController::class, 'category'])->name('allcategory');

    // Route::get('/price-list', [PageController::class, 'priceList'])->name('price.list');

    Route::get('/Kontak', [PageController::class, 'contact'])->name('contact');

    Route::get('/portofolio', [PageController::class, 'portfolio'])->name('guestportfolio');

    Route::get('/page-not-found', [PageController::class, 'notFound'])->name('not.found');
});

Route::get('/sitemap', [SitemapController::class, 'index'])->name('sitemap');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('/admin/user', UserController::class);

    Route::resource('/admin/template', TemplateController::class);
    Route::put('/admin/template/edit-image/{id}', [TemplateController::class, 'editimage'])->name('template.editimage');

    Route::resource('/admin/phone-number', PhoneNumberController::class);

    Route::resource('/admin/article', ArticleController::class);
    Route::get('/admin/article-spin/{id}', [ArticleController::class, 'spin'])->name('article.spin');
    Route::get('/admin/article/shuffle-image/{id}', [ArticleController::class, 'shuffle'])->name('shuffle.image');
    Route::get('/admin/article/status/{status}/category/{filtercat}', [ArticleController::class, 'index'])->name('article.filter');

    Route::get('/admin/article-spintax', [ArticleController::class, 'indexspintax'])->name('article.spintax');
    Route::get('/admin/article-spintax/status/{status}/category/{filtercat}', [ArticleController::class, 'indexspintax'])->name('article.spintax.filter');

    Route::get('/admin/article-unique', [ArticleController::class, 'indexunique'])->name('article.unique');
    Route::get('/admin/article-unique/status/{status}/category/{filtercat}', [ArticleController::class, 'indexunique'])->name('article.unique.filter');

    Route::resource('/admin/category', ArticleCategoryController::class);
    Route::delete('/admin/category/destroy/all', [ArticleCategoryController::class, 'destroyAll'])->name('category.destroy.all');

    Route::resource('/admin/portfolio', PortfolioController::class);

    Route::resource('/admin/article-banner', ArticleBannerController::class);
    Route::resource('/admin/article-gallery', ArticleGalleryController::class);
    Route::resource('/admin/source-code', SourceCodeController::class);
    Route::post('/admin/article/generate/{id}', [ArticleController::class, 'generatearticle'])->name('article.generate');
    Route::delete('/admin/article/generate/{id}', [ArticleController::class, 'generatearticledestroy'])->name('article.generate.destroy');

    Route::resource('/admin/article-show', ArticleShowController::class);
    Route::resource('/admin/article-show-gallery', ArticleShowGalleryController::class);

    Route::resource('/admin/article-generated', ArticleGeneratedController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/test', [PageController::class, 'test'])->name('testing');

require __DIR__.'/auth.php';

Route::get('/{slug}', [PageController::class, 'business'])->name('business');
Route::get('/{a}/{i}', function () { return redirect()->route('not.found'); });
Route::get('/{a}/{i}/{u}', function () { return redirect()->route('not.found'); });
Route::get('/{a}/{i}/{e}/{o}', function () { return redirect()->route('not.found'); });
