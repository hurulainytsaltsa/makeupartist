@extends('admin.layouts.main')
@section('title', 'Edit Penugasan')
@section('navPortfolio', 'active')

@section('content')
<div class="container mt-4">
    <!-- Wrapper Card -->
    <div class="card shadow-sm">
        <div class="card-header">
            <h3 class="mb-0">Edit Penugasan</h3>
        </div>

        <div class="card-body">
            <!-- Form -->
            <form action="{{ route('dashboard-assign.update', $penugasan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control"
                           value="{{ $penugasan->nama }}" required readonly>
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-3">
                    <label for="no_telp" class="form-label">Nomor Telepon</label>
                    <input type="text" name="no_telp" id="no_telp" class="form-control"
                           value="{{ $penugasan->no_telp }}" required readonly>
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control"
                           value="{{ $penugasan->alamat }}" required readonly>
                </div>

                <!-- Tanggal Makeup -->
                <div class="mb-3">
                    <label for="tgl_makeup" class="form-label">Tanggal Makeup</label>
                    <input type="date" name="tgl_makeup" id="tgl_makeup" class="form-control"
                           value="{{ $penugasan->tgl_makeup }}" required readonly>
                </div>

                <!-- Jam -->
                <div class="mb-3">
                    <label for="jam" class="form-label">Jam</label>
                    <input type="time" name="jam" id="jam" class="form-control"
                           value="{{ $penugasan->jam }}" required readonly>
                </div>

                <!-- Paket Makeup -->
                <div class="mb-3">
                    <label for="pkt_makeup" class="form-label">Paket Makeup</label>
                    <input type="text" name="pkt_makeup" id="pkt_makeup" class="form-control"
                           value="{{ $penugasan->pkt_makeup }}" required readonly>
                </div>

                <!-- Jenis Paket -->
                <div class="mb-3">
                    <label for="jenis_paket" class="form-label">Jenis Paket</label>
                    <input type="text" name="jenis_paket" id="jenis_paket" class="form-control"
                           value="{{ $penugasan->jenis_paket }}" required readonly>
                </div>

                <!-- Nama MUA -->
                <div class="mb-3">
                    <label for="nama_mua" class="form-label">Nama MUA</label>
                    <select name="nama_mua" id="nama_mua" class="form-control" required>
                        <option disabled selected>Pilih Nama MUA</option>
                        @foreach ($muaProfiles as $mua)
                            <option value="{{ $mua->nama_mua }}"
                                {{ $mua->nama_mua == $penugasan->nama_mua ? 'selected' : '' }}>
                                {{ $mua->nama_mua }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol Submit -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('dashboard-assign.show') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
