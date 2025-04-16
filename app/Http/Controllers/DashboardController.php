<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $today = Carbon::today();

        $totalPenjualan = Order::whereDate('created_at', $today)->count();

        $lastOrder = Order::latest('created_at')->first();
        $lastUpdated = $lastOrder
        ? Carbon::parse($lastOrder->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY HH:mm')
        : 'Belum ada transaksi';

        // Ambil data order per tanggal
        $ordersByDate = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Ambil jumlah produk terjual berdasarkan order_detail
        $productSales = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select('products.product_name', DB::raw('SUM(order_details.qty) as total_sold'))
            ->groupBy('products.product_name')
            ->get();

        return view('index', compact('totalPenjualan', 'lastUpdated', 'ordersByDate', 'productSales'));
    }
}
