@extends('admin.layouts.main')
@section('title', 'Add New Offers')
@section('navPackage', 'active')

@section('content')
    <div class="container">
        <div class="row g-4">
            <h2 class="text-center profile-heading">Add New Offer for {{ $package->nama_paket }}</h2>
            <form action="{{ route('dashboard-details_package.store') }}" method="POST">
                @csrf
                <!-- Kirimkan package_makeup_id yang dipilih -->
                <input type="hidden" name="package_makeup_id" value="{{ $package->id }}">

                <!-- Nama Paket -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                        rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Type -->
                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="">Select Type</option>
                        <option value="package" {{ old('type') == 'package' ? 'selected' : '' }}>Package</option>
                        <option value="addon" {{ old('type') == 'addon' ? 'selected' : '' }}>Addon</option>
                        <option value="service" {{ old('type') == 'service' ? 'selected' : '' }}>Service</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <textarea class="form-control @error('price') is-invalid @enderror" id="price" name="price" rows="3"
                        required>{{ old('price') }}</textarea>
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Bonus -->
                <div class="mb-3">
                    <label for="bonus" class="form-label">Bonus</label>
                    <textarea class="form-control @error('bonus') is-invalid @enderror" id="bonus" name="bonus" rows="3"
                        required>{{ old('bonus') }}</textarea>
                    @error('bonus')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-profile">Add Package</button>
            </form>
        </div>
    </div>
@endsection
