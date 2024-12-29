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

    //  Menampilkan daftar riwayat pemesanan pengguna yang sedang login.
    public function index()
    {
        $bookings = Booking::with(['detailsMakeUp', 'packagesMakeUp', 'payment'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

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

    //   Menampilkan detail riwayat pemesanan tertentu berdasarkan ID.
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
