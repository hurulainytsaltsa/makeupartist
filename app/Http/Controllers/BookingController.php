<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DetailsMakeUp;
use App\Models\PackageMakeUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $booking = Booking::with('detailsMakeUp')
        ->where('user_id', Auth::id()) // Filter berdasarkan user yang sedang login
        ->get();
        return view('layouts.booking.booking', compact('booking'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paketMakeup = PackageMakeUp::all();
        $details = DetailsMakeUp::all();

        return view('layouts.booking.create_booking', compact('paketMakeup', 'details'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => Auth::id(),
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'no_telp' => 'required|numeric',
            'alamat' => 'required|min:5',
            'tgl_makeup' => 'required|date',
            'pkt_makeup' => 'required|integer',
            'jam' => 'required|date_format:H:i',
            'jenis_paket' => 'required|integer',
        ]);

        // Create a new MUA profile
        $booking = Booking::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'no_telp' => $validatedData['no_telp'],
            'alamat' => $validatedData['alamat'],
            'tgl_makeup' => $validatedData['tgl_makeup'],
            'pkt_makeup' => $validatedData['pkt_makeup'],
            'jam' => $validatedData['jam'],
            'jenis_paket' => $validatedData['jenis_paket'],
        ]);

        return redirect('/booking')->with('success', 'Portofolio added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $details = DetailsMakeUp::all();
        return view('booking', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        return redirect('/booking')->with('pesan', 'Data sudah berhasil dihapus');
    }

    public function showDetails($paketId)
    {
        $details = DetailsMakeUp::where('package_makeup_id', $paketId)->get();
        return response()->json(['details' => $details]);
    }
}
