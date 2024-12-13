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
    <h2 class="text-center profile-heading">MUA's Profile</h2>
    <div class="text-end mb-4">
        <a href="/dashboard-profile/create" class="btn btn-primary btn-profile">Add New Makeup Artist</a>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama MUA</th>
            <th>Pengalaman</th>
            <th>Lokasi</th>
            <th>Portfolio Link</th>
            <th>Profile Photo</th>
            <th>Aksi</th>
        </tr>
        @foreach ($mua_profiles as $mua)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mua->nama_mua }}</td>
                <td>{{ $mua->pengalaman }}</td>
                <td>{{ $mua->lokasi }}</td>
                <td>{{ $mua->portfolio_link }}</td>
                <td>
                    <img src="images/profile_photos/{{ $mua['profile_photo'] }}" style="max-width: 150px; margin-top: 10px;"
                        class="profile-img" alt="Image for {{ $mua['nama'] }}">
                </td>
                <td>
                    <div class="d-flex">
                        <a title="Detail" href="/dashboard-profile/{{ $mua->id }}">
                            <button class="btn btn-success me-2" type="button"><i class="bi bi-eye"></i></button>
                        </a>
                        <a title="Edit Data" href="dashboard-profile/{{ $mua->id }}/edit"><button
                                class="btn btn-warning  me-2" type="button"><i class="bi bi-pencil"></i></button></a>
                        <form action="/dashboard-profile/{{ $mua->id }}" method="post" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button title="Hapus Data" class="btn btn-danger" onclick="confirmDelete({{ $mua->id }})">
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
    {{ $mua_profiles->links() }}
@endsection
