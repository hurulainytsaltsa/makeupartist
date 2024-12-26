<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  Menampilkan daftar booking
    public function index()
    {
        $booking = Booking::latest()->paginate(10);
        return view('admin.booking.index', compact('booking'));
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

    //  Menampilkan detail booking berdasarkan ID.
    public function show(string $id)
    {
        $booking = Booking::findOrFail($id);
        return view('admin.booking.show', compact('booking'));
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
        $booking = Booking::with('payment')->findOrFail($id);
        if ($booking->payment) {
            $booking->payment->delete();
        }

        $booking->delete();

        return redirect()->route('dashboard-booking.index')->with('success', 'Booking dan pembayaran terkait berhasil dihapus.');
    }
}
