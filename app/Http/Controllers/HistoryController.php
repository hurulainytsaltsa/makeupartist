<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua pemesanan untuk user yang sedang login
        $bookings = Booking::with(['detailsMakeUp', 'packagesMakeUp', 'payment']) // Tambahkan relasi yang diperlukan
            ->where('user_id', Auth::id()) // Filter berdasarkan user yang sedang login
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan tanggal terbaru
            ->get();

        // Mengirimkan data bookings ke view
        return view('layouts.order.index', compact('bookings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with(['packagesMakeUp', 'DetailsMakeUp', 'payment'])->findOrFail($id);
        return view('layouts.order.show', compact('booking'));
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
        //
    }
}
