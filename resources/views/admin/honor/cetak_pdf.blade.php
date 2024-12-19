<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Honor MUA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            color: #333;

        }

        h1 {
            text-align: center;
            color: #4a90e2;
            font-weight: bold;
        }

        p {
            font-size: 14px;
            margin: 5px 0;
        }

        .header-info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th,
        td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            font-size: 12px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #eaf4fe;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>

<body>
    <h1>Laporan Honor MUA</h1>
    <div class="header-info">
        <div class="profile-container">
            <div class="profile-details">
                <p><strong>Nama MUA:</strong> {{ $mua->nama_mua }}</p>
                <p><strong>Lokasi:</strong> {{ $mua->lokasi }}</p>
            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Detail Package</th>
                <th>Penugasan ID</th>
                <th>Gaji Kotor</th>
                <th>Gaji Bersih</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($honors as $key => $honor)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $penugasan->pkt_makeup }} - {{ $penugasan->jenis_paket }}</td>
                    <td>{{ $honor->penugasan_id }}</td>
                    <td>Rp {{ number_format($honor->gaji_kotor, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($honor->gaji_bersih, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($honor->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <p><strong>Total Gaji Dibayar:</strong> Rp {{ number_format($total_dibayar, 0, ',', '.') }}</p>
    <p><strong>Total Gaji Belum Dibayar:</strong> Rp {{ number_format($total_belum_dibayar, 0, ',', '.') }}</p>

    <br><br>

    <table style="width: 100%; border-collapse: collapse; border: none;">
        <tr>
            <td style="text-align: center; vertical-align: top;">
                <div class="signature-section">
                    <div class="signature-details">
                        <p><strong>MUA</p>
                        <br><br><br><br>
                        <p>_________________________</p>
                        <p><strong>( {{ $mua->nama_mua }} )</strong></p>
                    </div>
                </div>
            </td>
            <td style="text-align: center; vertical-align: top;">
                <div class="signature-section">
                    <div class="signature-details">
                        <p><strong>Admin</p>
                        <br><br><br><br>
                        <p>_________________________</p>
                        <p><strong>( {{ Auth::user()->name }} )</strong></p>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center;">
                <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>
            </td>
        </tr>
    </table>


    <div class="footer">
        <p>&copy; {{ date('Y') }} MakeUp By Rani. Semua Hak Dilindungi.</p>
    </div>
</body>

</html>
