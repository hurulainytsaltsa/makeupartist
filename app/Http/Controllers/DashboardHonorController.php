<?php

namespace App\Http\Controllers;

use App\Models\Honor;
use App\Models\MuaProfile;
use App\Models\Payment;
use App\Models\Penugasans;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardHonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $honors = Honor::with(['muaProfile', 'penugasan'])->latest()->paginate(10);
        $muaProfiles = \App\Models\MuaProfile::all();
        return view('admin.honor.index', compact('honors', 'muaProfiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Menampilkan form untuk menambah honor
        return view('admin.honor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'penugasan_id' => 'required|integer',
            'mua_id' => 'required|integer',
            'gaji_kotor' => 'required|numeric',
            'gaji_bersih' => 'required|numeric',
            'status' => 'required|string',
        ]);

        // Membuat entri baru di tabel honor
        $honor = new Honor();
        $honor->penugasan_id = $request->penugasan_id;
        $honor->mua_id = $request->mua_id;
        $honor->gaji_kotor = $request->gaji_kotor;
        $honor->gaji_bersih = $request->gaji_bersih;
        $honor->status = $request->status;

        // Simpan dan tangani hasilnya
        if ($honor->save()) {
            return redirect()->route('admin.honor.index')->with('success', 'Honor berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Gagal menyimpan honor.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($penugasan_id)
    {
        // Ambil data penugasan berdasarkan ID
        $penugasan = Penugasans::findOrFail($penugasan_id);

        // Ambil data MUA yang terkait dengan penugasan
        $mua = MuaProfile::find($penugasan->mua_id);

        // Ambil data honor berdasarkan penugasan
        $honors = Honor::where('penugasan_id', $penugasan->id) // pastikan ini adalah id penugasannya
            ->latest()
            ->paginate(10);

        return view('admin.honor.show', compact('mua', 'penugasan', 'honors'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Menampilkan form untuk mengedit honor
        $honor = Honor::findOrFail($id);
        return view('admin.honor.edit', compact('honor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'mua_nama' => 'required|string|max:255',
            'gaji_kotor' => 'required|numeric',
            'gaji_bersih' => 'required|numeric',
            'status' => 'required|string|max:255',
        ]);

        // Cari honor dan perbarui
        $honor = Honor::findOrFail($id);
        $honor->mua_nama = $request->mua_nama;
        $honor->gaji_kotor = $request->gaji_kotor;
        $honor->gaji_bersih = $request->gaji_bersih;
        $honor->status = $request->status;

        if ($honor->save()) {
            return redirect()->route('dashboard-honor.index')->with('success', 'Honor berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Gagal memperbarui honor.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari honor berdasarkan ID dan hapus
        $honor = Honor::findOrFail($id);

        if ($honor->delete()) {
            return redirect()->route('dashboard-honor.index')->with('success', 'Honor berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus honor.');
        }
    }

    public function filter(Request $request)
    {
        // Ambil input filter
        $month = $request->input('month');
        $year = $request->input('year');
        $week = $request->input('week');
        $mua_id = $request->input('mua_id');

        // Query dasar dengan relasi
        $query = Honor::with(['muaProfile', 'penugasan']);

        // Filter berdasarkan bulan
        if ($month) {
            $query->whereMonth('created_at', date('m', strtotime($month)))
                ->whereYear('created_at', date('Y', strtotime($month)));
        }

        // Filter berdasarkan tahun
        if ($year) {
            $query->whereYear('created_at', $year);
        }

        // Filter berdasarkan minggu
        if ($week) {
            $startOfWeek = now()->setISODate(now()->year, $week)->startOfWeek();
            $endOfWeek = now()->setISODate(now()->year, $week)->endOfWeek();
            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }

        // Filter berdasarkan MUA
        if ($mua_id) {
            $query->where('mua_id', $mua_id);
        }

        // Dapatkan hasil query
        $honors = $query->latest()->paginate(10);

        // $honors = $query->get();
        $muaProfiles = \App\Models\MuaProfile::all(); // Ambil semua data MUA

        return view('admin.honor.index', compact('honors', 'muaProfiles'));
    }

    public function cetakHonorPdf(Request $request)
    {
        // Ambil data honor sesuai filter
        $month = $request->input('month');
        $year = $request->input('year');
        $week = $request->input('week');
        $mua_id = $request->input('mua_id');

        $query = Honor::with(['muaProfile', 'penugasan']);

        // Filter sesuai input
        if ($month) {
            $query->whereMonth('created_at', date('m', strtotime($month)))
                ->whereYear('created_at', date('Y', strtotime($month)));
        }

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($week) {
            $startOfWeek = now()->setISODate(now()->year, $week)->startOfWeek();
            $endOfWeek = now()->setISODate(now()->year, $week)->endOfWeek();
            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }

        if ($mua_id) {
            $query->where('mua_id', $mua_id);
        }

        // Ambil data untuk laporan
        $honors = $query->get();

        // Hitung total gaji yang dibayar dan belum dibayar
        $total_dibayar = $honors->where('status', 'Sudah Dibayar')->sum('gaji_bersih');
        $total_belum_dibayar = $honors->where('status', 'Belum Dibayar')->sum('gaji_bersih');

        // Ambil data MUA dan penugasan (jika diperlukan)
        $mua = MuaProfile::find($mua_id);
        $penugasan = $honors->first()->penugasan ?? null;

        // Generate PDF
        $pdf = Pdf::loadView('admin.honor.cetak_pdf', compact('honors', 'mua', 'penugasan', 'total_dibayar', 'total_belum_dibayar'));
        return $pdf->stream('Laporan-Honor-MUA.pdf');
    }

    public function cetakOrderPdf(Request $request)
    {
        // Ambil data order sesuai filter
        $month = $request->input('month');
        $year = $request->input('year');
        $week = $request->input('week');

        // Query order sesuai filter
        $query = Honor::with('muaProfile', 'penugasan');

        // Filter sesuai input
        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($month) {
            // Ambil bulan dari format YYYY-MM
            $monthNum = (int) substr($month, 5, 2); // Ambil dua karakter dari posisi 5 (indeks bulan)
            $query->whereMonth('created_at', $monthNum);
        }

        if ($week) {
            $startOfWeek = now()->setISODate(now()->year, $week)->startOfWeek();
            $endOfWeek = now()->setISODate(now()->year, $week)->endOfWeek();
            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }

        // Ambil data untuk laporan
        $orders = $query->get();

        // Buat judul laporan berdasarkan filter
        $judul_laporan = 'Laporan Order';
        if ($year) {
            $judul_laporan .= ' Tahun: ' . $year;
        }
        if ($month) {
            $monthNum = (int) substr($month, 5, 2); // Ambil bulan dari format YYYY-MM
            $judul_laporan .= ' Bulan: ' . date('F', mktime(0, 0, 0, $monthNum, 1)); // Gunakan bulan yang sudah dikonversi
        }
        if ($week) {
            $judul_laporan .= ' Minggu: ' . $week;
        }

        // Generate PDF
        $pdf = Pdf::loadView('admin.honor.cetak_order', compact('orders', 'judul_laporan'));
        return $pdf->stream('Laporan-Order.pdf');
    }

    public function uploadPayment(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        $honor = Honor::findOrFail($id);

        $filename = time() . '.' . $request->bukti_pembayaran->extension();
        $request->bukti_pembayaran->move(public_path('images/bukti_honor'), $filename);

        // Update data honor
        $honor->bukti_pembayaran = $filename;
        $honor->status = 'Sudah Dibayar';
        $honor->save();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah.');
    }
}
