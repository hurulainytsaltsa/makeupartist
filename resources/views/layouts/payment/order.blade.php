@extends('layouts.customer.main')
@section('title', 'Order')
@section('navOrder', 'active')


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

    .profile-card {
        max-width: 500px;
        margin: 50px auto;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        background-color: #fff;
    }

    .profile-card .card-header {
        background-color: #de8d9b;
        color: #fff;
        font-size: 1.5rem;
        text-align: center;
        font-weight: 600;
        font-size: 25px;
        font-family: "Poppins-SemiBold";
        text-transform: uppercase;
    }

    .profile-card .card-body {
        padding: 20px;
        width: max-content;
    }

    .profile-detail {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 15px 0;
        font-size: 1rem;
        color: #555;
        border: 2px solid #de8d9b;
        /* Light border for card */
        border-radius: 10px;
        /* Rounded corners */
        padding: 15px;
        /* Increase padding for larger card */

        margin-bottom: 15px;
        /* Space between cards */
    }

    .profile-detail i {
        font-size: 1.2rem;
        color: #ffb6c1;
        margin-right: 10px;
    }

    .profile-detail strong {
        margin-right: 5px;
    }


    .btn-edit-profile {
        display: block;
        width: 100%;
        margin-top: 20px;
        background-color: #de8d9b;
        color: #fff;
        border-radius: 25px;
    }

    .btn-edit-profile:hover {
        background-color: #c77a88;
    }

    .form-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-header {
        color: #de8d9b;
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    .btn-custom {
        background-color: #de8d9b;
        color: #fff;
        border-radius: 30px;
        padding: 10px 20px;
    }

    .btn-custom:hover {
        background-color: #c77a88;
    }

    .dropdown-item.active {
        background-color: #de8d9b !important;
        color: #fff !important;
    }

    h2 {
        font-family: 'Playfair Display', serif;
        color: #de8d9b;
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 30px;
        letter-spacing: 1px;
    }

    .profile-card {
        max-width: 500px;
        margin: 20px auto;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .profile-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .profile-img {
        width: 100%;
        /* Membuat gambar responsif dan mengisi lebar kontainer */
        max-width: 400px;
        /* Menentukan lebar maksimum gambar */
        height: auto;
        /* Menjaga proporsi gambar */
        object-fit: cover;
        /* Memastikan gambar tetap mengisi area tanpa distorsi */
        border-bottom: 2px solid #de8d9b;
    }

    .profile-info {
        padding: 15px;
        text-align: center;
    }

    .profile-name {
        font-size: 1.4rem;
        color: #333;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .profile-description {
        color: #777;
        font-size: 0.95rem;
        margin-bottom: 15px;
    }

    .btn-profile {
        background-color: #de8d9b;
        color: white;
        padding: 8px 20px;
        border-radius: 25px;
        font-size: 0.9rem;
        text-transform: uppercase;
        transition: 0.3s ease-in-out;
    }

    .btn-profile:hover {
        background-color: #c77a88;
        color: #fff;
    }

    .card {
        border: 1px solid #ddd;
        border-radius: 10px;
        margin-bottom: 15px;
        padding: 15px;
    }


    .card h5 {
        font-size: 1.2rem;
        color: #de8d9b;
        margin-bottom: 10px;
    }

    .card p {
        margin: 5px 0;
        color: #555;
        font-size: 0.95rem;
    }

    img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        margin-top: 10px;
    }
</style>

@section('content')
<div class="container">
    <h2 class="text-center">Order Confirmation</h2>
    @foreach ($bookings as $booking)
        <div class="card mb-4">
            <div class="card-body">
                <h5>Booking Details:</h5>
                <p><strong>Nama:</strong> {{ $booking->nama }}</p>
                <p><strong>Email:</strong> {{ $booking->email }}</p>
                <p><strong>No. Telepon:</strong> {{ $booking->no_telp }}</p>
                <p><strong>Alamat:</strong> {{ $booking->alamat }}</p>
                <p><strong>Tanggal Makeup:</strong> {{ $booking->tgl_makeup }}</p>
                <p><strong>Jam:</strong> {{ $booking->jam }}</p>
                <p><strong>Paket Makeup:</strong> {{ $booking->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket' }}
                </p>
                <p><strong>Jenis Paket:</strong> {{ optional($booking->DetailsMakeUp)->name ?? 'Tidak Ada Paket' }}
                </p>
                <p><strong>Price:</strong> {{ $booking->price }}</p>

                <!-- Data Pembayaran -->
                @if ($booking->payment)
                    <div class="mt-4">
                        <h5>Payment Details:</h5>
                        <p><strong>No. Rekening:</strong> {{ $booking->payment->no_rekening }}</p>
                        <p><strong>Status Pembayaran:</strong> {{ $booking->payment->status_pembayaran }}</p>
                        <p><strong>Bukti Pembayaran:</strong></p>
                        <img src="{{ asset('images/bukti_pembayaran/' . $booking->payment->bukti_pembayaran) }}"
                            alt="Bukti Pembayaran" class="profile-img">
                    </div>
                @else
                    <p><em>Pembayaran belum dilakukan.</em></p>
                @endif
            </div>
        </div>
    @endforeach


</div>
@endsection
