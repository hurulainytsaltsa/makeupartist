@extends('admin.layouts.main')
@section('title', 'Details Profile')
@section('navProfile', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
        <div class="profile-card">
            <img src="{{ asset('images/profile_photos/' . $mua->profile_photo) }}" alt="Profile of {{ $mua->nama }}" class="profile-img">
            <div class="profile-info text-center">
                <h2 class="profile-name">{{ $mua->nama }}</h2>
                <p class="profile-description">
                    {{ $mua->pengalaman }} years of experience based in {{ $mua->lokasi }}.
                </p>
                <p class="profile-description">
                    {{ $mua->description }} <!-- Add description or bio if needed -->
                </p>
                <a href="/dashboard-portfolio" class="btn btn-primary btn-profile">MUA Portfolio</a>
            </div>
        </div>

        <p>
            <strong>Instagram:</strong>
            <a href="{{ $mua->portfolio_link }}" target="_blank">
                <i class="fab fa-instagram"></i> {{ $mua->portfolio_link }}
            </a>
        </p>

        <!-- Additional MUA details -->
        <div class="mt-4">
            <h4>About {{ $mua->nama }}</h4>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula orci ut dui placerat, eget bibendum ipsum pharetra.
            </p>
        </div>
    </div>
</div>
@endsection
