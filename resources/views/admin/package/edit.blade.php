@extends('admin.layouts.main')
@section('title', 'Edit Our Package')
@section('navPackage', 'active')

@section('content')
<div class="container">
    <div class="row g-4">
        <h2 class="text-center profile-heading">Update Package Make Up To Up to Date</h2>
        <form action="/dashboard-package/{{ $paketMakeup->id }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="nama_paket" class="form-label">Nama Paket</label>
                <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" value="{{ old('nama_paket', $paketMakeup->nama_paket) }}" required>
                @error('nama_paket')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3" required>{{ old('deskripsi', $paketMakeup->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Range Harga</label>
                <textarea class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" rows="3" required>{{ old('harga', $paketMakeup->harga) }}</textarea>
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Photo</label>
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo">
                @if($paketMakeup->photo)
                    <img src="{{ asset('images/package/' . $paketMakeup->photo) }}" alt="Current photo" style="max-width: 150px; margin-top: 10px;">
                @endif
                @error('photo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-profile">Update Package</button>
        </form>
    </div>
</div>
@endsection
