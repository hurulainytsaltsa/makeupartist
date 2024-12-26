@extends('admin.layouts.main')
@section('title', 'Details Profile')
@section('navProfile', 'active')

@section('content')
    <div class="row justify-content-center mt-5">
        <style>
            .profile-card {
                background-color: #fff;
                padding: 20px;
                border-radius: 15px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            .profile-img {
                width: 150px;
                height: 150px;
                border-radius: 50%;
                object-fit: cover;
                margin-bottom: 15px;
                border: 4px solid #ddd;
            }

            .profile-name {
                font-size: 24px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .profile-description {
                color: #c5a4a4;
                font-size: 16px;
                margin-bottom: 10px;
            }

            .btn-profile {
                margin-top: 15px;
                font-size: 16px;
                padding: 10px 20px;
                border-radius: 30px;
            }

            .profile-info a {
                text-decoration: none;
                color: #ffffff;
            }

            .profile-info a:hover {
                text-decoration: #e4405f;
            }

            .profile-info i {
                margin-right: 5px;
                color: #e4405f;
            }

            .about-section {
                margin-top: 30px;
                padding: 20px;
                border-top: 1px solid #ddd;
            }

            .about-section h4 {
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 15px;
            }

            .btn-custom {
                background-color: #6f42c1;
                /* Warna ungu */
                color: white;
            }

            .btn-custom:hover {
                background-color: #5a32a3;
                /* Warna ungu gelap saat hover */
                color: white;
            }
        </style>

        <div class="col-lg-8 col-md-10">
            <div class="profile-card">
                <img src="{{ asset('images/profile_photos/' . $mua->profile_photo) }}" alt="Profile of {{ $mua->nama }}"
                    class="profile-img">
                <div class="profile-info">
                    <h2 class="profile-name">{{ $mua->nama }}</h2>
                    <p class="profile-description">
                        {{ $mua->pengalaman }} years of experience based in {{ $mua->lokasi }}.
                    </p>
                    <p class="profile-description">
                        {{ $mua->description }}
                    </p>
                    <a href="/dashboard-portfolio" class="btn btn-primary btn-profile">
                        View Portfolio
                    </a>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <a href="javascript:window.history.back();" class="btn btn-custom mt-3">Kembali</a>


            <div class="mt-4 text-center">
                <p>
                    <strong>Instagram:</strong>
                    <a href="{{ $mua->portfolio_link }}" target="_blank">
                        <i class="fab fa-instagram"></i> {{ $mua->portfolio_link }}
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
