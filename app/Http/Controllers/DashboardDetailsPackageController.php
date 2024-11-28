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
    public function index()
    {
        $details = DetailsMakeUp::latest()->paginate(10);
        return view('admin.package.details_package.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($packageId)
    {
        // Temukan package berdasarkan ID
        $package = PackageMakeUp::findOrFail($packageId);

        // Mengirim data package ke view
        return view('admin.package.details_package.create', compact('package'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'nullable|string',
            'type' => 'required|string|in:package,addon,service',
            'price' => 'required|numeric',
            'bonus' => 'nullable|string',
            'package_makeup_id' => 'required|exists:package_makeup,id', // Validasi ID paket makeup
        ]);

        // Simpan penawaran baru ke tabel detail_packages
        DetailsMakeUp::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'price' => $validated['price'],
            'bonus' => $validated['bonus'],
            'package_makeup_id' => $validated['package_makeup_id'],
        ]);

        // Ambil ID paket makeup untuk redirect ke halaman detail
        $packageId = $validated['package_makeup_id'];

        // Redirect ke halaman detail dengan pesan sukses
        return redirect()->route('dashboard-details_package.show',

        $packageId)
            ->with('pesan', 'Offer added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($packageId)
    {
        $details = DetailsMakeUp::where('package_makeup_id', $packageId)->get();
        $package = PackageMakeUp::findOrFail($packageId);
        return view('admin.package.details_package.index', compact('details', 'package'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Temukan detail berdasarkan ID
        $detail = DetailsMakeUp::findOrFail($id);

        // Temukan package terkait untuk informasi tambahan
        $package = PackageMakeUp::findOrFail($detail->package_makeup_id);

        // Kirim data detail dan package ke view edit
        return view('admin.package.details_package.edit', compact('detail', 'package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'name' => 'required|string|min:3',
            'description' => 'nullable|string',
            'type' => 'required|string|in:package,addon,service',
            'price' => 'required|numeric',
            'bonus' => 'nullable|string',
        ]);

        // Temukan detail yang akan diupdate
        $detail = DetailsMakeUp::findOrFail($id);

        // Update data di database
        $detail->update($validated);

        // Redirect ke halaman detail dengan pesan sukses
        return redirect()->route('dashboard-details_package.show', $detail->package_makeup_id)
            ->with('pesan', 'Offer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan detail berdasarkan ID
        $detail = DetailsMakeUp::findOrFail($id);

        // Simpan ID package untuk redirect setelah penghapusan
        $packageId = $detail->package_makeup_id;

        // Hapus detail dari database
        $detail->delete();

        // Redirect kembali ke halaman detail dengan pesan sukses
        return redirect()->route('dashboard-details_package.show', $packageId)
            ->with('pesan', 'Offer deleted successfully!');
    }
}
