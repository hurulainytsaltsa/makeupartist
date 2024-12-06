@extends('layouts.customer.main')
@section('title', 'Portfolio')
@section('navPortfolio', 'active')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9f9f9;
        color: #333;
    }

    h2 {
        font-family: 'Playfair Display', serif;
        color: #de8d9b;
        margin-bottom: 40px;
    }

    .profile-card {
        background-color: #fff;
        border-radius: 15px;
        overflow: hidden;
        transition: 0.4s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .profile-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .profile-img {
        width: 100%;
        height: 350px;
        object-fit: cover;
    }

    .profile-info {
        padding: 20px;
        text-align: center;
    }

    .profile-name {
        font-size: 1.8rem;
        font-family: 'Playfair Display', serif;
        margin-bottom: 5px;
    }

    .review-text {
        color: #777;
        font-style: italic;
        margin: 10px 0;
    }

    .btn-profile {
        background-color: #de8d9b;
        color: #fff;
        border-radius: 30px;
        padding: 10px 25px;
        text-transform: uppercase;
        transition: background-color 0.3s;
    }

    .btn-profile:hover {
        background-color: #c77a88;
    }

    .container {
        margin-top: 50px;
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
        <h2 class="text-center">Our Makeup Artists Portfolio</h2>
        <div class="row g-4">
            @foreach ($portofolio as $mua)
                <div class="col-lg-4 col-md-6">
                    <div class="profile-card">
                        <img src="{{ asset('images/gambar/' . $mua->gambar) }}" alt="Portfolio of {{ $mua->nama_mua }}"
                            class="profile-img">

                        <div class="profile-info">
                            <h4 class="profile-name">{{ $mua->nama_mua }}</h4>
                            <p class="review-text">"{{ $mua->review }}"</p>
                            <a href="/portfolio/{{ $mua->id }}" class="btn btn-profile">View Portfolio</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
