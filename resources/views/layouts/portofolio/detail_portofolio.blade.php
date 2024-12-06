@extends('layouts.customer.main')
@section('title', 'Portfolio')
@section('navPortfolio', 'active')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f7f7f7;
        color: #333;
    }

    h1 {
        font-family: 'Playfair Display', serif;
        color: #de8d9b;
        text-align: center;
        margin-top: 20px;
    }

    .profile-card {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-top: 30px;
    }

    .profile-img {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-bottom: 4px solid #de8d9b;
    }

    .profile-info {
        padding: 20px;
        text-align: center;
    }

    .btn-profile {
        background-color: #de8d9b;
        color: white;
        border-radius: 30px;
        text-transform: uppercase;
        transition: background-color 0.3s ease-in-out;
        margin-top: 20px;
    }

    .btn-profile:hover {
        background-color: #c77a88;
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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Card Wrapper -->
            <div class="card portofolio-card">
                <img src="{{ asset('images/gambar/' . $portofolio->gambar) }}" alt="Portofolio of {{ $portofolio->nama_mua }}"
                    class="card-img-top profile-img">

                <div class="card-body text-center">
                    <h1 class="card-title">{{ $portofolio->nama_mua }}</h1>
                    <p class="card-text text-muted">{{ $portofolio->review }}</p>

                    <a href="/portfolio" class="btn btn-profile mb-3" style="width: 200px;">Back to Portfolio</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
