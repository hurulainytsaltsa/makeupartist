@extends('admin.layouts.main')
@section('title', 'Edit Portfolio')
@section('navPortfolio', 'active')

@section('content')
    <div class="container">
        <div class="row g-4">
            <h2 class="text-center profile-heading">Update MakeUp Artist</h2>
            <form action="/dashboard-profile/{{ $mua->id }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mb-3">
                    <label for="nama_mua" class="form-label">Nama MUA</label>
                    <input type="text" class="form-control @error('nama_mua') is-invalid @enderror" id="nama_mua"
                        name="nama_mua" value="{{ old('nama_mua', $mua->nama_mua) }}" required>
                    @error('nama_mua')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pengalaman" class="form-label">Pengalaman</label>
                    <textarea class="form-control @error('pengalaman') is-invalid @enderror" id="pengalaman" name="pengalaman"
                        rows="3" required>{{ old('pengalaman', $mua->pengalaman) }}</textarea>
                    @error('pengalaman')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <textarea class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" rows="3"
                        required>{{ old('lokasi', $mua->lokasi) }}</textarea>
                    @error('lokasi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="portfolio_link" class="form-label">Portfolio Link</label>
                    <input type="url" class="form-control @error('portfolio_link') is-invalid @enderror"
                        id="portfolio_link" name="portfolio_link" value="{{ old('portfolio_link', $mua->portfolio_link) }}"
                        placeholder="https://example.com" required>
                    @error('portfolio_link')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="profile_photo" class="form-label">Profile Photo</label>

                    <!-- Input for new profile photo -->
                    <input type="file" class="form-control @error('profile_photo') is-invalid @enderror"
                        id="profile_photo" name="profile_photo">

                    <!-- Display the previously uploaded profile photo if it exists -->
                    @if ($mua->profile_photo)
                        <div class="mt-3">
                            <img src="{{ asset('images/profile_photos/' . $mua->profile_photo) }}" alt="Profile Photo"
                                class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                            {{-- <p class="mt-2">Current file: {{ $mua->profile_photo }}</p> --}}
                        </div>
                    @endif

                    <!-- Display error message if validation fails -->
                    @error('profile_photo')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-profile">Update MUA</button>
            </form>
        </div>
    </div>

@endsection
