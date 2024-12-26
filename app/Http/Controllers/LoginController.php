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

    //  Menampilkan halaman login.
    public function index()
    {
        return view('layouts.login');
    }

    /**
     * Proses autentikasi user.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->isAdmin) {
                return redirect()->intended('/dashboard');
            } else {
                return redirect()->intended('/home');
            }
        }

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
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


    // Logout khusus untuk admin.
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
