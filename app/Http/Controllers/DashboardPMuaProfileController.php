<?php

namespace App\Http\Controllers;

use App\Models\MuaProfile;
use Illuminate\Http\Request;

class DashboardPMuaProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  menampilkan daftar profile MUA
    public function index()
    {
        // Ambil semua profil MUA dari database
        $mua_profiles = MuaProfile::latest()->paginate(10);

        // Kirim data ke view
        //return view('layouts.profil');
        return view('admin.profile.index', compact('mua_profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */

     //  menampilkan form untuk menambahkan profile MUA baru.
    public function create()
    {
        $mua_profiles = MuaProfile::all();
        return view('admin.profile.create', compact('mua_profiles'));
    }

    /**
     * Store a newly created resource in storage.
     */

    //  menyimpan data profiles MUA yang baru di database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_mua' => 'required|string|max:255',
            'pengalaman' => 'required',
            'lokasi' => 'required|string|max:255',
            'portfolio_link' => 'required|url',
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $filename = time() . '.' . $request->profile_photo->extension();
        $request->profile_photo->move(public_path('images/profile_photos'), $filename);

        $muaProfile = MuaProfile::create([
            'nama_mua' => $validatedData['nama_mua'],
            'pengalaman' => $validatedData['pengalaman'],
            'lokasi' => $validatedData['lokasi'],
            'portfolio_link' => $validatedData['portfolio_link'],
            'profile_photo' => $filename,
        ]);

        return redirect('/dashboard-profile')->with('pesan', 'MUA added successfully.');
    }

    /**
     * Display the specified resource.
     */

    //  menampilkan detail profiles MUA berdasarkan ID
    public function show(string $id)
    {
        $mua = MuaProfile::findOrFail($id);
        return view('admin.profile.show', compact('mua'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    //  menampilkan form untuk update profiles MUA berdasarkan ID
    public function edit(string $id)
    {
        $mua = MuaProfile::findOrFail($id);
        return view('admin.profile.edit', compact('mua'));
    }

    /**
     * Update the specified resource in storage.
     */

    //  menyimpan perubahan data pada database
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama_mua' => 'required|string|max:255',
            'pengalaman' => 'required',
            'lokasi' => 'required|string|max:255',
            'portfolio_link' => 'required|url',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mua = MuaProfile::findOrFail($id);

        if ($request->hasFile('profile_photo')) {
            if ($mua->profile_photo && file_exists(public_path('images/profile_photos/' . $mua->profile_photo))) {
                unlink(public_path('images/profile_photos/' . $mua->profile_photo));
            }

            $filename = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->move(public_path('images/profile_photos'), $filename);

            $mua->profile_photo = $filename;
        }

        $mua->nama_mua = $validatedData['nama_mua'];
        $mua->pengalaman = $validatedData['pengalaman'];
        $mua->lokasi = $validatedData['lokasi'];
        $mua->portfolio_link = $validatedData['portfolio_link'];

        $mua->save();

        return redirect('/dashboard-profile')->with('pesan', 'MUA profile updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    //  menghapus data profiles berdasarkan ID
    public function destroy(string $id)
    {
        $mua = MuaProfile::findOrFail($id);

        if ($mua->profile_photo && file_exists(public_path('images/profile_photos/' . $mua->profile_photo))) {
            unlink(public_path('images/profile_photos/' . $mua->profile_photo));
        }

        $mua->delete();
        return redirect('/dashboard-profile')->with('pesan', 'Data sudah berhasil dihapus');
    }

}
