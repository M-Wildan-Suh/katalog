<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::first();

        return view('admin.banner.index', compact('data'));
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
        // dd($request);

        $data = Banner::first();

        if (!$data) {
            $data = new Banner;
        }

        $data->title = $request->title;
        $data->subtitle = $request->subtitle;
        $data->description = $request->description;

        if ($request->hasFile('banner')) {
            if ($data->banner) {
                $path = public_path('storage/images/banner/' . $data->banner);
    
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $imageFile = $request->file('banner');
            $imageName = time();
            $imagePath = public_path('storage/images/banner/');

            // Pastikan direktori ada, jika tidak maka buat
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getPathname());

            $imageFullPath = $imagePath . $imageName . '.webp';
            $image->save($imageFullPath);

            $data->banner = $imageName . '.webp';
        }
        
        if ($request->hasFile('overlay')) {
            if ($data->overlay) {
                $path = public_path('storage/images/banner/' . $data->overlay);
    
                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $imageFile = $request->file('overlay');
            $imageName = time();
            $imagePath = public_path('storage/images/banner/');

            // Pastikan direktori ada, jika tidak maka buat
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getPathname());

            $imageFullPath = $imagePath . $imageName . '.webp';
            $image->save($imageFullPath);

            $data->overlay = $imageName . '.webp';
        }

        $data->save();
        
        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
