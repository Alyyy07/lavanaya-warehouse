<!DOCTYPE html>
<html>

<head>
    <title>Laporan Riwayat Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 5px 0 0;
            color: #666;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            padding: 2px 5px;
            border-radius: 3px;
            color: white;
            font-size: 10px;
        }

        .bg-green {
            background-color: #22c55e;
        }

        .bg-red {
            background-color: #ef4444;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Riwayat Transaksi</h1>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode</th>
                <th>Produk</th>
                <th>Tipe</th>
                <th class="text-center">Jumlah</th>
                <th>Supplier / Tujuan</th>
                <th>Catatan</th>
                <th>Oleh</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $index => $transaction)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->translatedFormat('d F Y') }}</td>
                <td>{{ $transaction->transaction_code }}</td>
                <td>{{ $transaction->product->name }}</td>
                <td>
                    @if($transaction->type == 'IN')
                    <span class="badge bg-green">IN</span>
                    @else
                    <span class="badge bg-red">OUT</span>
                    @endif
                </td>
                <td class="text-center">{{ $transaction->quantity }} {{ $transaction->product->unit }}</td>
                <td>
                    @if($transaction->type == 'IN')
                    {{ $transaction->supplier ? $transaction->supplier->name : '-' }}
                    @else
                    {{ $transaction->destination ?? '-' }}
                    @endif
                </td>
                <td>{{ $transaction->notes ?? '-' }}</td>
                <td>{{ $transaction->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>