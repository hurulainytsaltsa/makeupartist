<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Calendar;
use App\Models\MuaProfile;
use App\Models\Payment;
use App\Models\Penugasan;
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
            ->whereIn('status', ['paid', 'completed'])
            ->get();

            // dd($bookings->pluck('status'));

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
            ->whereIn('status', ['paid', 'completed'])
            ->firstOrFail(); // Jika tidak ditemukan, lempar error 404

        // Mengirimkan data booking ke view
        return view('admin.order.details', compact('bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
        $booking = Booking::findOrFail($id); // Temukan pemesanan berdasarkan ID
        if ($booking->payment) {
            // Update status pembayaran
            $booking->payment->status_pembayaran = 'Payment Approved';
            $booking->payment->save();

            Calendar::where('start', $booking->tgl_makeup . ' ' . $booking->jam)->update([
                'title' => 'Not Available',
                'color' => 'red',
            ]);

            return redirect()->route('dashboard-order.index')->with('success', 'Pembayaran berhasil dikonfirmasi.');
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
