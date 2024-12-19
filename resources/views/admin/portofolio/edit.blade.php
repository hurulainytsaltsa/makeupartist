@extends('admin.layouts.main')
@section('title', 'Edit Portfolio')
@section('navPortfolio', 'active')

@section('content')
<div class="container">
    <div class="row g-4">
        <h2 class="text-center profile-heading">Update MakeUp Artist</h2>
        <form action="/dashboard-portfolio/{{ $portofolio->id }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="nama_mua" class="form-label">Nama MUA</label>
                <select class="form-control" id="nama_mua" name="nama_mua" required>
                    <option value="" disabled>Pilih Nama MUA</option>
                    @foreach ($muaProfiles as $mua)
                        <option value="{{ $mua->nama_mua }}"
                            {{ (old('nama_mua') ?? $portofolio->nama_mua) == $mua->nama_mua ? 'selected' : '' }}>
                            {{ $mua->nama_mua }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea class="form-control @error('review') is-invalid @enderror" id="review" name="review" rows="3"
                    required>{{ old('review', $portofolio->review) }}</textarea>
                @error('review')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="gambar" class="form-label">Portfolio Photo</label>

                <!-- Input for new profile photo -->
                <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                    id="gambar" name="gambar">

                <!-- Display the previously uploaded profile photo if it exists -->
                @if ($portofolio->gambar)
                    <div class="mt-3">
                        <img src="{{ asset('images/gambar/' . $portofolio->gambar) }}" alt="gambar"
                            class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                        {{-- <p class="mt-2">Current file: {{ $mua->profile_photo }}</p> --}}
                    </div>
                @endif

                <!-- Display error message if validation fails -->
                @error('gambar')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-profile">Update Portfolio MUA</button>
        </form>
    </div>
</div>
@endsection
