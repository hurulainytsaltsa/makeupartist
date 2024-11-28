@extends('admin.layouts.main')
@section('title', 'Details Package')
@section('navPackage', 'active')

@section('content')
    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('pesan') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="text-center">Offers for Package: {{ $package->nama_paket }}</h2>

    <div class="text-end mb-4">
        <a href="{{ route('dashboard-details_package.create', $package->id) }}" class="btn btn-primary">Add New Offer</a>
    </div>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Type</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Bonus</th>
            <th>Aksi</th>
        </tr>
        @foreach ($details as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->name }}</td>
                <td>{{ $detail->type }}</td>
                <td>{{ $detail->description }}</td>
                <td>Rp. {{ number_format($detail->price, 0, ',', '.') }}</td>
                <td>{{ $detail->bonus }}</td>
                <td>
                    <div class="d-flex">
                        <a title="Edit Data" href="{{ route('dashboard-details_package.edit', $detail->id) }}">
                            <button class="btn btn-warning me-2" type="button"><i class="bi bi-pencil"></i></button>
                        </a>
                        <form id="deleteForm{{ $detail->id }}" action="{{ route('dashboard-details_package.destroy', $detail->id) }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button title="Hapus Data" class="btn btn-danger" onclick="confirmDelete({{ $detail->id }})">
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
                        // Pastikan form untuk menghapus data dikirim
                        document.getElementById('deleteForm' + id).submit();
                    }
                });
            }
        </script>
    </table>
@endsection
