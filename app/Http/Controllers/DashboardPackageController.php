<?php

namespace App\Http\Controllers;

use App\Models\PackageMakeUp;
use Illuminate\Http\Request;

class DashboardPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paketMakeup = PackageMakeUp::latest()->paginate(10);
        return view('admin.package.index', compact('paketMakeup'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paketMakeup = PackageMakeUp::all();
        return view('admin.package.create', compact('paketMakeup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // Validate input
         $validatedData = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Save the profile photo to a specified directory
        $filename = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('images/package'), $filename);

        // Create a new Package MakeUp
        $paketMakeup = PackageMakeUp::create([
            'nama_paket' => $validatedData['nama_paket'],
            'deskripsi' => $validatedData['deskripsi'],
            'harga' => $validatedData['harga'],
            'photo' => $filename,
        ]);

        return redirect('/dashboard-package')->with('pesan', 'Package MakeUp added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paketMakeup = PackageMakeup::with('details')->find($id); // Mengambil paket beserta details

        if (!$paketMakeup) {
            return redirect('/dashboard-package')->with('error', 'Paket tidak ditemukan');
        }
        return view('admin.package.details_package.index', compact('paketMakeup'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paketMakeup = PackageMakeUp::findOrFail($id);
        return view('admin.package.edit', compact('paketMakeup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input
        $validatedData = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $paketMakeup = PackageMakeUp::findOrFail($id);

         // Jika ada gambar baru di-upload, hapus gambar lama dan upload gambar baru
         if ($request->hasFile('photo')) {
            // Hapus file gambar lama jika ada
            if ($paketMakeup->photo && file_exists(public_path('images/package/' . $paketMakeup->photo))) {
                unlink(public_path('images/package/' . $paketMakeup->photo));
            }

            // Upload gambar baru
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images/package'), $filename);

            // Perbarui nama file gambar dalam database
            $paketMakeup->photo = $filename;
        }

        // Perbarui data lainnya
        $paketMakeup->nama_paket = $validatedData['nama_paket'];
        $paketMakeup->deskripsi = $validatedData['deskripsi'];
        $paketMakeup->harga = $validatedData['harga'];

        // Simpan perubahan ke database
        $paketMakeup->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect('/dashboard-package')->with('pesan', 'Package MakeUp updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Cari Paket berdasarkan ID
         $paketMakeup = PackageMakeUp::findOrFail($id);

         // Jika ada foto, hapus file foto tersebut dari direktori
         if ($paketMakeup->photo && file_exists(public_path('images/package/' . $paketMakeup->photo))) {
             // Hapus foto dari folder
             unlink(public_path('images/package/' . $paketMakeup->photo));
         }

         // Hapus data Paket dari database
         $paketMakeup->delete();

         // Redirect kembali ke halaman profil dengan pesan sukses
         return redirect('/dashboard-package')->with('pesan', 'Package Delete Successfully.');
    }
}
