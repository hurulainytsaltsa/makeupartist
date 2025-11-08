@extends('layouts.customer.main')
@section('title', 'Booking')
@section('navBooking', 'active')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fef6f8;
        color: #333;
    }

    h2 {
        font-family: 'Playfair Display', serif;
        color: #de8d9b;
        font-size: 2.5rem;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .btn-profile {
        background-color: #de8d9b;
        color: #fff;
        border-radius: 30px;
        padding: 10px 30px;
        text-transform: uppercase;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-profile:hover {
        background-color: #c77a88;
        transform: translateY(-3px);
    }

    .profile-heading {
        text-align: center;
        margin-bottom: 40px;
    }

    .table-responsive {
        margin-top: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
        color: white;
    }

    table {
        background-color: #ffffff;
    }

    thead {
        background-color: #de8d9b;
        color: white !important;
        text-transform: uppercase;
        font-size: 0.9rem;
    }

    th, td {
        text-align: center;
        vertical-align: middle;
        font-size: 0.9rem;
    }

    tbody tr {
        transition: all 0.3s ease;
    }

    tbody tr:hover {
        background-color: #fde4eb;
        transform: scale(1.02);
    }

    .center-cell a {
        font-size: 0.8rem;
        padding: 8px 20px;
    }

    .container {
        padding: 20px;
    }

    @media (max-width: 768px) {
        h2 {
            font-size: 2rem;
        }

        .btn-profile {
            font-size: 0.8rem;
            padding: 8px 20px;
        }

        th, td {
            font-size: 0.8rem;
        }

        .table-responsive {
            overflow-x: auto;
            color: white;
            background-color: #fef6f8;
        }
    }
</style>

@section('content')
    <div class="container mt-5">
        <h2 class="profile-heading">Booking</h2>
        <div class="text-end mb-4">
            <a href="/booking/create" class="btn btn-profile">Booking Now!</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="color: white;">No</th>
                        <th style="color: white;">Nama</th>
                        <th style="color: white;">Email</th>
                        <th style="color: white;">Nomor Telepon</th>
                        <th style="color: white;">Alamat</th>
                        <th style="color: white;">Tanggal Makeup</th>
                        <th style="color: white;">Jam</th>
                        <th style="color: white;">Paket Makeup</th>
                        <th style="color: white;">Jenis Paket</th>
                        <th style="color: white;">Payment</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($booking as $key => $bookingItem)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $bookingItem->nama }}</td>
                            <td>{{ $bookingItem->email }}</td>
                            <td>{{ $bookingItem->no_telp }}</td>
                            <td>{{ $bookingItem->alamat }}</td>
                            <td>{{ $bookingItem->tgl_makeup }}</td>
                            <td>{{ $bookingItem->jam }}</td>
                            <td>{{ $bookingItem->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket' }}</td>
                            <td>{{ optional($bookingItem->DetailsMakeUp)->name ?? 'Tidak Ada Paket' }}</td>
                            <td class="center-cell">
                                <a href="{{ route('booking.show', $bookingItem->id) }}" class="btn btn-profile">Pay Now</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
