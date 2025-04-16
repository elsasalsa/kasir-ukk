<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Penjualan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .section { margin-bottom: 10px; margin-top: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 5px; border-bottom: 1px solid #ccc; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    <h2>Vlexy Lite</h2>
    <div class="section">
        <strong>{{ $order->member->name ?? 'Non Member' }}</strong><br>
        Member Status: {{ $order->member ? 'Member' : 'Non Member' }}<br>
        No. HP: {{ $order->member->no_telp ?? '-' }}<br>
        Bergabung Sejak: {{ $order->member ? $order->member->created_at->format('d F Y') : '-' }}<br>
        Poin Member: {{ $order->member->total_point ?? 0 }}
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">Nama Produk</th>
                <th class="text-center">QTy</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Sub Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->details as $detail)
                <tr>
                    <td class="text-center">{{ $detail->product->product_name }}</td>
                    <td class="text-center">{{ $detail->qty }}</td>
                    <td class="text-center">Rp. {{ number_format($detail->product->price, 0, ',', '.') }}</td>
                    <td class="text-center">Rp. {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="section text-right">
        <p>Total Harga: <strong>Rp. {{ number_format($order->total_price + $order->used_point, 0, ',', '.') }}</strong></p>
        <p>Poin Digunakan: {{ $order->used_point }}</p>
        <p>Harga Setelah Poin: Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
        <p>Total Kembalian: Rp. {{ number_format($order->total_return, 0, ',', '.') }}</p>
        <p>{{ $order->created_at->format('d-m-Y H:i') }} | Petugas</p>
    </div>

    <p>Terima kasih atas pembelian Anda!</p>
</body>
</html>
