<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
            $data = Portfolio::where('url', 'like', '%' . $request->search . '%')->simplePaginate(20);
        } else {
            $data = Portfolio::simplePaginate(20);
        }

        if ($request->ajax()) {
            return view('admin.portfolio.row', compact('data'))->render();
        }

        return view('admin.portfolio.index', compact('data'));
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
            'title' => 'required|max:255|unique:' . Portfolio::class,
        ]);

        // dd($request);

        $portfolio = new Portfolio;

        $portfolio->title = $request->title;
        $portfolio->url = $request->url;

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time();
            $imagePath = public_path('storage/images/portfolio/');

            // Pastikan direktori ada, jika tidak maka buat
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getPathname());

            $imageFullPath = $imagePath . $imageName . '.webp';
            $image->save($imageFullPath);

            $portfolio->image = $imageName . '.webp';
        }

        $portfolio->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, portfolio $portfolio)
    {
        $validator = Validator::make($request->all(), [
            'category' => [
                'required',
                'max:255',
                Rule::unique('article_categories')->ignore($portfolio->id),
            ],
        ]);

        $portfolio->title = $request->title;
        $portfolio->url = $request->url;

        if ($request->hasFile('image')) {
            if ($portfolio->image) {
                $path = public_path('storage/images/portfolio/' . $portfolio->image);
    
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            
            $imageFile = $request->file('image');
            $imageName = time();
            $imagePath = public_path('storage/images/portfolio/');

            // Pastikan direktori ada, jika tidak maka buat
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getPathname());

            $imageFullPath = $imagePath . $imageName . '.webp';
            $image->save($imageFullPath);

            $portfolio->image = $imageName . '.webp';
        }

        $portfolio->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(portfolio $portfolio)
    {
        if ($portfolio->image) {
            $path = public_path('storage/images/portfolio/' . $portfolio->image);

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $portfolio->delete();

        return redirect()->back();
    }
}
