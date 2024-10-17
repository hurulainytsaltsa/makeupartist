<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="/js/color-modes.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Carousel Template · Bootstrap v5.3</title>

    {{-- <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/"> --}}

    {{-- Comment --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="/css/font.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/5.3/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/5.3/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/5.3/assets/img/favicons/safari-pinned-tab.svg" color="#712cf9">
    <link rel="icon" href="/docs/5.3/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#712cf9">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .font {
            text-transform: uppercase;
            font-size: 25px;
            font-family: "Poppins-SemiBold";
            text-align: center;
            margin-bottom: 10px;
            margin-top: 10px;
        }

        .font-review {
            text-transform: uppercase;
            font-size: 30px;
            font-family: "Poppins-SemiBold";
            text-align: center;
            margin-bottom: 30px;

        }

        .card-img-top {
            width: 100%;
            /* Gambar mengikuti lebar card */
            height: auto;
            /* Tinggi mengikuti rasio asli */
            object-fit: cover;
            /* Isi card tanpa merusak rasio */
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
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

        .footer-bottom {
            text-align: center;
            /* Center-align text */
            margin-top: 20px;
            padding: 10px 0;
            /* Add padding for spacing */
            background-color: #f1f1f1;
            /* Light background color */
            border-top: 2px solid #e9ecef;
            /* Add a top border */
            font-size: 14px;
            /* Adjust font size */
        }

        .footer-bottom p {
            margin: 0;
            /* Remove default margin */
        }

        .float-end {
            float: right;
            /* Float to the right */
        }

        .back-to-top {
            color: #d75a6e;
            /* Color for the link */
            text-decoration: none;
            /* Remove underline */
            font-weight: bold;
            /* Make the text bold */
            margin-right: 20px;
            /* Add margin to the right */
            transition: color 0.3s ease;
            /* Smooth color transition */
        }

        .back-to-top:hover {
            color: #a72c4d;
            /* Darker color on hover */
        }

        .footer-link {
            color: #d75a6e;
            /* Link color */
            text-decoration: none;
            /* Remove underline */
            transition: color 0.3s ease;
            /* Smooth color transition */
        }

        .footer-link:hover {
            color: #a72c4d;
            /* Darker color on hover */
            text-decoration: underline;
            /* Add underline on hover */
        }



        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }


        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .section-title {
            text-align: center;
            color: #d75a6e;
            font-size: 30px;
            margin-bottom: 40px;
        }

        .cards-row {
            display: flex;
            justify-content: space-around;
            gap: 20px;
        }

        .card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 80%;
            text-align: center;
            padding: 30px;
            transition: transform 0.3s ease;
            margin-bottom: 30px;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .icon-wrapper {
            background-color: #ffe4e9;
            padding: 20px;
            border-radius: 70%;
            display: inline-block;
            margin-bottom: 20px;
        }

        .icon-wrapper-i {
            font-size: 90px;
            /* Adjust the size of the icon as needed */
            color: #ffc1cb;
            /* Change this to your desired color */
        }

        .card-title {
            font-size: 22px;
            color: #d75a6e;
            margin-bottom: 15px;
            font-family: "Poppins-SemiBold";
        }

        .card-text {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ffc1cb;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #d75a6e;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>
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

    <!-- Custom styles for this template -->
    <link href="/css/carousel.css" rel="stylesheet">
</head>

<body>
    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="check2" viewBox="0 0 16 16">
            <path
                d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path
                d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path
                d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path
                d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>

    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button"
            aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark"
                    aria-pressed="false">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto"
                    aria-pressed="true">
                    <svg class="bi me-2 opacity-50" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>

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

    <main class="container">

        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/headline.png" class="card-img-top" alt="">
                    <rect width="100%" height="90%" fill="var(--bs-secondary-color)" />
                    </svg>
                    <div class="container">
                        {{-- <div class="carousel-caption">
                            <div class="card" style="width: 100%;">
                                <img src="images/headline2.png" class="card-img-top" >
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/headline2.png" class="card-img-top1" alt="">
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
                    </svg>
                    <div class="container">
                        {{-- <div class="carousel-caption">
                            <h1>Another example headline.</h1>
                            <p>Some representative placeholder content for the second slide of the carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>
                        </div> --}}
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/headline3.png" class="card-img-top1" alt="">
                    <rect width="100%" height="100%" fill="var(--bs-secondary-color)" />
                    </svg>
                    <div class="container">
                        {{-- <div class="carousel-caption text-end">
                            <h1>One more for good measure.</h1>
                            <p>Some representative placeholder content for the third slide of this carousel.</p>
                            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>
                        </div> --}}
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <!-- Marketing messaging and featurettes
  ================================================== -->
        <!-- Wrap the rest of the page in another container to center all the content. -->

        <div class="container marketing">

            <!-- Three columns of text below the carousel -->
            <div class="row">
                <div class="col-lg-4">
                    <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                        preserveAspectRatio="xMidYMid slice" focusable="true">
                        <defs>
                            <clipPath id="circleView">
                                <circle cx="70" cy="70" r="70" />
                            </clipPath>
                        </defs>
                        <image href="images/graduation.jpg" width="140" height="140"
                            clip-path="url(#circleView)" preserveAspectRatio="xMidYMid slice" />
                    </svg>
                    <h2 class="font" style="color: #d75a6e">Graduation Makeup</h2>
                    <p>Our Graduation Makeup service is designed to enhance your natural beauty while giving you a
                        flawless, long-lasting look for your big day.</p>
                    <p><a class="btn btn-secondary" href="#"
                            style="background-color: #ffc1cb; border-color:#ffc1cb">View details
                            &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                        preserveAspectRatio="xMidYMid slice" focusable="true">
                        <defs>
                            <clipPath id="circleView">
                                <circle cx="70" cy="70" r="70" />
                            </clipPath>
                        </defs>
                        <image href="images/wedding.jpg" width="140" height="140" clip-path="url(#circleView)"
                            preserveAspectRatio="xMidYMid slice" />
                    </svg>
                    <h2 class="font" style="color: #d75a6e">Wedding Makeup</h2>
                    <p>Our wedding makeup services are designed to create a flawless, long-lasting look that enhances
                        your natural beauty on your special day.</p>
                    <p>
                        <a class="btn btn-secondary" href="#"
                            style="background-color: #ffc1cb; border-color:#ffc1cb">View details
                            &raquo;</a>
                    </p>
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-4">
                    <svg class="bd-placeholder-img rounded-circle" width="140" height="140"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder"
                        preserveAspectRatio="xMidYMid slice" focusable="true">
                        <defs>
                            <clipPath id="circleView">
                                <circle cx="70" cy="70" r="70" />
                            </clipPath>
                        </defs>
                        <image href="images/reguler.jpg" width="140" height="140" clip-path="url(#circleView)"
                            preserveAspectRatio="xMidYMid slice" />
                    </svg>
                    <h2 class="font" style="color: #d75a6e">Regular Makeup</h2>
                    <p>A simple and natural makeup look designed for everyday wear. It enhances your features with light
                        coverage and soft making it perfect for casual.</p>
                    <p><a class="btn btn-secondary" href="#"
                            style="background-color: #ffc1cb; border-color:#ffc1cb">View details
                            &raquo;</a></p>
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->


            <!-- START THE FEATURETTES -->

            <hr class="featurette-divider">

            <div class="row featurette">
                <h2 class="font-review" style="text-align: center; color:#d75a6e ">See What Our Clients Are Raving
                    About!</h2>
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">First featurette heading. <span
                            class="text-body-secondary">It’ll blow your mind.</span></h2>
                    <p class="lead">Some great placeholder content for the first featurette here. Imagine some
                        exciting prose here.</p>
                </div>
                <div class="col-md-5">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"
                        width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img"
                        aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" /><text x="50%" y="50%"
                            fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                    </svg>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7 order-md-2">
                    <h2 class="featurette-heading fw-normal lh-1">Oh yeah, it’s that good. <span
                            class="text-body-secondary">See for yourself.</span></h2>
                    <p class="lead">Another featurette? Of course. More placeholder content here to give you an idea
                        of how this layout would work with some actual real-world content in place.</p>
                </div>
                <div class="col-md-5 order-md-1">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"
                        width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img"
                        aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" /><text x="50%" y="50%"
                            fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                    </svg>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <div class="col-md-7">
                    <h2 class="featurette-heading fw-normal lh-1">And lastly, this one. <span
                            class="text-body-secondary">Checkmate.</span></h2>
                    <p class="lead">And yes, this is the last block of representative placeholder content. Again, not
                        really intended to be actually read, simply here to give you a better view of what this would
                        look like with some actual content. Your content.</p>
                </div>
                <div class="col-md-5">
                    <svg class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto"
                        width="500" height="500" xmlns="http://www.w3.org/2000/svg" role="img"
                        aria-label="Placeholder: 500x500" preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="var(--bs-secondary-bg)" /><text x="50%" y="50%"
                            fill="var(--bs-secondary-color)" dy=".3em">500x500</text>
                    </svg>
                </div>
            </div>

            <hr class="featurette-divider">

            <div class="row featurette">
                <h2 class="font-review" style="text-align: center; color:#d75a6e ">THE REASONS WHY YOU SHOULD CHOOSE
                    US</h2>
                <div class="container">
                    <div class="cards-row">
                        <div class="card">
                            <div class="icon-wrapper-i">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h3 class="card-title">Home Services</h3>
                            <p class="card-text">Our Home Services are designed to provide you with the ultimate
                                convenience and comfort on your special occasions.</p>
                        </div>
                        <div class="card">
                            <div class="icon-wrapper-i">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h3 class="card-title">Quick Response</h3>
                            <p class="card-text">Our Quick Response policy ensures that you receive timely assistance
                                and efficient service from the moment you inquire about our offerings.</p>
                        </div>
                        <div class="card">
                            <div class="icon-wrapper-i">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h3 class="card-title">We're Everywhere</h3>
                            <p class="card-text">With our We're Everywhere approach, we bring professional makeup
                                services right to your fingertips, no matter where you are.</p>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->



            <!-- /END THE FEATURETTES -->

        </div><!-- /.container -->


        <!-- FOOTER -->
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


    </main>
    <script src="/js/bootstrap.bundle.min.js"></script>

</body>

</html>
