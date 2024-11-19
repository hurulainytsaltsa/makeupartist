@extends('admin.layouts.main')
@section('title', 'Details Portfolio')
@section('navPortfolio', 'active')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <!-- Card Wrapper -->
            <div class="card portofolio-card">
                <img src="{{ asset('images/gambar/' . $portofolio->gambar) }}" alt="Portofolio of {{ $portofolio->nama_mua }}"
                    class="card-img-top profile-img">

                <div class="card-body text-center">
                    <h1 class="card-title">{{ $portofolio->nama_mua }}</h1>
                    <p class="card-text text-muted">{{ $portofolio->review }}</p>

                    <a href="/dashboard-portfolio" class="btn btn-profile mb-3" style="width: 200px;">Back to Portfolio</a>
                </div>
            </div>
        </div>
    </div>
@endsection
