<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DetailsMakeUp;
use App\Models\PackageMakeUp;
use App\Models\Payment;
use Illuminate\Container\Attributes\Log;
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
            ->where('status', 'pending')
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
        $userId = Auth::id(); // Get the user ID
        return view('layouts.booking.create_booking', compact('paketMakeup', 'details', 'userId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_telp' => 'required|numeric',
            'alamat' => 'required|min:5',
            'tgl_makeup' => 'required|date',
            'pkt_makeup' => 'required|integer',
            'jam' => 'required|date_format:H:i',
            'jenis_paket' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $exists = Booking::where('tgl_makeup', $validatedData['tgl_makeup'])
            ->where('jam', $validatedData['jam'])
            ->exists();

        if ($exists) {
            session()->flash('error', 'Waktu yang Anda pilih sudah dipesan. Silakan pilih waktu lain.');

            return back()->withInput(); // Mengembalikan input sebelumnya
        }

        $validatedData['user_id'] = Auth::id();

        // Create a new MUA profile
        $booking = Booking::create([
            'user_id' => $validatedData['user_id'],
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'no_telp' => $validatedData['no_telp'],
            'alamat' => $validatedData['alamat'],
            'tgl_makeup' => $validatedData['tgl_makeup'],
            'pkt_makeup' => $validatedData['pkt_makeup'],
            'jam' => $validatedData['jam'],
            'jenis_paket' => $validatedData['jenis_paket'],
            'price' => $validatedData['price'],


        ]);

        $userId = $validatedData['user_id'];

        session()->flash('success', 'Booking berhasil dibuat.');

        return redirect('/booking');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with('detailsMakeup') // Relasi dengan tabel paket
            ->where('id', $id)
            ->firstOrFail();

        return view('layouts.payment.payment', compact('booking'));
    }

    public function payment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_rekening' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the booking based on the ID passed to the method
        $booking = Booking::findOrFail($id);

        $filename = time() . '.' . $request->bukti_pembayaran->extension();
        $request->bukti_pembayaran->move(public_path('images/bukti_pembayaran'), $filename);

        // Save payment data to the Payment model
        $payment = Payment::create([
            'booking_id' => $booking->id,
            'no_rekening' => $validatedData['no_rekening'],
            'bukti_pembayaran' => $filename,
            'status_pembayaran' => 'Waiting for Approval', // status bisa Anda sesuaikan
        ]);

        // Optionally update the booking status to 'paid' or similar if needed
        $booking->update(['status' => 'paid']);

        return redirect()->route('order.index')->with([
            'booking' => $booking,
            'payment' => $payment,
        ]);
    }

    public function getPrice($paketId)
    {
        // Cari harga berdasarkan jenis_paket
        $jenisPaket = DetailsMakeUp::find($paketId);

        if ($jenisPaket) {
            return response()->json([
                'price' => $jenisPaket->price,  // Mengambil harga dari kolom 'price' di tabel DetailsMakeUp
            ]);
        }

        return response()->json(['error' => 'Paket tidak ditemukan'], 404);
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

    public function redirectToPayment(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|numeric',
            'alamat' => 'required|string',
            'tgl_makeup' => 'required|date',
            'jam' => 'required',
            'pkt_makeup' => 'required',
            'jenis_paket' => 'required',
        ]);

        // Simpan data ke session sementara
        session()->put('booking_data', $validated);

        // Arahkan ke halaman pembayaran
        return redirect('/payment');
    }

    public function getNotifications()
    {
        // Ambil data booking dengan status "pending"
        $newBookings = Booking::with('packagesMakeUp') // Memuat relasi dari Booking ke PackageMakeUp
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Ambil data pembayaran dengan status "Waiting for Approval"
        $newPayments = Payment::with(['booking.packagesMakeUp']) // Memuat relasi ke Booking dan PackageMakeUp
            ->where('status_pembayaran', 'Waiting for Approval')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return response()->json([
            'count' => $newBookings->count() + $newPayments->count(),
            'bookings' => $newBookings,
            'payments' => $newPayments,
        ]);
    }
}
