<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Honor;
use App\Models\MuaProfile;
use App\Models\Penugasan;
use App\Models\Penugasans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardPenugasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        // Mengambil booking berdasarkan id yang diminta
        $booking = Booking::with(['packagesMakeUp', 'DetailsMakeUp', 'payment'])
            ->where('id', $id) // Pastikan hanya mengambil data dengan ID yang sesuai
            ->first(); // Menggunakan first() untuk menangani kondisi jika data tidak ditemukan

        // Cek apakah booking ada
        if (!$booking) {
            // Jika booking tidak ditemukan, redirect atau tampilkan error
            return redirect()->route('dashboard-order.index')->with('error', 'Booking tidak ditemukan.');
        }

        // Mengambil semua MUA Profiles
        $muaProfiles = MuaProfile::all();

        // Kirim data ke view
        return view('admin.penugasan.index', compact('booking', 'muaProfiles'));
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
    public function store($bookingId, Request $request)
    {
        Log::info('Data yang diterima:', $request->all());
        // Validasi input untuk nama MUA
        $request->validate([
            'nama_mua' => 'required|string|max:255',
            'mua_id' => 'required|integer|exists:mua_profiles,id', // Validasi ID MUA
        ]);

        // Ambil data booking berdasarkan ID
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return redirect()->back()->with('error', 'Data booking tidak ditemukan.');
        }

        // Simpan data ke tabel penugasan
        $penugasan = new Penugasans();
        $penugasan->booking_id = $booking->id;
        $penugasan->nama = $booking->nama; // Data dari booking
        $penugasan->no_telp = $booking->no_telp; // Data dari booking
        $penugasan->alamat = $booking->alamat; // Data dari booking
        $penugasan->tgl_makeup = $booking->tgl_makeup; // Data dari booking
        $penugasan->jam = $booking->jam; // Data dari booking
        $penugasan->pkt_makeup = $booking->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket'; // Data dari relasi booking
        $penugasan->jenis_paket = $booking->DetailsMakeUp->name ?? 'Tidak Ada Paket'; // Data dari relasi booking
        $penugasan->nama_mua = $request->nama_mua;
        $penugasan->mua_id = $request->mua_id; // Simpan ID MUA

        if ($penugasan->save()) {
            return redirect()->route('dashboard-assign.show')->with('success', 'Penugasan berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan penugasan.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $penugasan = Penugasans::latest()->paginate(10);
        return view('admin.penugasan.penugasan', compact('penugasan'));
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
        // Cari penugasan berdasarkan ID
        $penugasan = Penugasans::find($id);

        // Periksa apakah penugasan ditemukan
        if (!$penugasan) {
            return redirect()->back()->with('error', 'Penugasan tidak ditemukan.');
        }

        // Hapus penugasan
        if ($penugasan->delete()) {
            return redirect()->route('dashboard-assign.show')->with('success', 'Penugasan berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus penugasan.');
        }
    }

    public function markAsCompleted($id)
    {
        $booking = Booking::find($id);

        if (!$booking) {
            return redirect()->back()->with('error', 'Booking tidak ditemukan.');
        }

        $booking->status = 'completed';

        if (!$booking->save()) {
            return redirect()->back()->with('error', 'Gagal menyelesaikan penugasan.');
        }

        // Menyimpan data honor
        $honor = new Honor();
        $penugasan = Penugasans::where('booking_id', $booking->id)->first();

        if ($penugasan) {
            $honor->penugasan_id = $penugasan->id;

            // Mencari ID MUA berdasarkan nama
            $muaProfile = MuaProfile::where('nama_mua', $penugasan->nama_mua)->first();

            if ($muaProfile) {
                $honor->mua_id = $muaProfile->id; // Menggunakan ID MUA yang ditemukan
            } else {
                Log::error('MUA not found: ' . $penugasan->nama_mua);
                return redirect()->back()->with('error', 'MUA tidak ditemukan.');
            }

            $honor->gaji_kotor = $booking->DetailsMakeUp->price ?? 0;
            $honor->gaji_bersih = $honor->gaji_kotor * 0.9;
            $honor->status = 'Belum Dibayar';

            if ($honor->save()) {
                return redirect()->back()->with('success', 'Penugasan berhasil diselesaikan dan honor telah ditambahkan.');
            } else {
                return redirect()->back()->with('error', 'Gagal menyimpan honor.');
            }
        } else {
            return redirect()->back()->with('error', 'Penugasan tidak ditemukan untuk booking ini.');
        }
    }
}
