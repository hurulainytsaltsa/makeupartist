<?php

namespace App\Http\Controllers;

use App\Models\MuaProfile;
use Illuminate\Http\Request;

class MuaProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  menampilkan profile MUA di tampilan customer
    public function index()
    {
        // Ambil semua profil MUA dari database
        $mua_profiles = MuaProfile::all();

        return view('layouts.profile.profil', compact('mua_profiles'));
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
    public function show(string $id)
    {

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
