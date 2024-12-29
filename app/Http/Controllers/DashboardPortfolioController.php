<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;

class DashboardPortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  menampilkan daftar portofolio
    public function index()
    {
        $portofolio = Portofolio::latest()->paginate(10);
        return view('admin.portofolio.index', compact('portofolio'));
    }

    /**
     * Show the form for creating a new resource.
     */

    //  menampilkan form untuk menambahkan portofolio baru
    public function create()
    {
        $muaProfiles = \App\Models\MuaProfile::all();
        return view('admin.portofolio.create', compact('muaProfiles'));
    }
    /**
     * Store a newly created resource in storage.
     */

    //  menyimpan portofolio yang baru ditambah di database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_mua' => 'required|string|max:255',
            'review' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filename = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('images/gambar'), $filename);

        $portofolio = Portofolio::create([
            'nama_mua' => $validatedData['nama_mua'],
            'review' => $validatedData['review'],
            'gambar' => $filename,
        ]);

        return redirect('/dashboard-portfolio')->with('pesan', 'Portofolio added successfully.');
    }

    /**
     * Display the specified resource.
     */

    //  menampilkan detail portofolio
    public function show(string $id)
    {
        $portofolio = Portofolio::findOrFail($id);
        return view('admin.portofolio.show', compact('portofolio'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    //  menampilkan form edit untuk update portofolio berdasarkan ID
    public function edit(string $id)
    {
        $portofolio = Portofolio::findOrFail($id);
        $muaProfiles = \App\Models\MuaProfile::all();
        return view('admin.portofolio.edit', compact('portofolio', 'muaProfiles'));
    }

    /**
     * Update the specified resource in storage.
     */

    //  menyimpan perubahan pada portofolio di database
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_mua' => 'required|string|max:255',
            'review' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $portofolio = Portofolio::findOrFail($id);

        if ($request->hasFile('gambar')) {
            if ($portofolio->gambar && file_exists(public_path('images/gambar/' . $portofolio->gambar))) {
                unlink(public_path('images/gambar/' . $portofolio->gambar));
            }

            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/gambar'), $filename);
            $portofolio->gambar = $filename;
        }

        $portofolio->nama_mua = $validatedData['nama_mua'];
        $portofolio->review = $validatedData['review'];

        $portofolio->save();
        return redirect('/dashboard-portfolio')->with('success', 'MUA portfolio updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    //  menghapus portofolio berdasarkan id
    public function destroy(string $id)
    {
        $portofolio = Portofolio::findOrFail($id);
        if ($portofolio->gambar && file_exists(public_path('images/gambar/' . $portofolio->gambar))) {
            unlink(public_path('images/gambar/' . $portofolio->gambar));
        }

        $portofolio->delete();

        return redirect('/dashboard-portfolio')->with('pesan', 'Data sudah berhasil dihapus');
    }
}
