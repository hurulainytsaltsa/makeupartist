@extends('admin.layouts.main')
@section('title', 'Order Confirmation')
@section('navPackage', 'active')

@section('content')
    <div class="container">
        <style>
            .profile-img {
                width: 100%;
                max-width: 400px;
                height: auto;
                object-fit: cover;
                border-radius: 5px;
                margin-bottom: 15px;
            }

            .btn-custom {
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                font-size: 16px;
                text-decoration: none;
                cursor: pointer;
            }

            .btn-back {
                background-color: #de8d9b;
                color: white;
            }

            .btn-back:hover {
                background-color: #bf8c94;
            }

            .btn-confirm {
                background-color: #4caf50;
                color: white;
            }

            .btn-confirm:hover {
                background-color: #45a049;
            }

            .btn-reject {
                background-color: #f44336;
                color: white;
            }

            .btn-reject:hover {
                background-color: #e53935;
            }
        </style>

        <h2 class="text-center">Order Payment Confirmation</h2>

        <button class="btn-custom btn-back mb-3" onclick="history.back()">&#8592; Back</button>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="mb-4">Booking Details:</h5>
                <p><strong>Nama:</strong> {{ $bookings->nama }}</p>
                <p><strong>Email:</strong> {{ $bookings->email }}</p>
                <p><strong>No. Telepon:</strong> {{ $bookings->no_telp }}</p>
                <p><strong>Alamat:</strong> {{ $bookings->alamat }}</p>
                <p><strong>Tanggal Makeup:</strong> {{ $bookings->tgl_makeup }}</p>
                <p><strong>Jam:</strong> {{ $bookings->jam }}</p>
                <p><strong>Paket Makeup:</strong> {{ $bookings->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket' }}</p>
                <p><strong>Jenis Paket:</strong> {{ optional($bookings->DetailsMakeUp)->name ?? 'Tidak Ada Paket' }}</p>
                <p><strong>Price:</strong> Rp {{ number_format($bookings->price, 0, ',', '.') }}</p>

                @if ($bookings->payment)
                    <div class="mt-4">
                        <h5 class="mb-4">Payment Details:</h5>
                        <p><strong>No. Rekening:</strong> {{ $bookings->payment->no_rekening }}</p>
                        <p><strong>Status Pembayaran:</strong> {{ $bookings->payment->status_pembayaran }}</p>
                        <p><strong>Bukti Pembayaran:</strong></p>
                        <img src="{{ asset('images/bukti_pembayaran/' . $bookings->payment->bukti_pembayaran) }}"
                             alt="Bukti Pembayaran" class="profile-img">

                        <!-- Buttons for confirmation and rejection -->
                        <div class="d-flex mt-3">
                            <form action="{{ route('dashboard-order.confirmPayment', $bookings->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-custom btn-confirm me-2">
                                    <i class="bi bi-check-circle"></i> Konfirmasi
                                </button>
                            </form>
                            <form action="{{ route('dashboard-order.rejectPayment', $bookings->id) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menolak pembayaran ini?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-custom btn-reject">
                                    <i class="bi bi-x-circle"></i> Tolak
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <p><em>Pembayaran belum dilakukan.</em></p>
                @endif
            </div>
        </div>
    </div>
@endsection
