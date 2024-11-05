<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <title>Package Details</title>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentLocation = location.pathname;
            const menuItems = document.querySelectorAll("#navbar .nav-link");

            menuItems.forEach(item => {
                if (item.getAttribute("href") === currentLocation) {
                    item.classList.add("active");
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

        <h2 class="text-center mb-4">More Details For Our Package</h2>
        <div class="container">
            {{-- <h2 class="header">{{ $details->nama_paket }}</h2>
            <p><strong>Deskripsi:</strong> {{ $details->deskripsi }}</p>
            <p><strong>Harga:</strong> {{ $details->harga }}</p> --}}
            <h3>Details</h3>
            @if ($details->isEmpty())
                <p>No details available for this package.</p>
            @else
            <ul class="list-group">
                @foreach ($details as $detail)
                    <li class="list-group-item">
                        <h5>{{ $detail->name }}</h5>
                        <p>{{ $detail->description }}</p> <!-- Fixed variable name -->
                        <p><strong>Harga:</strong> {{ $detail->price }}</p>
                    </li>
                @endforeach
            </ul>
            @endif

            <a href="/package" class="btn btn-secondary mt-3">Back to Packages</a>
        </div>
    </div>

    <footer class="container footer">
        <div class="footer-content">
            <div class="footer-info">
                <h4>Contact Us</h4>
                <p>
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Utara, Jl. Cendrawasih Jl. Elang 2 No.17, Air Tawar Bar., Kec. Padang Utara, Kota Padang,
                        Sumatera Barat 25132</span>
                </p>
                <p>
                    <i class="fab fa-whatsapp"></i>
                    <a href="https://wa.me/081378326457">+6281378326457</a>
                </p>
                <p>
                    <i class="fab fa-instagram"></i>
                    <a href="https://instagram.com/ranikhaira_makeupart">@ranikhaira_makeupart</a>
                </p>
            </div>
            <div class="footer-map">
                <h4 style="color: #d75a6e">Find Us Here</h4>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15957.338410205926!2d100.33765230068948!3d-0.8921984999999991!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b90d472be851%3A0x6f7d3382f7567bd9!2sRani%20khaira%20makeup%20art!5e0!3m2!1sid!2sid!4v1729143177942!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div class="footer-bottom">
            <p class="float-end"><a href="#" class="back-to-top">Back to top</a></p>
            <p>&copy; 2017–2024 Company, Inc. &middot; <a href="#" class="footer-link">Privacy</a> &middot;
                <a href="#" class="footer-link">Terms</a>
            </p>
        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
