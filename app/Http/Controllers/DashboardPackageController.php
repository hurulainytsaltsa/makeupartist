<?php

namespace App\Http\Controllers;

use App\Models\PackageMakeUp;
use Illuminate\Http\Request;

class DashboardPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  menampilkan daftar paket makeup
    public function index()
    {
        $paketMakeup = PackageMakeUp::latest()->paginate(10);
        return view('admin.package.index', compact('paketMakeup'));
    }

    /**
     * Show the form for creating a new resource.
     */

    //  menampilkan form untuk menambahkan paket makeup baru
    public function create()
    {
        $paketMakeup = PackageMakeUp::all();
        return view('admin.package.create', compact('paketMakeup'));
    }

    /**
     * Store a newly created resource in storage.
     */

    //  menyimpan data baru ke database
    public function store(Request $request)
    {

         $validatedData = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        $filename = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('images/package'), $filename);


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

    //  menampilkan detail paket makeup berdasarkan id
    public function show(string $id)
    {
        $paketMakeup = PackageMakeup::with('details')->find($id);

        if (!$paketMakeup) {
            return redirect('/dashboard-package')->with('error', 'Paket tidak ditemukan');
        }
        return view('admin.package.details_package.index', compact('paketMakeup'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    //  menampilkan form edit untuk data paket makeup berdasarkan id
    public function edit(string $id)
    {
        $paketMakeup = PackageMakeUp::findOrFail($id);
        return view('admin.package.edit', compact('paketMakeup'));
    }

    /**
     * Update the specified resource in storage.
     */

    //  memperbaru data yang diupdate di database
    public function update(Request $request, string $id)
    {

        $validatedData = $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $paketMakeup = PackageMakeUp::findOrFail($id);


         if ($request->hasFile('photo')) {

            if ($paketMakeup->photo && file_exists(public_path('images/package/' . $paketMakeup->photo))) {
                unlink(public_path('images/package/' . $paketMakeup->photo));
            }


            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images/package'), $filename);


            $paketMakeup->photo = $filename;
        }


        $paketMakeup->nama_paket = $validatedData['nama_paket'];
        $paketMakeup->deskripsi = $validatedData['deskripsi'];
        $paketMakeup->harga = $validatedData['harga'];


        $paketMakeup->save();
        return redirect('/dashboard-package')->with('pesan', 'Package MakeUp updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */

    //  menghapus data paket makeup berdasarkan id
    public function destroy(string $id)
    {

         $paketMakeup = PackageMakeUp::findOrFail($id);


         if ($paketMakeup->photo && file_exists(public_path('images/package/' . $paketMakeup->photo))) {
             unlink(public_path('images/package/' . $paketMakeup->photo));
         }

         $paketMakeup->delete();

         return redirect('/dashboard-package')->with('pesan', 'Package Delete Successfully.');
    }
}
