<?php

namespace App\Http\Controllers;

use App\Models\Leadcall;
use Illuminate\Http\Request;

class LeadcallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Leadcall::first();

        return view('admin.leadcall.index', compact('data'));
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
        $data = Leadcall::first();

        if (!$data) {
            $data = new Leadcall;
        }

        $data->no_tlp = preg_replace('/^0/', '+62', $request->no_tlp);
        $data->no_wa = preg_replace('/^0/', '+62', $request->no_wa);

        $data->tlp_button_text = $request->tlp_button_text;
        $data->wa_button_text = $request->wa_button_text;

        $data->tlp_color = $request->tlp_color;
        $data->wa_color = $request->wa_color;

        $data->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Leadcall $leadcall)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leadcall $leadcall)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leadcall $leadcall)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leadcall $leadcall)
    {
        //
    }
}
