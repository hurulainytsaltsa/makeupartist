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

    //  menampilkan detail data order dan form penambahan penugasan MUA
    public function index($id)
    {

        $booking = Booking::with(['packagesMakeUp', 'DetailsMakeUp', 'payment'])
            ->where('id', $id)
            ->first();


        if (!$booking) {
            return redirect()->route('dashboard-order.index')->with('error', 'Booking tidak ditemukan.');
        }

        $muaProfiles = MuaProfile::all();
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

    //  menyimpan data penugasan MUA yang baru ditambahkan ke database
    public function store($bookingId, Request $request)
    {
        Log::info('Data yang diterima:', $request->all());

        $request->validate([
            'nama_mua' => 'required|string|max:255',
            'mua_id' => 'required|integer|exists:mua_profiles,id',
        ]);


        $booking = Booking::find($bookingId);

        if (!$booking) {
            return redirect()->back()->with('error', 'Data booking tidak ditemukan.');
        }


        $penugasan = new Penugasans();
        $penugasan->booking_id = $booking->id;
        $penugasan->nama = $booking->nama;
        $penugasan->no_telp = $booking->no_telp;
        $penugasan->alamat = $booking->alamat;
        $penugasan->tgl_makeup = $booking->tgl_makeup;
        $penugasan->jam = $booking->jam;
        $penugasan->pkt_makeup = $booking->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket';
        $penugasan->jenis_paket = $booking->DetailsMakeUp->name ?? 'Tidak Ada Paket';
        $penugasan->nama_mua = $request->nama_mua;
        $penugasan->mua_id = $request->mua_id;

        if ($penugasan->save()) {
            return redirect()->route('dashboard-assign.show')->with('success', 'Penugasan berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan penugasan.');
        }
    }

    /**
     * Display the specified resource.
     */

    // menampilkan data penugasan
    public function show()
    {
        $penugasan = Penugasans::latest()->paginate(10);
        return view('admin.penugasan.penugasan', compact('penugasan'));
    }

    /**
     * Show the form for editing the specified resource.
     */

    //  menampilkan form edit untuk data penugasan berdasarkan id
    public function edit(string $id)
    {

        $penugasan = Penugasans::find($id);
        if (!$penugasan) {
            return redirect()->route('dashboard-assign.show')->with('error', 'Penugasan tidak ditemukan.');
        }
        $muaProfiles = MuaProfile::all();
        return view('admin.penugasan.edit', compact('penugasan', 'muaProfiles'));
    }

    /**
     * Update the specified resource in storage.
     */

    //  mengupdate data di database
    public function update(Request $request, string $id)
    {

        $request->validate([
            'nama_mua' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'tgl_makeup' => 'required|date',
            'jam' => 'required|string',
            'pkt_makeup' => 'required|string|max:255',
            'jenis_paket' => 'required|string|max:255',
        ]);


        $penugasan = Penugasans::find($id);


        if (!$penugasan) {
            return redirect()->route('dashboard-assign.show')->with('error', 'Penugasan tidak ditemukan.');
        }


        $penugasan->nama_mua = $request->nama_mua;
        $penugasan->nama = $request->nama;
        $penugasan->no_telp = $request->no_telp;
        $penugasan->alamat = $request->alamat;
        $penugasan->tgl_makeup = $request->tgl_makeup;
        $penugasan->jam = $request->jam;
        $penugasan->pkt_makeup = $request->pkt_makeup;
        $penugasan->jenis_paket = $request->jenis_paket;


        if ($penugasan->save()) {
            return redirect()->route('dashboard-assign.show')->with('success', 'Penugasan berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui penugasan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    //  menghapus data berdasarkan id
    public function destroy(string $id)
    {
        $penugasan = Penugasans::find($id);

        if (!$penugasan) {
            return redirect()->back()->with('error', 'Penugasan tidak ditemukan.');
        }

        // Menghapus entri terkait di tabel honors yang memiliki penugasan_id
        $penugasan->honors()->delete(); // Pastikan relasi telah terdefinisi di model Penugasans

        if ($penugasan->delete()) {
            return redirect()->route('dashboard-assign.show')->with('success', 'Penugasan berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus penugasan.');
        }
    }

    //  Menandai booking sebagai selesai dan menambahkan data honor untuk MUA.
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

        $honor = new Honor();
        $penugasan = Penugasans::where('booking_id', $booking->id)->first();

        if ($penugasan) {
            $honor->penugasan_id = $penugasan->id;

            $muaProfile = MuaProfile::where('nama_mua', $penugasan->nama_mua)->first();

            if ($muaProfile) {
                $honor->mua_id = $muaProfile->id;
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
