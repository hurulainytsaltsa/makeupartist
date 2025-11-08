<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\DetailsMakeUp;
use App\Models\PackageMakeUp;
use App\Models\Payment;
use Illuminate\Container\Attributes\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  Menampilkan daftar booking pada halaman customer
    public function index()
    {
        $timeThreshold = now()->subHours(12);

        // Menghapus booking yang lebih tua dari 12 jam dan statusnya 'pending'
        Booking::where('status', 'pending')
            ->where('created_at', '<', $timeThreshold)
            ->delete();

        $booking = Booking::with('detailsMakeUp')
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->get();
        return view('layouts.booking.booking', compact('booking'));
    }

    /**
     * Show the form for creating a new resource.
     */

    //  menampilkan form booking untuk customer
    public function create()
    {
        $paketMakeup = PackageMakeUp::all();
        $details = DetailsMakeUp::all();
        $userId = Auth::id();
        return view('layouts.booking.create_booking', compact('paketMakeup', 'details', 'userId'));
    }

    /**
     * Store a newly created resource in storage.
     */

    //  Simpan booking baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|numeric',
            'alamat' => 'required|min:5',
            'tgl_makeup' => 'required|date|after_or_equal:today',
            'pkt_makeup' => 'required|integer',
            'jam' => 'required|date_format:H:i',
            'jenis_paket' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->exists();

        if ($existingBooking) {
            session()->flash('error', 'Hanya bisa membooking sekali! Harap selesaikan pembayaran terlebih dahulu.');
            return back()->withInput();
        }

        $requestedDateTime = date('Y-m-d H:i:s', strtotime($validatedData['tgl_makeup'] . ' ' . $validatedData['jam']));

        $isAvailable = \Illuminate\Support\Facades\DB::table('calendars')
            ->where('start', $requestedDateTime)
            ->where('title', 'Available')
            ->exists();

        if (!$isAvailable) {
            session()->flash('error', 'Jam tersebut tidak tersedia. Silakan pilih waktu lain.');
            return back()->withInput();
        }

        $exists = Booking::where('tgl_makeup', $validatedData['tgl_makeup'])
            ->where('jam', $validatedData['jam'])
            ->exists();

        if ($exists) {
            session()->flash('error', 'Waktu yang Anda pilih sudah dipesan. Silakan pilih waktu lain.');
            return back()->withInput();
        }

        $validatedData['user_id'] = Auth::id();

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
            'status' => 'pending',
            'created_at' => now(),
        ]);

        session()->flash('success', 'Booking berhasil dibuat.');
        return redirect('/booking');
    }

    /**
     * Display the specified resource.
     */

    // menampilkan detail booking dan form pembayaran untuk customer berdasarkan ID.
    public function show(string $id)
    {
        $booking = Booking::with('detailsMakeup')
            ->where('id', $id)
            ->firstOrFail();

        return view('layouts.payment.payment', compact('booking'));
    }

    // Validasi data pembayaran dan menyimpan ke database
    public function payment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'no_rekening' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $booking = Booking::findOrFail($id);

        $filename = time() . '.' . $request->bukti_pembayaran->extension();
        $request->bukti_pembayaran->move(public_path('images/bukti_pembayaran'), $filename);


        $payment = Payment::create([
            'booking_id' => $booking->id,
            'no_rekening' => $validatedData['no_rekening'],
            'bukti_pembayaran' => $filename,
            'status_pembayaran' => 'Waiting for Approval',
        ]);

        $booking->update(['status' => 'paid']);

        return redirect()->route('order.index')->with([
            'booking' => $booking,
            'payment' => $payment,
        ]);
    }


    // menampilkan harga paket berdasarkan ID.
    public function getPrice($paketId)
    {
        $jenisPaket = DetailsMakeUp::find($paketId);

        if ($jenisPaket) {
            return response()->json([
                'price' => $jenisPaket->price,
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

    }

    // menampilkan detail makeup berdasarkan ID paket.
    public function showDetails($paketId)
    {
        $details = DetailsMakeUp::where('package_makeup_id', $paketId)->get();
        return response()->json(['details' => $details]);
    }

    // Pindah ke halaman pembayaran dengan menyimpan data sementara.
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


    // Ambil notifikasi booking dan pembayaran baru.
    public function getNotifications()
    {
        $newBookings = Booking::with('packagesMakeUp')
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        $newPayments = Payment::with(['booking.packagesMakeUp'])
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

    public function handle()
    {
        $timeThreshold = now()->subHours(12);

        Booking::where('status', 'pending')
            ->where('created_at', '<', $timeThreshold)
            ->delete();

        $this->$this->info('Expired bookings have been deleted.');
    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('bookings:delete-expired')->hourly();
    }


}
