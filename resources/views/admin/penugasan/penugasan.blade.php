@extends('admin.layouts.main')
@section('title', 'Profile')
@section('navProfile', 'active')

@section('content')
    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('pesan') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="text-center profile-heading">MUA Assignment</h2>
    {{-- <div class="text-end mb-4">
        <a href="/dashboard-profile/create" class="btn btn-primary btn-profile">Add New Makeup Artist</a>
    </div> --}}
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>No Penugasan</th>
            <th>Nama Customer</th>
            <th>No telepon</th>
            <th>Alamat</th>
            <th>Tanggal Makeup</th>
            <th>Jam</th>
            <th>Paket Makeup</th>
            <th>Jenis Paket</th>
            <th>Nama MUA</th>
            <th>Aksi</th>
        </tr>
        @foreach ($penugasan as $penugasan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $penugasan->id }}</td>
                <td>{{ $penugasan->nama }}</td>
                <td>{{ $penugasan->no_telp }}</td>
                <td>{{ $penugasan->alamat }}</td>
                <td>{{ $penugasan->tgl_makeup }}</td>
                <td>{{ $penugasan->jam }}</td>
                <td>{{ $penugasan->pkt_makeup }}</td>
                <td>{{ $penugasan->jenis_paket }}</td>
                <td>{{ $penugasan->nama_mua }}</td>

                <td>
                    <div class="d-flex">
                        <a title="Edit Data" href="{{ route('dashboard-assign.edit', $penugasan->id) }}">
                            <button class="btn btn-warning btn-sm me-2" type="button">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </a>
                        <form id="deleteForm{{ $penugasan->id }}" action="{{ route('dashboard-assign.destroy', $penugasan->id) }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="button" title="Hapus Data" class="btn btn-danger btn-sm me-2" onclick="confirmDelete({{ $penugasan->id }})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        @if ($penugasan->booking->status !== 'completed')
                            <form action="{{ route('dashboard-assign.mark-completed', $penugasan->booking_id) }}"
                                method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Completed</button>
                        @endif
                    </div>
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
    </table>

@endsection
