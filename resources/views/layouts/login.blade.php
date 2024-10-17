<!DOCTYPE html>
<html lang="en">

<head>
    <script src="/js/color-modes.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
<!-- comment -->

    <link rel="stylesheet" href="css/style.css">
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->

</head>

<body>
    <section class="vh-100" style="background-color: #ffffff;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-7">
                    <div class="card" style="border-radius: 1rem; background-color: #ffc1cb; border-color: white;">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="images/form1.jpg"
                                    alt="login form" class="image-holder1" style="border-radius: 1rem 0 0 1rem; object-fit: cover; display: block; width: 100%; height: 100%;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; color: #ffffff">Sign into your
                                            account</h5>

                                        <div class="form-wrapper">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}">
                                            <i class="bi bi-telephone"></i>
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                             @enderror
                                        </div>

                                        <div class="form-wrapper">
                                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                                            <i class="bi bi-lock"></i>
                                        </div>

                                        <div class="pt-1 mb-4 text-center">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-block" type="button"
                                                style="height: 40px; background-color: #d17676; color: white; position: relative; width: 200px;">
                                                Login
                                            </button>
                                        </div>


                                        <p class="mb-5 pb-lg-2" style="color: #d17676;">Don't have an account? <a
                                                href="/register" style="color: #d17676;">Register here</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
