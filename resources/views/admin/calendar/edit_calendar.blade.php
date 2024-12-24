@extends('admin.layouts.main')
@section('title', 'Calendar')
@section('navCalendar', 'active')

@section('content')
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            color: #de8d9b;
            font-weight: bold;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
            color: #555;
        }

        .form-control:focus {
            border-color: #de8d9b;
            box-shadow: 0 0 5px rgba(222, 141, 155, 0.5);
        }

        .btn-primary {
            background-color: #de8d9b;
            border: none;
        }

        .btn-primary:hover {
            background-color: #c77a86;
        }

        .btn-danger {
            background-color: #d9534f;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c43c3b;
        }

        .btn i {
            margin-right: 5px;
        }
    </style>
{{-- </head>
<body> --}}
    <div class="container my-5">
        <!-- Header -->
        <div class="text-center mb-4">
            <h1>Edit Event</h1>
        </div>

        <!-- Form Edit Event -->
        <form method="POST" action="{{ route('dashboard-calendar.update', $calendar->id) }}">
            @csrf
            @method('PUT')

            <!-- Status Event -->
            <div class="mb-3">
                <label for="title" class="form-label">Status Event</label>
                <select class="form-control" id="title" name="title" required>
                    <option value="Available" {{ $calendar->title == 'Available' ? 'selected' : '' }}>Available</option>
                    <option value="Not Available" {{ $calendar->title == 'Not Available' ? 'selected' : '' }}>Not Available</option>
                </select>
            </div>

            <!-- Waktu Mulai -->
            <div class="mb-3">
                <label for="start" class="form-label">Waktu Mulai</label>
                <input type="datetime-local" class="form-control" id="start" name="start" value="{{ old('start', \Carbon\Carbon::parse($calendar->start)->format('Y-m-d\TH:i')) }}" required>
            </div>

            <!-- Warna Event -->
            <div class="mb-3">
                <label for="color" class="form-label">Warna Event</label>
                <select class="form-control" id="color" name="color" required>
                    <option value="green" {{ $calendar->color == 'green' ? 'selected' : '' }}>Hijau</option>
                    <option value="red" {{ $calendar->color == 'red' ? 'selected' : '' }}>Merah</option>
                </select>
            </div>

            <!-- Tombol Update -->
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-save"></i>Update Event
            </button>
    </div>
{{--
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body> --}}
</html>
@endsection
