@extends('admin.layouts.main')
@section('title', 'Add MUA Profile')
@section('navProfile', 'active')

@section('content')
<div class="container">
    <div class="row g-4">
        <h2 class="text-center profile-heading">Add New MUA Profile</h2>
        <form action="/dashboard-profile" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_mua" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama_mua" name="nama_mua" required>
            </div>
            <div class="mb-3">
                <label for="pengalaman" class="form-label">Pengalaman</label>
                <textarea class="form-control" id="pengalaman" name="pengalaman" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <textarea class="form-control" id="lokasi" name="lokasi" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="portfolio_link" class="form-label">Portfolio Link</label>
                <input type="url" class="form-control" id="portfolio_link" name="portfolio_link"
                    placeholder="https://example.com" required>
            </div>
            <div class="mb-3">
                <label for="profile_photo" class="form-label">Profile Photo</label>
                <input type="file" class="form-control" id="profile_photo" name="profile_photo">
            </div>
            <button type="submit" class="btn btn-primary btn-profile">Add MUA</button>
        </form>
    </div>
</div>
@endsection
