<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('layouts.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::latest()->paginate(10);
        return view('layouts.register', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'name' => 'required|min:3',
        'username' => 'required|unique:users|min:3',
        'email' => 'required|email|unique:users',
        'alamat' => 'required|min:5',
        'no_telp' => 'required|numeric',
        'password' => 'required|min:4|confirmed',
    ]);

    // Simpan data ke database
    User::create([
        'name' => $validated['name'],
        'username' => $validated['username'],
        'email' => $validated['email'],
        'alamat' => $validated['alamat'],
        'no_telp' => $validated['no_telp'],
        'password' => Hash::make($validated['password']),
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
    ]);

    // Redirect dengan pesan sukses
    return redirect('/login')->with('pesan', 'Data sudah berhasil disimpan');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
