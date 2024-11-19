@extends('admin.layouts.main')
@section('title', 'Add Porfolio')
@section('navPortfolio', 'active')

@section('content')
<div class="container">
    <div class="row g-4">
        <h2 class="text-center profile-heading">Add New Portfolio</h2>
        <form action="/dashboard-portfolio" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_mua" class="form-label">Nama MUA</label>
                <input type="text" class="form-control" id="nama_mua" name="nama_mua" required>
            </div>
            <div class="mb-3">
                <label for="review" class="form-label">Review</label>
                <textarea class="form-control" id="review" name="review" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Portofolio Photo</label>
                <input type="file" class="form-control" id="gambar" name="gambar">
            </div>
            <button type="submit" class="btn btn-primary btn-profile">Add Portofolio</button>
        </form>
    </div>
</div>
@endsection
