@extends('layouts.customer.main')
@section('title', 'Homepage')
@section('navHomepage', 'active')
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
        font-size: 70px;
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

    .testimonial-section {
        text-align: center;
        padding: 10px;
        margin-top: 10px;
    }

    .section-title {
        font-size: 36px;
        color: #333;
        margin-bottom: 40px;
        font-weight: bold;
    }

    .testimonial {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 40px;
    }

    .testimonial-image {
        flex-shrink: 0;
        margin-right: 20px;
    }

    .testimonial-image img {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .testimonial-text {
        max-width: 600px;
        text-align: left;
    }

    .testimonial-quote {
        font-size: 18px;
        color: #555;
        margin-bottom: 10px;
        font-style: italic;
    }

    .testimonial-client {
        font-size: 16px;
        color: #d75a6e;
    }

    .testimonial-client span {
        color: #999;
    }

    @media (max-width: 768px) {
        .testimonial {
            flex-direction: column;
            text-align: center;
        }

        .testimonial-image {
            margin-right: 0;
            margin-bottom: 20px;
        }

        .testimonial-text {
            text-align: center;
        }
    }
</style>
@section('content')
    <main class="container">

        <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
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
                        <image href="images/graduation.jpg" width="140" height="140" clip-path="url(#circleView)"
                            preserveAspectRatio="xMidYMid slice" />
                    </svg>
                    <h2 class="font" style="color: #d75a6e">Graduation Makeup</h2>
                    <p>Our Graduation Makeup service is designed to enhance your natural beauty while giving you a
                        flawless, long-lasting look for your big day.</p>
                    <p><a class="btn btn-secondary custom-btn" href="#"
                            style="background-color: #ffc1cb; border-color:#ffc1cb">View details &raquo;</a>
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

            <div class="testimonial-section">
                <h2 class="font-review" style="color:#d75a6e ">What's Ours Clients Are Saying</h2>

                <div class="testimonial">
                    <div class="testimonial-image">
                        <img src="images/review1.jpg" alt="Client Review 1">
                    </div>
                    <div class="testimonial-text">
                        <p class="testimonial-quote">Kemaren Ica mandi dipantai abis wisuda kak. Makeupnya masih bagus
                            walaupun udah malam trus banyak yg komen ke ig ica pangling liat ica!</p>
                        <p class="testimonial-client"><strong>Ica Comel Manja Manis</strong><br><span>Graduation
                                Makeup</span></p>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-image">
                        <img src="images/review2.jpg" alt="Client Review 2">
                    </div>
                    <div class="testimonial-text">
                        <p class="testimonial-quote">MashaAllah Kak! Makeup nya tahan banget, ga retak bahkan ga geser
                            sama sekali</p>
                        <p class="testimonial-client"><strong>Siti Oktavia</strong><br><span>Regular Makeup</span></p>
                    </div>
                </div>

                <div class="testimonial">
                    <div class="testimonial-image">
                        <img src="images/review3.jpg" alt="Client Review 3">
                    </div>
                    <div class="testimonial-text">
                        <p class="testimonial-quote">Tahan banget kak. Makeup nya anti badai walau keringetan tetap ga
                            longsor makeupnya</p>
                        <p class="testimonial-client"><strong>Rahmiati</strong><br><span>Wedding Makeup</span>
                        </p>
                    </div>
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
@endsection
