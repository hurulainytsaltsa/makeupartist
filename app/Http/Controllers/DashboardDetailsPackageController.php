<?php

namespace App\Http\Controllers;

use App\Models\DetailsMakeUp;
use App\Models\PackageMakeUp;
use Illuminate\Http\Request;

class DashboardDetailsPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  Menampilkan daftar Detail Makeup
    public function index()
    {
        $details = DetailsMakeUp::latest()->paginate(10);
        return view('admin.package.details_package.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */

    //  Menampilkan form untuk membuat detail makeup baru
    public function create($packageId)
    {
        $package = PackageMakeUp::findOrFail($packageId);
        return view('admin.package.details_package.create', compact('package'));
    }


    /**
     * Store a newly created resource in storage.
     */

    //  Menyimpan data yang baru dibuat ke database.
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'nullable|string',
            'type' => 'required|string|in:package,addon,service',
            'price' => 'required|numeric',
            'bonus' => 'nullable|string',
            'package_makeup_id' => 'required|exists:package_makeup,id', // Validasi ID paket makeup
        ]);


        DetailsMakeUp::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'price' => $validated['price'],
            'bonus' => $validated['bonus'],
            'package_makeup_id' => $validated['package_makeup_id'],
        ]);


        $packageId = $validated['package_makeup_id'];


        return redirect()->route('dashboard-details_package.show',

        $packageId)
            ->with('pesan', 'Offer added successfully!');
    }

    /**
     * Display the specified resource.
     */

    //  Menampilkan resource data berdasarkan package makeup ID tertentu.
    public function show($packageId)
    {
        $details = DetailsMakeUp::where('package_makeup_id', $packageId)->get();
        $package = PackageMakeUp::findOrFail($packageId);
        return view('admin.package.details_package.index', compact('details', 'package'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    //  Menampilkan form untuk mengedit berdasarkan ID.
    public function edit(string $id)
    {

        $detail = DetailsMakeUp::findOrFail($id);
        $package = PackageMakeUp::findOrFail($detail->package_makeup_id);
        return view('admin.package.details_package.edit', compact('detail', 'package'));
    }

    /**
     * Update the specified resource in storage.
     */

    //  Mengupdate data yang sudah diperbarui di database
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'nullable|string',
            'type' => 'required|string|in:package,addon,service',
            'price' => 'required|numeric',
            'bonus' => 'nullable|string',
        ]);


        $detail = DetailsMakeUp::findOrFail($id);


        $detail->update($validated);


        return redirect()->route('dashboard-details_package.show', $detail->package_makeup_id)
            ->with('pesan', 'Offer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */

    //  ,enghapus data berdasarkan ID.
    public function destroy(string $id)
    {

        $detail = DetailsMakeUp::findOrFail($id);
        $packageId = $detail->package_makeup_id;
        $detail->delete();


        return redirect()->route('dashboard-details_package.show', $packageId)
            ->with('pesan', 'Offer deleted successfully!');
    }
}
