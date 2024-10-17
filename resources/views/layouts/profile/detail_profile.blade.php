<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>MUA Profiles</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts for more chic typography -->
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
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
    </style>

    {{-- Script for Navbar Active --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentLocation = location.pathname; // Ambil URL halaman saat ini
            const menuItems = document.querySelectorAll("#navbar .nav-link"); // Pilih semua item navbar

            // Iterasi setiap item navbar untuk mencocokkan URL
            menuItems.forEach(item => {
                if (item.getAttribute("href") === currentLocation) {
                    item.classList.add("active"); // Tambahkan kelas 'active' jika cocok dengan URL
                }
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <header class="border-bottom lh-1 py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="link-secondary" href="#">About</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-body-emphasis text-decoration-none" href="#">Makeup by
                        Rani</a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="link-secondary" href="#" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                            stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="mx-3" role="img" viewBox="0 0 24 24">
                            <title>Search</title>
                            <circle cx="10.5" cy="10.5" r="7.5" />
                            <path d="M21 21l-5.2-5.2" />
                        </svg>
                    </a>
                    <a class="btn btn-sm btn-outline-secondary" href="/login">Sign up</a>
                </div>
            </div>
        </header>

        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-between" id="navbar">
                <a class="nav-item nav-link link-body-emphasis" href="/home">Home</a>
                <a class="nav-item nav-link link-body-emphasis" href="/portfolio">Portfolio</a>
                <a class="nav-item nav-link link-body-emphasis" href="/booking">Booking</a>
                <a class="nav-item nav-link link-body-emphasis" href="/about">About Us</a>
                <a class="nav-item nav-link link-body-emphasis" href="/package">Package</a>
                <a class="nav-item nav-link link-body-emphasis" href="/ourprofile">Our Profile</a>
                <a class="nav-item nav-link link-body-emphasis" href="/account">My Account</a>
            </nav>
        </div>
    </div>

    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="profile-card">
                <img src="{{ asset('images/profile_photos/' . $mua->profile_photo) }}" alt="Profile of {{ $mua->nama }}" class="profile-img">
                <div class="profile-info text-center">
                    <h2 class="profile-name">{{ $mua->nama }}</h2>
                    <p class="profile-description">
                        {{ $mua->pengalaman }} years of experience based in {{ $mua->lokasi }}.
                    </p>
                    <p class="profile-description">
                        {{ $mua->description }} <!-- Add description or bio if needed -->
                    </p>
                    <a href="/portfolio" class="btn btn-profile">View Portfolio</a>

                    <!-- Buttons for Edit and Delete -->
                    <div class="mt-3">
                        <a href="/ourprofile/{{ $mua->id }}/edit" class="btn btn-primary">Edit Profile</a>
                        <form action="/ourprofile/{{ $mua->id }}" method="post" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this profile?');">
                                Delete Profile
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <p>
                <strong>Instagram:</strong>
                <a href="{{ $mua->portfolio_link }}" target="_blank">
                    <i class="fab fa-instagram"></i> {{ $mua->portfolio_link }}
                </a>
            </p>

            <!-- Additional MUA details -->
            <div class="mt-4">
                <h4>About {{ $mua->nama }}</h4>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vehicula orci ut dui placerat, eget bibendum ipsum pharetra.
                </p>
            </div>
        </div>
    </div>
</div>

    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2017–2024 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
        </p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


