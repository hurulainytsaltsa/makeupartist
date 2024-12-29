@extends('admin.layouts.main')
@section('title', 'Booking')
@section('navPackage', 'active')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="text-center">Bookings</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal Makeup</th>
                        <th>Jam</th>
                        <th>Paket Makeup</th>
                        <th>Jenis Paket</th>
                        <th>Price</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($booking as $key => $bookings)
                        <tr>
                            <td>{{ ($booking->currentPage() - 1) * $booking->perPage() + $key + 1 }}</td>
                            <td>{{ $bookings->nama }}</td>
                            <td>{{ $bookings->tgl_makeup }}</td>
                            <td>{{ $bookings->jam }}</td>
                            <td>{{ $bookings->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket' }}</td>
                            <td>{{ optional($bookings->DetailsMakeUp)->name ?? 'Tidak Ada Paket' }}</td>
                            <td>Rp{{ number_format($bookings->price, 0, ',', '.') }}</td>
                            <td>
                                @if ($bookings->status == 'pending')
                                    <span class="badge" style="background-color: #ffcccb; color: #b71c1c;">Waiting for
                                        Payment</span>
                                @elseif ($bookings->status == 'paid')
                                    <span class="badge" style="background-color: #d4edda; color: #155724;">Paid</span>
                                @elseif ($bookings->status == 'completed')
                                    <span class="badge" style="background-color: #cce5ff; color: #004085;">Completed</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a title="Detail" href="{{ route('dashboard-booking.show', $bookings->id) }}">
                                        <button class="btn btn-success me-2" type="button"><i
                                                class="bi bi-eye"></i></button>
                                    </a>
                                    <form id="deleteForm{{ $bookings->id }}" action="{{ route('dashboard-booking.destroy', $bookings->id) }}" method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" title="Hapus Data" class="btn btn-danger" onclick="confirmDelete({{ $bookings->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

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
                </tbody>
            </table>
            {{ $booking->links() }}
        </div>
    </div>

@endsection
