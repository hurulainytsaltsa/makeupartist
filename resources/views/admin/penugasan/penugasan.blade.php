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
                        <a title="Edit Data" href=""><button class="btn btn-warning  me-2" type="button"><i
                                    class="bi bi-pencil"></i></button></a>
                        <form action="{{ route('dashboard-assign.destroy', $penugasan->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus assignment ini?');" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit" title="Hapus">
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
