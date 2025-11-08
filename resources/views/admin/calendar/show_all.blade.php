@extends('admin.layouts.main')
@section('title', 'Calendar')
@section('navCalendar', 'active')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Event</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

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

        table {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #de8d9b;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        .btn-warning {
            background-color: #f0ad4e;
            border: none;
        }

        .btn-danger {
            background-color: #d9534f;
            border: none;
        }

        .btn-sm {
            font-size: 0.9rem;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .btn i {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <div class="text-center mb-4">
            <h1>Daftar Semua Event</h1>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Waktu Mulai</th>
                        <th>Warna</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($calendars as $calendar)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $calendar->id }}</td>
                            <td>{{ $calendar->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($calendar->start)->format('d-m-Y H:i') }}</td>
                            <td style="background-color: {{ $calendar->color }}; color: white;">{{ ucfirst($calendar->color) }}</td>
                            <td>
                                <a href="{{ route('dashboard-calendar.edit', $calendar->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i>Edit
                                </a>

                                <form id="deleteForm{{ $calendar->id }}" action="{{ route('dashboard-calendar.destroy', $calendar->id) }}" method="post" class="d-inline">
                                    @method('DELETE')
                                    @csrf
                                    <button type="button" title="Hapus Data" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $calendar->id }})">
                                        <i class="bi bi-trash"></i>Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.all.min.js"></script>

                    <script>
                        function confirmDelete(id) {
                            Swal.fire({
                                title: 'Yakin ingin menghapus?',
                                text: "Data yang dihapus tidak bisa dikembalikan!",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Ya, Hapus!',
                                cancelButtonText: 'Batal',
                                reverseButtons: true,
                                width: '300px',
                                padding: '20px',
                                fontSize: '14px',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Pastikan form untuk menghapus data dikirim setelah konfirmasi
                                    document.getElementById('deleteForm' + id).submit();
                                }
                            });
                        }
                    </script>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html> --}}
(@endsection)
