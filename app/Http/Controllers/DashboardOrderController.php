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

    //  Menampilkan daftar booking.
    public function index()
    {
        $bookings = Booking::with('detailsMakeUp', 'payment') // Relasi dengan tabel detailsMakeUp
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

    //  Menampilkan detail booking tertentu berdasarkan ID.
    public function show(string $id)
    {
        $bookings = Booking::with('detailsMakeUp', 'payment')
            ->where('id', $id)
            ->whereIn('status', ['paid', 'completed'])
            ->firstOrFail();

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
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */

    //  Menghapus data booking tertentu beserta pembayaran terkait.
    public function destroy(string $id)
    {
        $booking = Booking::with(['payment', 'penugasan.honors'])->findOrFail($id);

        // Hapus data di honors
        foreach ($booking->penugasan->honors ?? [] as $honor) {
            $honor->delete();
        }

        // Hapus data di penugasan
        if ($booking->penugasan) {
            $booking->penugasan->delete();
        }

        // Hapus data pembayaran
        if ($booking->payment) {
            $booking->payment->delete();
        }

        // Hapus data booking
        $booking->delete();

        return redirect()->route('dashboard-order.index')->with('success', 'Booking dan pembayaran terkait berhasil dihapus.');
    }

    // Mengonfirmasi pembayaran untuk booking berdasarkan ID
    public function confirmPayment($id)
    {
        $booking = Booking::findOrFail($id);
        if ($booking->payment) {
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

    // Menolak pembayaran untuk booking berdasarkan ID
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
