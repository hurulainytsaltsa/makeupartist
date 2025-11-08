@extends('layouts.customer.main')
@section('title', 'MUA Profile')
@section('navMuaProfile', 'active')

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
    <div class="container">
        <h2 class="text-center profile-heading">Our Makeup Artists</h2>
        <div class="row g-4">
            @foreach ($mua_profiles as $mua)
                <div class="col-lg-4 col-md-6">
                    <div class="profile-card">
                        <img src="{{ asset('images/profile_photos/' . $mua->profile_photo) }}"
                            alt="Profile of {{ $mua->nama }}" class="profile-img">
                        <div class="profile-info">
                            <h4 class="profile-name">{{ $mua->nama }}</h4>
                            <p class="profile-description">
                                {{ $mua->pengalaman }} years of experience in {{ $mua->lokasi }}.
                            </p>
                            {{-- <a href="/ourprofile/{{ $mua->id }}" class="btn btn-profile">View More</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
