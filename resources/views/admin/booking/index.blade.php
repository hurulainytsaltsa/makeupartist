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
                    @foreach ($booking as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->nama }}</td>
                            <td>{{ $booking->tgl_makeup }}</td>
                            <td>{{ $booking->jam }}</td>
                            <td>{{ $booking->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket' }}</td>
                            <td>{{ optional($booking->DetailsMakeUp)->name ?? 'Tidak Ada Paket' }}</td>
                            <td>{{ $booking->price }}</td>
                            <td>
                                @if ($booking->status == 'pending')
                                    <span class="badge" style="background-color: #ffcccb; color: #b71c1c;">Waiting for Payment</span>
                                @elseif ($booking->status == 'paid')
                                    <span class="badge" style="background-color: #d4edda; color: #155724;">Paid</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a title="Detail" href="{{ route('dashboard-booking.show', $booking->id) }}">
                                        <button class="btn btn-success me-2" type="button"><i
                                                class="bi bi-eye"></i></button>
                                    </a>
                                    <form action="{{ route('dashboard-booking.destroy', $booking->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');"
                                        class="d-inline">
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
                </tbody>
            </table>
        </div>
    </div>

@endsection
