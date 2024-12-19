@extends('admin.layouts.main')
@section('title', 'Detail Honor MUA')
@section('navHonor', 'active')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Detail Honor MUA</h1>

        <!-- MUA Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Informasi Penugasan</h5>
            </div>
            <div class="card-body">
                <p><strong>Nama MUA:</strong> {{ $mua->nama_mua }}</p>
                <p><strong>Deskripsi Penugasan:</strong> {{ $penugasan->pkt_makeup }} - {{ $penugasan->jenis_paket }}</p>
                <p><strong>Tanggal:</strong> {{ optional($penugasan->created_at)->format('d-m-Y') }}</p>
                {{-- <p><strong>Status:</strong> {{ ucfirst($penugasan->status) }}</p> --}}

                @if ($honors->isNotEmpty())
                    <p><strong>Gaji Kotor:</strong> Rp {{ number_format($honors->sum('gaji_kotor'), 0, ',', '.') }}</p>
                    <p><strong>Gaji Bersih:</strong> Rp {{ number_format($honors->sum('gaji_bersih'), 0, ',', '.') }}</p>
                @else
                    <p><strong>Gaji Kotor:</strong> Rp 0</p>
                    <p><strong>Gaji Bersih:</strong> Rp 0</p>
                @endif
            </div>
        </div>

        <!-- Payment History -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Riwayat Pembayaran untuk Penugasan Ini</h5>
            </div>
            <div class="card-body">
                @if ($honors->isNotEmpty())
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Jumlah Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Bukti Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($honors as $key => $honor)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ optional($honor->created_at)->format('d-m-Y') }}</td>
                                    <td>Rp {{ number_format($honor->gaji_kotor, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($honor->status) }}</td>
                                    <td>
                                        @if ($honor->bukti_pembayaran)
                                            <a href="{{ asset('images/bukti_honor/' . $honor->bukti_pembayaran) }}"
                                                target="_blank" class="btn btn-info btn-sm">Lihat Bukti</a>
                                        @else
                                            Tidak ada bukti
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Tautan untuk navigasi pagination -->
                    {{ $honors->links() }}
                @else
                    <p class="text-center">Tidak ada riwayat pembayaran untuk penugasan ini.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
