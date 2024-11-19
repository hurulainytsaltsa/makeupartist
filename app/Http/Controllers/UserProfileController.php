<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Mengembalikan data user ke view
        return view('layouts.UserProfile.UserProfile', compact('user'));


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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('layouts.UserProfile.updateProfileUser', compact('user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
        ]);

        // Cari profil MUA berdasarkan ID
        $user = User::findOrFail($id);

        // Jika ada gambar baru di-upload, hapus gambar lama dan upload gambar baru

        // Perbarui data lainnya
        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->alamat = $validatedData['alamat'];
        $user->no_telp = $validatedData['no_telp'];

        // Simpan perubahan ke database
        $user->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect('/account')->with('success', 'your profile updated successfully.');



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
