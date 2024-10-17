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

    <div class="container">
        <div class="row g-4">
            <h2 class="text-center profile-heading">Update MakeUp Artist</h2>
            <form action="/ourprofile/{{ $mua->id }}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" value="{{ old('nama', $mua->nama) }}" required>
                    @error('nama')
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
                        id="portfolio_link" name="portfolio_link"
                        value="{{ old('portfolio_link', $mua->portfolio_link) }}" placeholder="https://example.com"
                        required>
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

    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2017–2024 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a>
        </p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
