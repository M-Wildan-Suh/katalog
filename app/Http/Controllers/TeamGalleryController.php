<?php

namespace App\Http\Controllers;

use App\Models\TeamGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class TeamGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = TeamGallery::all();

        return view('admin.gallery.index',compact('data'));
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
        if ($request->has('image') && !empty($request->image)) {
            foreach ($request->image as $image) {
                $newgallery = new TeamGallery();
        
                // Pastikan image adalah instance dari UploadedFile
                if ($image instanceof \Illuminate\Http\UploadedFile && $image->isValid()) {
                    // Ambil nama file tanpa ekstensi
                    $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    
                    // Tambahkan tanggal saat ini
                    $currentDate = now()->format('YmdHis');
                    
                    // Gabungkan nama file dan tanggal input
                    $imageName = $originalName . '_' . $currentDate;
        
                    $imagePath = public_path('storage/images/gallery/');

                    if (!File::exists($imagePath)) {
                        File::makeDirectory($imagePath, 0755, true);
                    }
        
                    $manager = new ImageManager(new Driver());
                    $imageOptimized = $manager->read($image->getPathname());
                    $imageFullPath = $imagePath . $imageName . '.webp';
                    $imageOptimized->save($imageFullPath);
        
                    // Simpan nama file dengan ekstensi .webp
                    $newgallery->image = $imageName . '.webp';
                }
        
                $newgallery->save();
            }
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(TeamGallery $teamGallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TeamGallery $teamGallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $teamGallery = TeamGallery::find($id);

        if ($request->hasFile('image')) {
            if ($teamGallery->image) {
                $path = public_path('storage/images/gallery/' . $teamGallery->image);
    
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            
            $imageFile = $request->file('image');
            $imageName = time();
            $imagePath = public_path('storage/images/gallery/');

            // Pastikan direktori ada, jika tidak maka buat
            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($imageFile->getPathname());

            $imageFullPath = $imagePath . $imageName . '.webp';
            $image->save($imageFullPath);

            $teamGallery->image = $imageName . '.webp';
        }

        $teamGallery->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teamGallery = TeamGallery::find($id);

        if ($teamGallery->image) {
            $path = public_path('storage/images/gallery/' . $teamGallery->image);

            if (file_exists($path)) {
                unlink($path);
            }
        }

        $teamGallery->delete();

        return redirect()->back();
    }

    public function destroyAll(Request $request) 
    {
        $Ids = explode(',', $request->order_id);

        $gallery = TeamGallery::whereIn('id', $Ids)->get();
        
        foreach ($gallery as $item) {
            if ($item->image) {
                $path = public_path('storage/images/gallery/' . $item->image);

                if (file_exists($path)) {
                    unlink($path);
                }
            }

            $item->delete();
        }

        return redirect()->back();
        // dd($request);
    }
}
