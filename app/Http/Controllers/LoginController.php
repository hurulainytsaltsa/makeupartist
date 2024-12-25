<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function index()
    {
        return view('layouts.login');
    }

    /**
     * Proses autentikasi user.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek autentikasi
        if (Auth::attempt($credentials)) {
            // Regenerasi session
            $request->session()->regenerate();

            // Arahkan berdasarkan nilai isAdmin
            if (Auth::user()->isAdmin) {
                return redirect()->intended('/dashboard'); // Admin
            } else {
                return redirect()->intended('/home'); // Non-admin
            }
        }

        // Jika gagal, kembali ke halaman login dengan error
        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->onlyInput('email');
    }

    /**
     * Logout user dari session.
     */
    public function logout(Request $request): RedirectResponse
    {
        // Logout user
        Auth::logout();

        // Invalidasi session
        $request->session()->invalidate();

        // Regenerasi token session
        $request->session()->regenerateToken();

        // Redirect ke halaman /ourprofile atau halaman login
        return redirect('/login');
    }

    public function logoutAdmin(Request $request)
    {
        Auth::logout(); // Logout user

        // Invalidasi session
        $request->session()->invalidate();

        // Regenerasi token untuk keamanan
        $request->session()->regenerateToken();

        // Redirect ke halaman login
        return redirect('/login')->with('success', 'Anda berhasil logout.');
    }
}
