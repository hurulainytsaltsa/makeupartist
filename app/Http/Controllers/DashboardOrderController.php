<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('detailsMakeUp') // Relasi dengan tabel detailsMakeUp
            ->where('status', 'paid') // Tambahkan filter untuk hanya mengambil data yang berstatus 'paid'
            ->get();

        // Mengirimkan data bookings dengan relasi payment ke view
        return view('admin.order.index', compact('bookings'));
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
        $bookings = Booking::with('detailsMakeUp', 'payment') // Relasi dengan tabel detailsMakeUp dan payment
            ->where('id', $id) // Filter berdasarkan booking_id
            ->where('status', 'paid')
            ->firstOrFail(); // Jika tidak ditemukan, lempar error 404

        // Mengirimkan data booking ke view
        return view('admin.order.details', compact('bookings'));
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
        // Cari data booking berdasarkan ID
        $booking = Booking::with('payment')->findOrFail($id);

        // Hapus data pembayaran terkait jika ada
        if ($booking->payment) {
            $booking->payment->delete(); // Hapus pembayaran terkait
        }

        // Hapus data booking
        $booking->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('dashboard-order.index')->with('success', 'Booking dan pembayaran terkait berhasil dihapus.');
    }

    public function confirmPayment($id)
    {
        $booking = Booking::findOrFail($id); // Pastikan Anda memiliki model Booking
        if ($booking->payment) {
            $booking->payment->status_pembayaran = 'Payment Approved';
            $booking->payment->save();
            return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi.');
        }
        return redirect()->back()->with('error', 'Pembayaran tidak ditemukan.');
    }

    public function rejectPayment($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->payment) {
            $booking->payment->status_pembayaran = 'Payment Rejected';
            $booking->payment->save();
            return redirect()->back()->with('success', 'Pembayaran berhasil ditolak.');
        }
        return redirect()->back()->with('error', 'Pembayaran tidak ditemukan.');
    }
}
