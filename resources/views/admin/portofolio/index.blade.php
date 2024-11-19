@extends('admin.layouts.main')
@section('title', 'Portofolio')
@section('navPortofolio', 'active')

@section('content')
    @if (session('pesan'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('pesan') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <h2 class="text-center profile-heading">MUA's Portfolio</h2>
    <div class="text-end mb-4">
        <a href="/dashboard-portfolio/create" class="btn btn-primary btn-profile">Add New Portfolio</a>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama MUA</th>
            <th>Review</th>
            <th>Photo</th>
            <th>Aksi</th>
        </tr>
        @foreach ($portofolio as $mua)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $mua->nama_mua }}</td>
                <td>{{ $mua->review }}</td>
                <td>
                    <img src="images/gambar/{{ $mua['gambar'] }}" style="max-width: 150px; margin-top: 10px;"
                        class="profile-img" alt="Image for {{ $mua['nama_mua'] }}">
                </td>
                <td>
                    <div class="d-flex">
                        <a title="Detail" href="/dashboard-portfolio/{{ $mua->id }}">
                            <button class="btn btn-success me-2" type="button"><i class="bi bi-eye"></i></button>
                        </a>
                        <a title="Edit Data" href="dashboard-portfolio/{{ $mua->id }}/edit"><button
                                class="btn btn-warning  me-2" type="button"><i class="bi bi-pencil"></i></button></a>
                        <form action="/dashboard-portfolio/{{ $mua->id }}" method="post" class="d-inline">
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
    {{ $portofolio->links() }}
@endsection
