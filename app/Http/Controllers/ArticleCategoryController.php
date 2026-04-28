<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleShow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ArticleCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $data = ArticleCategory::where('url', 'like', '%' . $request->search . '%')->simplePaginate(20);
        } else {
            $data = ArticleCategory::simplePaginate(20);
        }

        $data->transform(function ($data) {
            $data->catalogcount = $data->articles->whereIn('article_type', Article::catalogTypes())->count();
            return $data;
        });

        if ($request->ajax()) {
            return view('admin.category.row', compact('data'))->render();
        }

        return view('admin.category.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|unique:'.ArticleCategory::class,
        ]);

        $articleCategory = new ArticleCategory();

        $articleCategory->category = $request->category;
        $articleCategory->slug = Str::slug($articleCategory->category);

        $articleCategory->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleCategory $articleCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => [
                'required',
                Rule::unique('article_categories')->ignore($id),
            ],
        ]);

        $articleCategory = ArticleCategory::find($id);

        $articleCategory->category = $request->category;
        $articleCategory->slug = Str::slug($articleCategory->category);

        $articleCategory->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $articleCategory = ArticleCategory::find($id);

        $articleCategory->delete();

        return redirect()->back();
    }
    
    public function destroyAll()
    {
        ArticleCategory::doesntHave('articles')->delete();

        return redirect()->back()->with('success', 'Category tanpa artikel berhasil dihapus');
    }
}
