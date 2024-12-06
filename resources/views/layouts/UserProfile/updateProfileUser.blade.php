@extends('layouts.customer.main')
@section('title', 'Profile')
@section('navProfiles', 'active')

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
</style>

@section('content')
    <div class="container">
        <h2>Edit Profile</h2>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="/account/{{ $user->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                    name="alamat" value="{{ old('alamat', $user->alamat) }}" required>
                @error('alamat')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="no_telp" class="form-label">No Telepon</label>
                <input type="text" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                    name="no_telp" value="{{ old('no_telp', $user->no_telp) }}" required>
                @error('no_telp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary btn-profile">Update</button>
        </form>
    </div>
@endsection
