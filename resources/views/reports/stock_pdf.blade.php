<!DOCTYPE html>
<html>

<head>
    <title>Laporan Stok Barang</title>
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

        .text-right {
            text-align: right;
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

        .bg-yellow {
            background-color: #eab308;
        }

        .bg-red {
            background-color: #ef4444;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Stok Barang</h1>
        <p>Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Supplier</th>
                <th class="text-right">Harga</th>
                <th class="text-center">Stok</th>
                <th class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->code }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name }}</td>
                <td>{{ $product->supplier ? $product->supplier->name : '-' }}</td>
                <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $product->current_stock }} {{ $product->unit }}</td>
                <td class="text-center">
                    @if($product->current_stock == 0)
                    <span class="badge bg-red">Habis</span>
                    @elseif($product->current_stock < 10) <span class="badge bg-yellow">Rendah</span>
                        @else
                        <span class="badge bg-green">Aman</span>
                        @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>