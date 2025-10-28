<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageItem;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Package::all();

        return view('admin.package.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.package.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);

        // dd($request);
        $data = new Package;

        $data->title = $request->title;
        $data->price = $request->price;
        $data->video = $request->video;

        $data->save();

        if ($request->listpackage) {
            foreach ($request->listpackage as $item) {
                $dataitem = new PackageItem;
    
                $dataitem->package_id = $data->id;
                $dataitem->title = $item['title'];
                $dataitem->video = $item['video'];
    
                $dataitem->save();
            }
        }

        return redirect()->route('package.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Package $package)
    {
        return view('admin.package.edit', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
        ]);
        
        $package->title = $request->title;
        $package->price = $request->price;
        $package->video = $request->video;
        $package->save();

        // Hapus semua item lama dulu (supaya tidak dobel)
        PackageItem::where('package_id', $package->id)->delete();

        if ($request->listpackage) {
            foreach ($request->listpackage as $item) {
                $dataitem = new PackageItem;
                $dataitem->package_id = $package->id;
                $dataitem->title = $item['title'];
                $dataitem->video = $item['video'];
                $dataitem->save();
            }
        }

        return redirect()->route('package.index')->with('success', 'Paket berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return redirect()->route('package.index')->with('success', 'Paket sudah dihapus');
    }
}
