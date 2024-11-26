@extends('admin.layouts.main')
@section('title', 'Order')
@section('navPackage', 'active')

@section('content')
    <div class="container">
        <style>
            .profile-img {
                width: 100%;
                max-width: 400px;
                height: auto;
                object-fit: cover;
                border-bottom: 2px solid #de8d9b;
            }
            .btn-back {
                background-color: #de8d9b;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                text-decoration: none;
            }
            .btn-back:hover {
                background-color: #bf8c94;
                text-decoration: none;
            }
        </style>

        <h2 class="text-center">Order Details</h2>

        <button class="btn-back mb-3" onclick="history.back()">&#8592; Back</button>

        <div class="card mb-4">
            <div class="card-body">
                <h5>Booking Details:</h5>
                <p><strong>Nama:</strong> {{ $bookings->nama }}</p>
                <p><strong>Email:</strong> {{ $bookings->email }}</p>
                <p><strong>No. Telepon:</strong> {{ $bookings->no_telp }}</p>
                <p><strong>Alamat:</strong> {{ $bookings->alamat }}</p>
                <p><strong>Tanggal Makeup:</strong> {{ $bookings->tgl_makeup }}</p>
                <p><strong>Jam:</strong> {{ $bookings->jam }}</p>
                <p><strong>Paket Makeup:</strong> {{ $bookings->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket' }}</p>
                <p><strong>Jenis Paket:</strong> {{ optional($bookings->DetailsMakeUp)->name ?? 'Tidak Ada Paket' }}</p>
                <p><strong>Price:</strong> {{ $bookings->price }}</p>

                <!-- Data Pembayaran -->
                @if ($bookings->payment)
                    <div class="mt-4">
                        <h5>Payment Details:</h5>
                        <p><strong>No. Rekening:</strong> {{ $bookings->payment->no_rekening }}</p>
                        <p><strong>Status Pembayaran:</strong> {{ $bookings->payment->status_pembayaran }}</p>
                        <p><strong>Bukti Pembayaran:</strong></p>
                        <img src="{{ asset('images/bukti_pembayaran/' . $bookings->payment->bukti_pembayaran) }}"
                            alt="Bukti Pembayaran" class="profile-img">
                    </div>
                @else
                    <p><em>Pembayaran belum dilakukan.</em></p>
                @endif
            </div>
        </div>
    </div>
@endsection
