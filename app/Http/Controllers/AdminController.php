<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\ArticleShow;
use App\Models\SourceCode;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    private function formatCount($number)
    {
        if ($number >= 1000) {
            return round($number / 1000, 1) . 'k'; // contoh: 1500 → 1.5k
        }
        return (string) $number;
    }

    public function dashboard() {
        $sc = $this->formatCount(SourceCode::all()->count());
        $spintax = $this->formatCount(Article::where('article_type', Article::TYPE_SPINTAX)->count());
        $spin = $this->formatCount(ArticleShow::whereHas('articles', function ($query) {
            $query->where('article_type', Article::TYPE_SPINTAX);
        })->count());

        $catalog = $this->formatCount(Article::catalog()->count());

        return view('dashboard', compact('sc', 'spintax', 'spin', 'catalog'));
    }
}
