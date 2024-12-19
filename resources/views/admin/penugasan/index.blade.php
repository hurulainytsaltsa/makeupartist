@extends('admin.layouts.main')
@section('title', 'Order Confirmation')
@section('navPackage', 'active')

@section('content')
<div class="container">
    <h2 class="text-center">Penugasan Order</h2>

    @if ($booking)
    <form action="{{ route('penugasan.store', $booking->id) }}" method="POST">
            @csrf

            <div class="card mb-4">
                <div class="card-body">
                    <h5>Booking Details:</h5>

                        <!-- Nama Customer -->
                        <div class="mb-3">
                            <label for="nama_customer" class="form-label"><strong>Nama Customer:</strong></label>
                            <input type="text" name="nama" id="nama_customer" class="form-control"
                                value="{{ $booking->nama }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="no_telp" class="form-label"><strong>No. Telepon:</strong></label>
                            <input type="text" name="no_telp" id="no_telp" class="form-control"
                                value="{{ $booking->no_telp }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label"><strong>Alamat:</strong></label>
                            <input type="text" name="alamat" id="alamat" class="form-control"
                                value="{{ $booking->alamat }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_makeup" class="form-label"><strong>Tanggal Makeup:</strong></label>
                            <input type="date" name="tgl_makeup" id="tgl_makeup" class="form-control"
                                value="{{ $booking->tgl_makeup }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jam" class="form-label"><strong>Jam Makeup:</strong></label>
                            <input type="text" name="jam" id="jam" class="form-control"
                                value="{{ $booking->jam }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="pkt_makeup" class="form-label"><strong>Paket Makeup:</strong></label>
                            <input type="text" name="pkt_makeup" id="pkt_makeup" class="form-control"
                                value="{{ $booking->packagesMakeUp->nama_paket ?? 'Tidak Ada Paket' }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_paket" class="form-label"><strong>Jenis Paket:</strong></label>
                            <input type="text" name="jenis_paket" id="jenis_paket" class="form-control"
                                value="{{ $booking->DetailsMakeUp->name ?? 'Tidak Ada Paket' }}" readonly>
                        </div>
                        <select name="nama_mua" id="nama_mua" class="form-control" required onchange="setMuaId()">
                            <option value="" disabled selected>Pilih Nama MUA</option>
                            @foreach ($muaProfiles as $mua)
                                <option value="{{ $mua->nama_mua }}" data-id="{{ $mua->id }}">{{ $mua->nama_mua }}</option>
                            @endforeach
                        </select>


                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-custom">Simpan Penugasan</button>
                </div>
            </div>
        </form>
    @else
        <p>Tidak ada data booking untuk ditampilkan.</p>
    @endif
</div>
@endsection
