@extends('admin.layouts.main')
@section('title', 'Honor')
@section('navHonor', 'active')

@section('content')
    <div class="container-fluid">
        <h1 class="mt-4">Honor MUA</h1>

        <!-- Filter -->
        <div class="card mb-4">
            <div class="card-header">
                <form action="{{ route('admin.honor.filter') }}" method="GET">
                    <div class="row align-items-center g-3">
                        <!-- Filter by Month -->
                        <div class="col-md-3">
                            <label for="month" class="form-label">Bulan:</label>
                            <input type="month" id="month" name="month" class="form-control"
                                value="{{ request('month') }}">
                        </div>

                        <!-- Filter by Year -->
                        <div class="col-md-3">
                            <label for="year" class="form-label">Tahun:</label>
                            <input type="number" id="year" name="year" class="form-control" placeholder="YYYY"
                                value="{{ request('year') }}">
                        </div>

                        <!-- Filter by Week -->
                        <div class="col-md-3">
                            <label for="week" class="form-label">Minggu (ISO):</label>
                            <input type="number" id="week" name="week" class="form-control"
                                placeholder="Week Number" value="{{ request('week') }}">
                        </div>

                        <!-- Filter by MUA -->
                        <div class="col-md-3">
                            <label for="mua_id" class="form-label">Filter berdasarkan MUA:</label>
                            <select name="mua_id" id="mua_id" class="form-control">
                                <option value="">Pilih MUA</option>
                                @foreach ($muaProfiles as $mua)
                                    <option value="{{ $mua->id }}"
                                        {{ request('mua_id') == $mua->id ? 'selected' : '' }}>
                                        {{ $mua->nama_mua }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="row mt-3">
                            <!-- Tombol Filter -->
                            <div class="col-md-3 mb-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-funnel"></i> Filter
                                </button>
                            </div>

                            <!-- Tombol Cetak Laporan Honor -->
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('cetak.honor.pdf', ['month' => request('month'), 'year' => request('year'), 'week' => request('week'), 'mua_id' => request('mua_id')]) }}"
                                    class="btn btn-success w-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-printer me-2"></i> Cetak Laporan Honor
                                </a>
                            </div>

                            <!-- Tombol Cetak Laporan Order -->
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('cetak.order.pdf', ['month' => request('month'), 'year' => request('year'), 'week' => request('week')]) }}"
                                    class="btn btn-success w-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-printer me-2"></i> Cetak Laporan Order
                                </a>
                            </div>

                            <!-- Tombol Clear Filter -->
                            <div class="col-md-3 mb-2">
                                <a href="{{ route('admin.honor.filter') }}"
                                    class="btn btn-secondary w-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-x-circle me-2"></i> Clear Filter
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <!-- Honor Table -->
        <div class="card">
            <div class="card-header">
                <h5>Honor Report</h5>
            </div>
            <div class="card-body">
                @if ($honors->isNotEmpty())
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Penugasan ID</th>
                                <th>Nama MUA</th>
                                <th>Gaji Kotor</th>
                                <th>Gaji Bersih</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($honors as $key => $honor)
                                <tr>
                                    <td>{{($honors->currentPage() - 1) * $honors->perPage() + $key + 1 }}</td>
                                    <td>{{ $honor->penugasan_id }}</td>
                                    <td>{{ $honor->muaProfile->nama_mua ?? 'Nama tidak tersedia' }}</td>
                                    <td>Rp {{ number_format($honor->gaji_kotor, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($honor->gaji_bersih, 0, ',', '.') }}</td>
                                    <td>{{ ucfirst($honor->status) }}</td>
                                    <td>
                                        <div class="d-flex flex-wrap gap-2">
                                            <!-- Tombol Show -->
                                            <a href="{{ route('dashboard-honor.show', $honor->penugasan_id) }}" class="btn btn-success btn-sm">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            <!-- Tombol Delete -->
                                            <form action="{{ route('dashboard-honor.destroy', $honor->id) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this honor?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                            </form>

                                            <!-- Tombol Lihat Bukti Pembayaran -->
                                            @if ($honor->bukti_pembayaran)
                                            <a href="{{ asset('images/bukti_honor/' . $honor->bukti_pembayaran) }}" target="_blank" class="btn btn-info btn-sm">
                                                Lihat Bukti
                                            </a>
                                            @else
                                                <!-- Form Upload Bukti Pembayaran -->
                                                <form action="{{ route('dashboard-honor.upload-payment', $honor->id) }}" method="POST"
                                                    enctype="multipart/form-data" class="d-inline">
                                                    @csrf
                                                    <div class="d-flex align-items-center gap-2">
                                                        <input type="file" name="bukti_pembayaran" accept="image/*,.pdf"
                                                            class="form-control form-control-sm" required>
                                                        <button type="submit" class="btn btn-primary btn-sm">Upload</button>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Total</th>
                                <th>Rp {{ number_format($honors->sum('gaji_kotor'), 0, ',', '.') }}</th>
                                <th>Rp {{ number_format($honors->sum('gaji_bersih'), 0, ',', '.') }}</th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>

                    <div class="mt-3">
                        {{ $honors->links() }} <!-- This should work if $honors is paginated -->
                    </div>
                @else
                    <p class="text-center">No data available for the selected month.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
