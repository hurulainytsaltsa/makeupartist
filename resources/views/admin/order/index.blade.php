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
                            <td>{{ $booking->price }}</td>
                            {{-- <td>{{ $booking->payment->no_rekening ?? '-' }}</td> --}}
                            <td>
                                {{-- {{ $booking->payment->status_pembayaran ?? 'Belum Dibayar' }} --}}
                                @if ($booking->payment->status_pembayaran == 'Payment Rejected')
                                    <span class="badge" style="background-color: #ffcccb; color: #b71c1c;">Payment
                                        Rejected</span>
                                @elseif($booking->payment->status_pembayaran == 'Payment Approved')
                                    <span class="badge" style="background-color: #d4edda; color: #155724;">Payment
                                        Approved</span>
                                @elseif($booking->payment->status_pembayaran == 'Waiting for Approval')
                                    <span class="badge" style="background-color: #fff9c4; color: #f57f17;">Waiting for
                                        Approval</span>
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
                                <div class="d-flex">
                                    <a title="Detail" href="{{ route('dashboard-order.show', $booking->id) }}">
                                        <button class="btn btn-success me-2" type="button"><i
                                                class="bi bi-eye"></i></button>
                                    </a>
                                    <a title="Edit Data" href=""><button class="btn btn-warning  me-2"
                                            type="button"><i class="bi bi-pencil"></i></button></a>
                                    <form action="{{ route('dashboard-order.destroy', $booking->id) }}" method="POST"
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
