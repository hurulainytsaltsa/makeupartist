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

    .profile-card {
        max-width: 500px;
        margin: 50px auto;
        border-radius: 15px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        background-color: #fff;
    }

    .profile-card .card-header {
        background-color: #de8d9b;
        color: #fff;
        font-size: 1.5rem;
        text-align: center;
        font-weight: 600;
        font-size: 25px;
        font-family: "Poppins-SemiBold";
        text-transform: uppercase;
    }

    .profile-card .card-body {
        padding: 20px;
    }

    .profile-detail {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 15px 0;
        font-size: 1rem;
        color: #555;
        border: 2px solid #de8d9b;
        /* Light border for card */
        border-radius: 10px;
        /* Rounded corners */
        padding: 15px;
        /* Increase padding for larger card */

        margin-bottom: 15px;
        /* Space between cards */
    }

    .profile-detail i {
        font-size: 1.2rem;
        color: #ffb6c1;
        margin-right: 10px;
    }

    .profile-detail strong {
        margin-right: 5px;
    }


    .btn-edit-profile {
        display: block;
        width: 100%;
        margin-top: 20px;
        background-color: #de8d9b;
        color: #fff;
        border-radius: 25px;
    }

    .btn-edit-profile:hover {
        background-color: #c77a88;
    }
</style>

@section('content')
    <div class="profile-card card">
        <div class="card-header">
            User Profile
        </div>
        <div class="card-body">
            <div class="profile-detail">
                <i class="bi bi-person-fill"></i>
                <strong>Name :</strong> <span class="ms-2">{{ $user->name }}</span>
            </div>
            <div class="profile-detail">
                <i class="bi bi-person-badge-fill"></i>
                <strong>Username :</strong> <span class="ms-2">{{ $user->username }}</span>
            </div>
            <div class="profile-detail">
                <i class="bi bi-envelope-fill"></i>
                <strong>Email :</strong> <span class="ms-2">{{ $user->email }}</span>
            </div>
            <div class="profile-detail">
                <i class="bi bi-geo-alt-fill"></i>
                <strong>Alamat :</strong> <span class="ms-2">{{ $user->alamat }}</span>
            </div>
            <div class="profile-detail">
                <i class="bi bi-telephone-fill"></i>
                <strong>No Telp :</strong> <span class="ms-2">{{ $user->no_telp }}</span>
            </div>
            <a href="/account/{{ $user->id }}/edit" class="btn btn-edit-profile">Edit Profile</a>
        </div>
    </div>
@endsection
