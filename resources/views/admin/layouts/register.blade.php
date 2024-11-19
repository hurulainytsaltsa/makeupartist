@extends('admin.layouts.main')
@section('title', 'Add User')
@section('navRegister', 'active')

@section('content')
<div class="container">
    <div class="row g-4">
        <h2 class="text-center profile-heading">Add New User</h2>
        <form method="post" action="/dashboard-register" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <input type="text" name="name" placeholder="Nama" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" style="border-color: #ffffff">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="text" name="username" placeholder="Username" class="form-control @error('username') is-invalid @enderror" style="border-color: #ffffff">
                @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" style="border-color: #ffffff">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <textarea name="alamat" placeholder="Alamat" class="form-control @error('alamat') is-invalid @enderror" style="border-color: #ffffff"></textarea>
                @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="text" name="no_telp" placeholder="Nomor Telepon" class="form-control @error('no_telp') is-invalid @enderror" style="border-color: #ffffff">
                @error('no_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" style="border-color: #ffffff">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control @error('password_confirmation') is-invalid @enderror" style="border-color: #ffffff">
                @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2">Register</button>
        </form>
    </div>
</div>
@endsection
