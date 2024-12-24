@extends('admin.layouts.main')
@section('title', 'Calendar')
@section('navCalendar', 'active')

@section('content')
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Event Baru</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
        }

        h1 {
            color: #de8d9b;
            font-weight: bold;
        }

        .container {
            max-width: 600px;
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
            color: #555;
        }

        .btn-primary {
            background-color: #de8d9b;
            border-color: #de8d9b;
        }

        .btn-primary:hover {
            background-color: #e0879e;
            border-color: #e0879e;
        }
    </style>
{{-- </head>
<body> --}}
    <div class="container my-5">
        <h1 class="text-center mb-4">Tambah Event Baru</h1>
        <form method="POST" action="{{ route('calendar.store') }}">
            @csrf
            <!-- Judul Event -->
            <div class="mb-4">
                <label for="title" class="form-label">Judul Event</label>
                <select class="form-control form-select" id="title" name="title" required>
                    <option value="" disabled selected>Pilih status event</option>
                    <option value="Available">Available</option>
                    <option value="Not Available">Not Available</option>
                </select>
            </div>

            <!-- Waktu Mulai -->
            <div class="mb-4">
                <label for="start" class="form-label">Waktu Mulai</label>
                <input type="datetime-local" class="form-control" id="start" name="start" required>
            </div>

            <!-- Warna Event -->
            <div class="mb-4">
                <label for="color" class="form-label">Warna Event</label>
                <select class="form-control form-select" id="color" name="color" required>
                    <option value="" disabled selected>Pilih warna event</option>
                    <option value="green">Hijau</option>
                    <option value="red">Merah</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary px-5">Tambah Event</button>
            </div>
        </form>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}
@endsection
