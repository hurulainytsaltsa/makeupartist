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

    //  Menampilkan halaman profil user.
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $user = Auth::user();
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

    //  Menampilkan form untuk mengedit profil user.
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('layouts.UserProfile.updateProfileUser', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */

    //  Memperbarui data profil user.
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'alamat' => 'required|string|max:255',
            'no_telp' => 'required|string|max:15',
        ]);

        $user = User::findOrFail($id);

        $user->name = $validatedData['name'];
        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];
        $user->alamat = $validatedData['alamat'];
        $user->no_telp = $validatedData['no_telp'];

        $user->save();

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
