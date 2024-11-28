@extends('admin.layouts.main') <!-- Sesuaikan dengan layout yang digunakan -->

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg" style="border: none; border-radius: 10px;">
        <!-- Header -->
        <div class="card-header text-white" style="background: linear-gradient(90deg, #f8bbd0, #f48fb1); border-radius: 10px 10px 0 0;">
            <h4 class="text-center fw-bold">Booking Details</h4>
        </div>

        <!-- Body -->
        <div class="card-body" style="background-color: #f9f9f9;">
            <table class="table table-bordered" style="background-color: #ffffff; border-radius: 10px; overflow: hidden;">
                <thead style="background-color: #f8bbd0;">
                    <tr class="text-center text-white">
                        <th style="width: 5%;">#</th>
                        <th style="width: 30%;">Field</th>
                        <th style="width: 65%;">Value</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    <tr>
                        <td>1</td>
                        <td>Nama</td>
                        <td>{{ $booking->nama }}</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Email</td>
                        <td>{{ $booking->email }}</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>No Telp</td>
                        <td>{{ $booking->no_telp }}</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Alamat</td>
                        <td>{{ $booking->alamat }}</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Tanggal Makeup</td>
                        <td>{{ date('d F Y', strtotime($booking->tgl_makeup)) }}</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Paket Makeup</td>
                        <td>{{ $booking->pkt_makeup }}</td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Jam</td>
                        <td>{{ $booking->jam }}</td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>Jenis Paket</td>
                        <td>{{ ucwords($booking->jenis_paket) }}</td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>Harga</td>
                        <td>Rp {{ number_format($booking->price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>User ID</td>
                        <td>{{ $booking->user_id }}</td>
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>Status</td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge" style="background-color: #fff5c2; color: #856404;">Waiting for Payment</span>
                            @elseif($booking->status == 'paid')
                                <span class="badge" style="background-color: #d4edda; color: #155724;">Completed</span>
                            @else
                                <span class="badge" style="background-color: #f1f1f1; color: #333;">{{ ucwords($booking->status) }}</span>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="card-footer d-flex justify-content-end" style="background-color: #f8f8f8; border-radius: 0 0 10px 10px;">
            <a href="{{ route('dashboard-booking.index') }}" class="btn btn-secondary me-2" style="background-color: #f8bbd0; border: none; color: white;">Back</a>
        </div>
    </div>
</div>
@endsection
