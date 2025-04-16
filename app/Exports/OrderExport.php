<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    protected $request;
    public function __construct($request) {
        $this->request = $request;
    }
    public function collection()
    {
        $query = Order::with(['user', 'member'])
        ->when($this->request->filled('yearFilter'), function ($q) {
            $q->whereYear('created_at', $this->request->yearFilter);
        })
        ->when($this->request->filled('monthFilter'), function ($q) {
            $q->whereMonth('created_at', $this->request->monthFilter);
        })
        ->when($this->request->filled('dayFilter'), function ($q) {
            $q->whereDay('created_at', $this->request->dayFilter);
        });


        return $query->get()->map(function ($order) {
            return [
                'Nama Pelanggan' => $order->member?->name ?? 'Non Member',
                'No HP Pelanggan' => $order->member?->no_telp ?? '-',
                'Poin Pelanggan' => $order->point ?? '0',
                'Produk' => $order->details->map(function ($detail) {
                    $subtotal = $detail->qty * $detail->product->price;
                    return "{$detail->product->product_name} ( {$detail->qty} : Rp. " . number_format($subtotal, 0, ',', '.') . " )";
                })->implode(', '),
                'Total Harga' => $order->total_price,
                'Total Bayar' => $order->total_payment,
                'Total Diskon Poin' => $order->used_point ?? '0',
                'Total Kembalian' => $order->total_return,
                'Tanggal Pembelian' => $order->created_at->format('d-m-Y'),
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama Pelanggan', 'No HP Pelanggan', 'Poin Pelanggan',	'Produk', 'Total Harga', 'Total Bayar',	'Total Diskon Poin', 'Total Kembalian', 'Tanggal Pembelian'];
    }
}
