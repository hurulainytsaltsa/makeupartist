<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Portfolio - {{ $portofolio->nama_mua }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts for typography -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Poppins:wght@400;500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }

        h1 {
            font-family: 'Playfair Display', serif;
            color: #de8d9b;
            text-align: center;
            margin-top: 20px;
        }

        .profile-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 30px;
        }

        .profile-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-bottom: 4px solid #de8d9b;
        }

        .profile-info {
            padding: 20px;
            text-align: center;
        }

        .btn-profile {
            background-color: #de8d9b;
            color: white;
            border-radius: 30px;
            text-transform: uppercase;
            transition: background-color 0.3s ease-in-out;
            margin-top: 20px;
        }

        .btn-profile:hover {
            background-color: #c77a88;
        }

        footer {
            margin-top: 40px;
            text-align: center;
        }
    </style>
</head>

{{-- BEYONCEEE LOVE YOUU SOO MUCH --}}

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <!-- Card Wrapper -->
                <div class="card portofolio-card">
                    <img src="{{ asset('images/gambar/' . $portofolio->gambar) }}"
                         alt="Portofolio of {{ $portofolio->nama_mua }}"
                         class="card-img-top profile-img">

                    <div class="card-body text-center">
                        <h1 class="card-title">{{ $portofolio->nama_mua }}</h1>
                        <p class="card-text text-muted">{{ $portofolio->review }}</p>

                        <a href="/portofolio" class="btn btn-profile mb-3" style="width: 200px;">Back to Portfolio</a>

                        <div class="d-flex justify-content-center gap-3">
                            <a href="/portofolio/{{ $portofolio->id }}/edit"
                               class="btn btn-primary" style="width: 200px;">Edit Portfolio</a>

                            <form action="/portofolio/{{ $portofolio->id }}"
                                  method="post" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                        style="width: 200px;"
                                        onclick="return confirm('Are you sure you want to delete this portfolio?');">
                                    Delete Portfolio
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2024 Makeup by Rani &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


