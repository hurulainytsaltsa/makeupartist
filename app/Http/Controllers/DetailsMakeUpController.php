<?php

namespace App\Http\Controllers;

use App\Models\DetailsMakeUp;
use Illuminate\Http\Request;

class DetailsMakeUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  Menampilkan semua detail paket makeup.
    public function index()
    {
        $details = DetailsMakeUp::all();
        return view('layouts.package.details.index', compact('details'));
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
        //
    }

    /**
     * Display the specified resource.
     */

    //   Menampilkan detail paket berdasarkan ID package_makeup.
    public function show(string $id)
    {
        // Mengambil data berdasarkan package_makeup_id yang sesuai
        $details = DetailsMakeUp::where('package_makeup_id', $id)->get();
        // Kirim data ke view
        return view('layouts.package.details.index', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
