@extends('layouts.customer.main')
@section('title', 'Package')
@section('navPackage', 'active')

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
        height: 200px;
        object-fit: cover;
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

    .footer {
        background-color: #f8f9fa;
        padding: 20px;
        border-top: 2px solid #e9ecef;
        text-align: left;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .footer-info {
        flex: 1;
        margin-right: 20px;
    }

    .footer-info h4 {
        color: #d75a6e;
        margin-bottom: 10px;
    }

    .footer-info p {
        margin: 10px 0;
        display: flex;
        align-items: center;
        /* Align icon and text vertically */
    }

    .footer-info p i {
        margin-right: 10px;
        /* Spacing between icon and text */
        color: #d75a6e;
        /* Icon color */
    }

    .footer-info a {
        color: #d75a6e;
        text-decoration: none;
    }

    .footer-info a:hover {
        text-decoration: underline;
    }

    .footer-map {
        flex: 1;
        min-width: 300px;
    }

    .footer-map iframe {
        width: 100%;
        height: 200px;
        border: none;
    }

    .footer-bottom {
        text-align: center;
        margin-top: 20px;
    }

    .float-end {
        float: right;
    }

</style>

@section('content')
    <div class="container">
        <div class="fade-in">
            <h2 class="text-center mb-4">More Details For Our Package</h2>

            @if ($details->isEmpty())
                <p>No details available.</p>
            @else
                <div class="container">
                    <h3>Packages</h3>
                    <div class="row">
                        @foreach ($details->where('type', 'package') as $detail)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center">{{ $detail->name }}</div>
                                    <div class="card-body">
                                        <p>{{ $detail->description }}</p>
                                        @if ($detail->bonus)
                                            <p><strong>Bonus:</strong> {{ $detail->bonus }}</p>
                                        @endif
                                        <p><strong>Price:</strong> Rp. {{ number_format($detail->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <h3>Addons</h3>
                    <div class="row">
                        @foreach ($details->where('type', 'addon') as $detail)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center">{{ $detail->name }}</div>
                                    <div class="card-body">
                                        <p><strong>Price:</strong> Rp. {{ number_format($detail->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <h3>Services</h3>
                    <div class="row">
                        @foreach ($details->where('type', 'service') as $detail)
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-header text-center">{{ $detail->name }}</div>
                                    <div class="card-body">
                                        <p><strong>Price:</strong> Rp. {{ number_format($detail->price, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            <a href="/package" class="btn btn-secondary mt-3">Back to Packages</a>
        </div>
    </div>

  @endsection
