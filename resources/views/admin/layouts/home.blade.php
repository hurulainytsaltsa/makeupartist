@extends('admin.layouts.main')
@section('title', 'Dashboard Admin')
@section('navHomePage', 'active')

@section('content')
    <div class="container">
        <h1 class="text-center my-4">Haii, Selamat Datang {{ Auth::user()->name }}!</h1>

        <!-- Statistik -->
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-check-fill fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Total Booking</h5>
                        <p class="fs-3 fw-bold text-dark">{{ $totalBookings }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill fs-1 text-success"></i>
                        <h5 class="card-title mt-3">Total Pengguna</h5>
                        <p class="fs-3 fw-bold text-dark">{{ $totalUsers }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="bi bi-currency-dollar fs-1 text-warning"></i>
                        <h5 class="card-title mt-3">Pendapatan Bulan Ini</h5>
                        <p class="fs-3 fw-bold text-dark">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity and Kalender in the same row -->
        <div class="row mt-5">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Recent Activity</h5>
                        <div class="list-group">
                            @forelse ($recentActivities->take(5) as $activity)
                                <div class="single_todo d-flex justify-content-between align-items-center mb-3">
                                    <div class="lodo_left d-flex align-items-center">
                                        <div
                                            class="bar_line mr_10 @if ($activity->status === 'pending') bg-warning @elseif ($activity->status === 'paid') bg-success @elseif ($activity->status === 'completed') bg-primary @endif">
                                        </div>
                                        <div class="todo_box">
                                            <label class="form-label primary_checkbox d-flex mr_10">
                                                <i class="bi bi-circle-fill @if ($activity->status === 'pending') text-warning @elseif ($activity->status === 'payment_confirmed') text-success @elseif ($activity->status === 'completed') text-primary @endif"></i>
                                            </label>
                                        </div>

                                        <div
                                            class="todo_head @if ($activity->status === 'pending') text-warning @elseif ($activity->status === 'paid') text-success @elseif ($activity->status === 'completed') text-primary @endif">
                                            @if ($activity->status === 'pending')
                                                <h5 class="f_s_18 f_w_900 mb-0">{{ $activity->nama }}</h5>
                                                <p class="f_s_12 f_w_400 mb-0 text_color_8">Baru saja melakukan booking
                                                    untuk <b>{{ $activity->paket_makeup }}</b> pada
                                                    <b>{{ $activity->tgl_makeup }}</b> jam <b>{{ $activity->jam }}</b>.
                                                </p>
                                            @elseif ($activity->status === 'paid')
                                                <h5 class="f_s_18 f_w_900 mb-0">{{ $activity->nama }}'s Payment</h5>
                                                <p class="f_s_12 f_w_400 mb-0 text_color_8">Pembayaran berhasil untuk
                                                    <b>{{ $activity->paket_makeup }}</b> pada
                                                    <b>{{ $activity->tgl_makeup }}</b> jam <b>{{ $activity->jam }}</b>.
                                                </p>
                                            @elseif ($activity->status === 'completed')
                                                <h5 class="f_s_18 f_w_900 mb-0">{{ $activity->nama }}</h5>
                                                <p class="f_s_12 f_w_400 mb-0 text_color_8">Sesi makeup untuk
                                                    <b>{{ $activity->paket_makeup }}</b> pada
                                                    <b>{{ $activity->tgl_makeup }}</b> jam <b>{{ $activity->jam }}</b>
                                                    telah berhasil diselesaikan.
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="list-group-item text-center">No recent activities found.</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Kalender</h5>
                        <div class="default-datepicker">
                            <div class="datepicker-here" data-language="en"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Penjualan -->
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Grafik Pendapatan Bulanan</h5>
                        <canvas id="monthlyRevenueChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const monthlyRevenueData = @json($monthlyRevenueData);
        const monthlyOrdersData = @json($monthlyOrdersData);

        console.log(monthlyRevenueData, monthlyOrdersData);

        const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthlyRevenueData.labels,
                datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: monthlyRevenueData.data,
                        borderColor: '#ffc107',
                        backgroundColor: 'rgba(255, 193, 7, 0.2)',
                    },
                    {
                        label: 'Pesanan (Jumlah)',
                        data: monthlyOrdersData.data,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    }
                ]
            }
        });
    </script>
@endsection
