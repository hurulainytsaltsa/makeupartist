@extends('layouts.customer.main')
@section('title', 'Order History')
@section('navOrder', 'active')


@section('content')
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Detail Pesanan</h2>
        <div class="card shadow-sm border-0 rounded">
            <div class="card-header bg-light border-bottom">
                <h5 class="mb-0 text-center text-dark">Nomor Pemesanan: <span>{{ $booking->id }}</span></h5>
            </div>
            <div class="card-body">
                <p class="card-text mb-3">
                    <strong>Nama:</strong> {{ $booking->nama }}<br>
                    <strong>Email:</strong> {{ $booking->email }}<br>
                    <strong>No. Telepon:</strong> {{ $booking->no_telp }}<br>
                    <strong>Alamat:</strong> {{ $booking->alamat }}<br>
                    <strong>Tanggal Makeup:</strong> {{ $booking->tgl_makeup ? \Carbon\Carbon::parse($booking->tgl_makeup)->format('d M Y') : 'Tanggal tidak tersedia' }}<br>
                    <strong>Jam:</strong> {{ $booking->jam }}<br>
                    <strong>Paket Makeup:</strong> {{ $booking->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket' }}<br>
                    <strong>Jenis Paket:</strong> {{ optional($booking->DetailsMakeUp)->name ?? 'Tidak Ada Paket' }}<br>
                </p>

                <div class="mb-3">
                    <h6 class="fw-bold">Detail Tambahan:</h6>
                    <p class="text-muted small mb-0">{{ $booking->catatan ?? 'Tidak ada catatan tambahan' }}</p>
                </div>
            </div>
            <div class="card-footer bg-light d-flex justify-content-between">
                <a href="{{ route('order-history.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
                @if ($booking->payment && $booking->payment->status_pembayaran == 'Pending')
                    <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?')">Batal</button>
                    </form>
                @endif
            </div>
        </div>

        <div class="mt-4">
            <h5 class="mb-3">Rincian Pembayaran</h5>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Deskripsi</th>
                        <th class="text-end">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Biaya Makeup</td>
                        <td class="text-end">Rp{{ number_format($booking->price ?? 0, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>Status Pembayaran</td>
                        <td class="text-end">
                            @if(isset($booking->payment))
                                <span class="badge {{ $booking->payment->status_pembayaran === 'Payment Approved' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $booking->payment->status_pembayaran }}
                                </span>
                            @else
                                <span class="badge bg-danger">Belum Dibayar</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if ($booking->payment && $booking->payment->bukti_pembayaran)
        <div class="mt-4">
            <h5 class="mb-3">Bukti Pembayaran</h5>
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('images/bukti_pembayaran/' . $booking->payment->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid" style="max-width: 300px; height: auto; border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection
