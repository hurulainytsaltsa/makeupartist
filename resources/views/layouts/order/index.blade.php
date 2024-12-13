@extends('layouts.customer.main')
@section('title', 'Order History')
@section('navOrder', 'active')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Riwayat Pemesanan</h2>
    <div class="row">
        @forelse($bookings as $booking)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Nomor Pemesanan: {{ $booking->id }}</h5>
                        <p class="card-text text-muted small mb-3">
                            <strong>Nama Paket:</strong> {{ $booking->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket' }}<br>
                            <strong>Jenis Paket:</strong> {{ optional($booking->DetailsMakeUp)->name ?? 'Tidak Ada Paket' }}<br>
                            <strong>Tanggal Makeup:</strong> {{ $booking->tgl_makeup ? \Carbon\Carbon::parse($booking->tgl_makeup)->format('d M Y') : 'Tanggal tidak tersedia' }}<br>
                            <strong>Status Pembayaran:</strong>
                            @if ($booking->payment)
                                <span class="badge {{ $booking->payment->status_pembayaran === 'Payment Approved' ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $booking->payment->status_pembayaran }}
                                </span>
                            @else
                                <span class="badge bg-danger">Belum Dibayar</span>
                            @endif
                        </p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('order-history.show', $booking->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
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
                    <div class="card-footer bg-light border-0">
                        <small class="text-muted">Dipesan pada {{ \Carbon\Carbon::parse($booking->created_at)->format('d M Y, H:i') }}</small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted">
                <img src="/images/no-data.svg" alt="Tidak ada data" class="img-fluid mb-3" style="max-width: 200px;">
                <p class="mb-0">Tidak ada riwayat pemesanan.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
