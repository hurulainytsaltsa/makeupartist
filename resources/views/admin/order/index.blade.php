@extends('admin.layouts.main')
@section('title', 'Order')
@section('navPackage', 'active')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <h2 class="text-center">Order Confirmation</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        {{-- <th>Email</th> --}}
                        {{-- <th>No. Telepon</th> --}}
                        {{-- <th>Alamat</th> --}}
                        <th>Tanggal Makeup</th>
                        <th>Jam</th>
                        <th>Paket Makeup</th>
                        <th>Jenis Paket</th>
                        <th>Price</th>
                        {{-- <th>No. Rekening</th> --}}
                        <th>Status Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status Order</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $booking->nama }}</td>
                            {{-- <td>{{ $booking->email }}</td> --}}
                            {{-- <td>{{ $booking->no_telp }}</td> --}}
                            {{-- <td>{{ $booking->alamat }}</td> --}}
                            <td>{{ $booking->tgl_makeup }}</td>
                            <td>{{ $booking->jam }}</td>
                            <td>{{ $booking->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket' }}</td>
                            <td>{{ optional($booking->DetailsMakeUp)->name ?? 'Tidak Ada Paket' }}</td>
                            <td>Rp{{ number_format($booking->price, 0, ',', '.') }}</td>
                            {{-- <td>{{ $booking->payment->no_rekening ?? '-' }}</td> --}}
                            <td>
                                @if (optional($booking->payment)->status_pembayaran == 'Payment Rejected')
                                    <span class="badge" style="background-color: #ffcccb; color: #b71c1c;">Payment
                                        Rejected</span>
                                @elseif(optional($booking->payment)->status_pembayaran == 'Payment Approved')
                                    <span class="badge" style="background-color: #d4edda; color: #155724;">Payment
                                        Approved</span>
                                @elseif(optional($booking->payment)->status_pembayaran == 'Waiting for Approval')
                                    <span class="badge" style="background-color: #fff9c4; color: #f57f17;">Waiting for
                                        Approval</span>
                                @else
                                    <span class="badge" style="background-color: #e0e0e0; color: #757575;">Belum
                                        Dibayar</span>
                                @endif
                            </td>

                            <td>
                                @if ($booking->payment && $booking->payment->bukti_pembayaran)
                                    <img src="{{ asset('images/bukti_pembayaran/' . $booking->payment->bukti_pembayaran) }}"
                                        alt="Bukti Pembayaran" style="width: 100px; height: auto; border-radius: 5px;">
                                @else
                                    <em>Belum Ada Bukti</em>
                                @endif
                            </td>
                            <td>
                                @if ($booking->status == 'pending')
                                    <span class="badge" style="background-color: #ffcccb; color: #b71c1c;">Pending</span>
                                @elseif($booking->status == 'completed')
                                    <span class="badge" style="background-color: #d4edda; color: #155724;">Completed</span>
                                @elseif($booking->status == 'paid')
                                    <span class="badge" style="background-color: #fff9c4; color: #f57f17;">Paid</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a title="Detail" href="{{ route('dashboard-order.show', $booking->id) }}">
                                        <button class="btn btn-success me-2" type="button"><i
                                                class="bi bi-eye"></i></button>
                                    </a>
                                    <a title="Edit Data" href="{{ route('penugasan.index', $booking->id) }}"><button
                                            class="btn btn-warning  me-2" type="button"><i
                                                class="bi bi-pencil"></i></button></a>
                                    <form id="deleteForm{{ $booking->id }}" action="{{ route('dashboard-order.destroy', $booking->id) }}" method="post" class="d-inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="button" title="Hapus Data" class="btn btn-danger" onclick="confirmDelete({{ $booking->id }})">
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
        </div>
    </div>

@endsection
