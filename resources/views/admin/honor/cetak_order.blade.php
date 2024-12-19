<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemesanan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 8;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1, h3 {
            text-align: center;
        }
        .total {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Laporan Pemesanan</h1>

    <!-- Menampilkan Jenis Laporan -->
    <h3>
        @if(request('week'))
            Minggu {{ request('week') }} Tahun {{ request('year') }}
        @elseif(request('month') && request('year'))
            Bulan {{ date('F', mktime(0, 0, 0, (int) request('month'), 1)) }} Tahun {{ (int) request('year') }}
        @else
            Tahun {{ request('year') ? request('year') : 'Semua Tahun' }}
        @endif
    </h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama MUA</th>
                <th>Package</th>
                <th>Order ID</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Gaji MUA</th>
                <th>Biaya Layanan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalGajiKotor = 0;
                $totalBiayaLayanan = 0;
                $totalBiayaMUA = 0; // Inisialisasi total biaya MUA
            @endphp
            @foreach($orders as $key => $order)
            @php
                $biayaLayanan = $order->gaji_kotor - $order->gaji_bersih;
                $totalGajiKotor += $order->gaji_kotor;
                $totalBiayaLayanan += $biayaLayanan;
                $biayaMUA = $order->gaji_bersih; // Gaji MUA adalah gaji bersih
                $totalBiayaMUA += $biayaMUA; // Tambahkan ke total biaya MUA
            @endphp
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $order->muaProfile->nama_mua }}</td>
                <td>{{ $order->penugasan->pkt_makeup ?? 'N/A' }} - {{ $order->penugasan->jenis_paket ?? 'N/A' }}</td>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d-m-Y') }}</td>
                <td>Rp {{ number_format($order->gaji_kotor, 0, ',', '.') }}</td> <!-- Tampilkan gaji kotor -->
                <td>Rp {{ number_format($order->gaji_bersih, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($biayaLayanan, 0, ',', '.') }}</td> <!-- Hitung biaya layanan -->
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="total" style="text-align: right;">Total:</td>
                <td class="total">Rp {{ number_format($totalGajiKotor, 0, ',', '.') }}</td>
                <td class="total">Rp {{ number_format($totalBiayaMUA, 0, ',', '.') }}</td> <!-- Total Biaya MUA -->
                <td class="total">Rp {{ number_format($totalBiayaLayanan, 0, ',', '.') }}</td> <!-- Total Biaya Layanan -->
            </tr>
        </tfoot>
    </table>

    <table style="width: auto; border-collapse: collapse; border: none; float: right; margin-top: 20px;">
        <tr>
            <td style="text-align: center; vertical-align: top; border: none;">
                <div class="signature-section">
                    <div class="signature-details">
                        <p><strong>Admin</strong></p>
                        <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
                        <br><br><br><br>
                        <p>_________________________</p>
                        <p><strong>( {{ Auth::user()->name }} )</strong></p>
                    </div>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>
