<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $portofolio = Portofolio::all();
        return view('layouts.portofolio.create_portofolio', compact('portofolio'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_mua' => 'required|string|max:255',
            'review' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Save the profile photo to a specified directory
        $filename = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('images/gambar'), $filename);

        // Create a new MUA profile
        $portofolio = Portofolio::create([
            'nama_mua' => $validatedData['nama_mua'],
            'review' => $validatedData['review'],
            'gambar' => $filename,
        ]);

        return redirect('/portofolio')->with('success', 'Portofolio added successfully.');
    }

    /**
     * Display the specified resource.
     */
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
        $portofolio = Portofolio::findOrFail($id);
        return view('layouts.portofolio.update_portofolio', compact('portofolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         // Validasi input dari form
         $validatedData = $request->validate([
            'nama_mua' => 'required|string|max:255',
            'review' => 'required',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opsional jika tidak ada perubahan
        ]);

        // Cari profil MUA berdasarkan ID
        $portofolio = Portofolio::findOrFail($id);

        // Jika ada gambar baru di-upload, hapus gambar lama dan upload gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus file gambar lama jika ada
            if ($portofolio->gambar && file_exists(public_path('images/gambar/' . $portofolio->gambar))) {
                unlink(public_path('images/gambar/' . $portofolio->gambar));
            }

            // Upload gambar baru
            $filename = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/gambar'), $filename);

            // Perbarui nama file gambar dalam database
            $portofolio->gambar = $filename;
        }

        // Perbarui data lainnya
        $portofolio->nama_mua = $validatedData['nama_mua'];
        $portofolio->review = $validatedData['review'];

        // Simpan perubahan ke database
        $portofolio->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect('/portofolio')->with('success', 'MUA portfolio updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portofolio = Portofolio::findOrFail($id);

        // Jika ada foto profil, hapus file foto tersebut dari direktori
        if ($portofolio->gambar && file_exists(public_path('images/gambar/' . $portofolio->gambar))) {
            // Hapus foto dari folder
            unlink(public_path('images/gambar/' . $portofolio->gambar));
        }

        // Hapus data MUA dari database
        $portofolio->delete();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect('/portofolio')->with('pesan', 'Data sudah berhasil dihapus');
    }
}
