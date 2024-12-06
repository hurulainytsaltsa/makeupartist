@extends('layouts.customer.main')
@section('title', 'Booking')
@section('navBooking', 'active')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f7f7f7;
        color: #333;
    }

    h2 {
        font-family: 'Playfair Display', serif;
        color: #de8d9b;
        font-size: 2.5rem;
    }

    .profile-card {
        background-color: #fff;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s ease-in-out;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .profile-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-bottom: 2px solid #de8d9b;
    }

    .profile-info {
        padding: 20px;
        text-align: center;
    }

    .profile-name {
        font-size: 1.5rem;
        font-family: 'Playfair Display', serif;
        font-weight: 500;
        color: #333;
    }

    .profile-description {
        color: #777;
        font-size: 0.9rem;
        margin-top: 10px;
        margin-bottom: 15px;
    }

    .btn-profile {
        background-color: #de8d9b;
        color: #fff;
        border-radius: 30px;
        padding: 10px 30px;
        text-transform: uppercase;
        font-size: 0.9rem;
        transition: background-color 0.3s;
    }

    .btn-profile:hover {
        background-color: #c77a88;
    }

    .container {
        margin-top: 50px;
    }

    .profile-heading {
        margin-bottom: 40px;
    }

    .footer {
        background-color: #f8f9fa;
        padding: 20px;
        border-top: 2px solid #e9ecef;
        text-align: left;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .footer-info {
        flex: 1;
        margin-right: 20px;
    }

    .footer-info h4 {
        color: #d75a6e;
        margin-bottom: 10px;
    }

    .footer-info p {
        margin: 10px 0;
        display: flex;
        align-items: center;
        /* Align icon and text vertically */
    }

    .footer-info p i {
        margin-right: 10px;
        /* Spacing between icon and text */
        color: #d75a6e;
        /* Icon color */
    }

    .footer-info a {
        color: #d75a6e;
        text-decoration: none;
    }

    .footer-info a:hover {
        text-decoration: underline;
    }

    .footer-map {
        flex: 1;
        min-width: 300px;
    }

    .footer-map iframe {
        width: 100%;
        height: 200px;
        border: none;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 20px;
    }

    .float-end {
        float: right;
    }
</style>

@section('content')
    <div class="container mt-5">
        <h2 class="text-center profile-heading">Booking</h2>
        <div class="text-end mb-4">
            <a href="/booking/create" class="btn btn-profile">Booking Now!</a>
        </div>
        <table class="table table-bordered" style="background-color: #ffffff;">
            <thead style="background-color: #f3b6c4; color: white;">
                <tr>
                    <th scope="col" style="color: white;">Nomor</th>
                    <th scope="col" style="color: white;">Nama</th>
                    <th scope="col" style="color: white;">Email</th>
                    <th scope="col" style="color: white;">Nomor Telepon</th>
                    <th scope="col" style="color: white;">Alamat</th>
                    <th scope="col" style="color: white;">Tanggal Makeup</th>
                    <th scope="col" style="color: white;">Jam</th>
                    <th scope="col" style="color: white;">Paket Makeup</th>
                    <th scope="col" style="color: white;">Jenis Paket</th>
                    <th scope="col" style="color: white;">Payment</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop data booking di sini -->
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
                            <a href="{{ route('booking.show', $bookingItem->id) }}" class="btn btn-profile" style="margin-top: 10px; margin-bottom: 10px;">Pay Now</a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
