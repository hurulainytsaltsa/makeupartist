@extends('admin.layouts.main')
@section('title', 'Package')
@section('navPackage', 'active')

@section('content')
    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('pesan') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="text-center profile-heading">Package</h2>
    <div class="text-end mb-4">
        <a href="/dashboard-package/create" class="btn btn-primary btn-profile">Add New Package</a>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama Paket</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Photo</th>
            <th>Aksi</th>
        </tr>
        @foreach ($paketMakeup as $paket)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $paket->nama_paket }}</td>
                <td>{{ $paket->deskripsi }}</td>
                <td>{{ $paket->harga }}</td>
                <td>
                    <img src="images/package/{{ $paket['photo'] }}" style="max-width: 150px; margin-top: 10px;"
                        class="profile-img" alt="Image for {{ $paket['nama_paket'] }}">
                </td>
                <td>
                    <div class="d-flex">
                        <a title="Detail" href="{{ route('dashboard-details_package.show', $paket->id) }}">
                            <button class="btn btn-success me-2" type="button"><i class="bi bi-eye"></i></button>
                        </a>
                        <a title="Edit Data" href="dashboard-package/{{ $paket->id }}/edit"><button
                                class="btn btn-warning me-2" type="button"><i class="bi bi-pencil"></i></button></a>
                        <form id="deleteForm{{ $paket->id }}" action="/dashboard-package/{{ $paket->id }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="button" title="Hapus Data" class="btn btn-danger" onclick="confirmDelete({{ $paket->id }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach

        <!-- SweetAlert2 JavaScript -->
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
    </table>
    {{ $paketMakeup->links() }}
@endsection
