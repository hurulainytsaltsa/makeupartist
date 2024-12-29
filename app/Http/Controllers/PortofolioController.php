<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

      //  menampilkan portofolio MUA pada halaman customer
    public function index()
    {
        $portofolio = Portofolio::all();
        return view('layouts.portofolio.portofolio', compact('portofolio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
     //  menampilkan detail portofolio MUA pada halaman customer
    public function show(string $id)
    {
        $portofolio = Portofolio::findOrFail($id);
        return view('layouts.portofolio.detail_portofolio', compact('portofolio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
