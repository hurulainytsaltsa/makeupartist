<?php

namespace App\Http\Controllers;

use App\Models\PackageMakeUp;
use Illuminate\Http\Request;

class PackageMakeUpController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  menampilkan daftar paket makeup pada halaman customer
    public function index()
    {
        $paketMakeup = PackageMakeUp::all();
        return view('layouts.package.index', compact('paketMakeup'));
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

    //  menampilkan detail daftar paket makeup pada halaman customer
    public function show(string $id)
    {
        $paketMakeup = PackageMakeup::with('details')->find($id); // Mengambil paket beserta details

        if (!$paketMakeup) {
            return redirect('/package')->with('error', 'Paket tidak ditemukan');

        }
        return view('layouts.package.details.index', compact('paketMakeup'));
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
