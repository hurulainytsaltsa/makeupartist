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

    .card {
        width: 100%;
        /* Pastikan card mengambil seluruh lebar container */
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #fff;
    }
</style>

@section('content')
    <div class="container mt-5">
        <div class="form-container">
            <h2 class="form-header text-center">Payment</h2>
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">

                    <div class="row mb-3">
                        <div class="col-md-4 text-muted"><strong>Nama</strong></div>
                        <div class="col-md-8">{{ $booking->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted"><strong>Email</strong></div>
                        <div class="col-md-8">{{ $booking->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted"><strong>No Telepon</strong></div>
                        <div class="col-md-8">{{ $booking->no_telp }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted"><strong>Alamat</strong></div>
                        <div class="col-md-8">{{ $booking->alamat }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted"><strong>Tanggal MakeUp</strong></div>
                        <div class="col-md-8">{{ $booking->tgl_makeup }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted"><strong>Jam</strong></div>
                        <div class="col-md-8">{{ $booking->jam }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted"><strong>Paket MakeUp</strong></div>
                        <div class="col-md-8">{{ $booking->packagesMakeUp->nama_paket }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted"><strong>Jenis MakeUp</strong></div>
                        <div class="col-md-8">{{ $booking->detailsMakeUp->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 text-muted"><strong>Harga Paket</strong></div>
                        <div class="col-md-8">
                            Rp{{ number_format($booking->price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('booking.payment', $booking->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                <div class="mb-3">
                    <label for="no_rekening" class="form-label">Pilih Nomor Rekening:</label>
                    <select class="form-select" id="no_rekening" name="no_rekening" required>
                        <option value="" disabled selected>Pilih Rekening</option>
                        <option value="56792372343 - Bank BRI">56792372343 - Bank BRI</option>
                        <option value="98765482637 - Bank BCA">98765482637 - Bank BCA</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bukti_pembayaran" class="form-label">Unggah Bukti Pembayaran:</label>
                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran"
                        accept="image/*" required>
                </div>


                <button type="submit" class="btn btn-custom w-100 mt-3">Bayar</button>
            </form>
        </div>
    </div>


@endsection
