<?php

namespace App\Http\Controllers;

use App\Models\MuaProfile;
use Illuminate\Http\Request;

class MuaProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua profil MUA dari database
        $mua_profiles = MuaProfile::all();

        // Kirim data ke view
        //return view('layouts.profil');
        return view('layouts.profile.profil', compact('mua_profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mua_profiles = MuaProfile::all();
        return view('layouts.profile.create_profile', compact('mua_profiles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'pengalaman' => 'required',
            'lokasi' => 'required|string|max:255',
            'portfolio_link' => 'required|url', // Validate for portfolio link
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Save the profile photo to a specified directory
        $filename = time() . '.' . $request->profile_photo->extension();
        $request->profile_photo->move(public_path('images/profile_photos'), $filename);

        // Create a new MUA profile
        $muaProfile = MuaProfile::create([
            'nama' => $validatedData['nama'],
            'pengalaman' => $validatedData['pengalaman'],
            'lokasi' => $validatedData['lokasi'],
            'portfolio_link' => $validatedData['portfolio_link'],
            'profile_photo' => $filename,
        ]);

        return redirect('/ourprofile')->with('success', 'MUA added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mua = MuaProfile::findOrFail($id);
        return view('layouts.profile.detail_profile', compact('mua'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve a single MUA profile by its ID
        $mua = MuaProfile::findOrFail($id);

        return view('layouts.profile.update_profile', compact('mua'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input dari form
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'pengalaman' => 'required',
            'lokasi' => 'required|string|max:255',
            'portfolio_link' => 'required|url',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opsional jika tidak ada perubahan
        ]);

        // Cari profil MUA berdasarkan ID
        $mua = MuaProfile::findOrFail($id);

        // Jika ada gambar baru di-upload, hapus gambar lama dan upload gambar baru
        if ($request->hasFile('profile_photo')) {
            // Hapus file gambar lama jika ada
            if ($mua->profile_photo && file_exists(public_path('images/profile_photos/' . $mua->profile_photo))) {
                unlink(public_path('images/profile_photos/' . $mua->profile_photo));
            }

            // Upload gambar baru
            $filename = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->move(public_path('images/profile_photos'), $filename);

            // Perbarui nama file gambar dalam database
            $mua->profile_photo = $filename;
        }

        // Perbarui data lainnya
        $mua->nama = $validatedData['nama'];
        $mua->pengalaman = $validatedData['pengalaman'];
        $mua->lokasi = $validatedData['lokasi'];
        $mua->portfolio_link = $validatedData['portfolio_link'];

        // Simpan perubahan ke database
        $mua->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect('/ourprofile')->with('success', 'MUA profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari profil MUA berdasarkan ID
        $mua = MuaProfile::findOrFail($id);

        // Jika ada foto profil, hapus file foto tersebut dari direktori
        if ($mua->profile_photo && file_exists(public_path('images/profile_photos/' . $mua->profile_photo))) {
            // Hapus foto dari folder
            unlink(public_path('images/profile_photos/' . $mua->profile_photo));
        }

        // Hapus data MUA dari database
        $mua->delete();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect('/ourprofile')->with('pesan', 'Data sudah berhasil dihapus');
    }
}
