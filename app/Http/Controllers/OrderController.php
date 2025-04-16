<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Member;
use App\Models\OrderDetail;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortBy = $request->get('sort_by', 'created_at');
        $order = $request->get('order', 'desc');
        $search = $request->get('search');

        $user = Auth::user();

        $orders = Order::with(['user', 'details.product', 'member'])
            ->when($search, function ($query) use ($search) {
                $formattedPrice = str_replace('.', '', $search);

                $query->where(function ($q) use ($search, $formattedPrice) {
                    $q->whereHas('member', function ($q2) use ($search) {
                        $q2->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('user', function ($q3) use ($search) {
                        $q3->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhere('created_at', 'like', '%' . $search . '%')
                    ->orWhere('total_price', 'like', '%' . $formattedPrice . '%');
                });
            })
            ->orderBy($sortBy, $order)
            ->paginate(10);

        return view('order.admin.index', compact('orders', 'user'));
    }

    public function data(Request $request)
    {
        $sortBy = $request->get('sort_by', 'created_at');
        $order = $request->get('order', 'desc');
        $search = $request->get('search');

        $user = Auth::user();

        $orders = Order::with(['user', 'details.product', 'member'])
                ->when($search, function ($query) use ($search) {
                    $formattedPrice = str_replace('.', '', $search);

                    $query->where(function ($q) use ($search, $formattedPrice) {
                        $q->whereHas('member', function ($q2) use ($search) {
                            $q2->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('user', function ($q3) use ($search) {
                            $q3->where('name', 'like', '%' . $search . '%');
                        })
                        ->orWhere('created_at', 'like', '%' . $search . '%')
                        ->orWhere('total_price', 'like', '%' . $formattedPrice . '%');
                    });
                })
                ->when($sortBy === 'member_name', function ($query) use ($order) {
                    $query->join('members', 'orders.member_id', '=', 'members.id')
                        ->orderBy('members.name', $order)
                        ->select('orders.*');
                }, function ($query) use ($sortBy, $order) {
                    $query->orderBy($sortBy, $order);
                })->when($request->yearFilter, function ($query) use ($request) {
                    $query->whereYear('created_at', $request->yearFilter);
                })
                ->when($request->monthFilter, function ($query) use ($request) {
                    $query->whereMonth('created_at', $request->monthFilter);
                })
                ->when($request->dayFilter, function ($query) use ($request) {
                    $query->whereDay('created_at', $request->dayFilter);
                })
                ->paginate(5);

        return view('order.petugas.index', compact('orders', 'user'));
    }

    public function detail($id)
    {
        $order = Order::findOrFail($id);
        $member = Member::findOrFail($order->member_id);
        $user = Auth::user();

        return view('order.petugas.detail', compact('order', 'member', 'user'));
    }

    public function member()
    {
        // Ambil order terakhir dan detail
        $order = Order::with(['details.product'])->latest()->first();

        return view('order.petugas.member', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('order.petugas.create', compact('products'));
    }

    public function store(Request $request)
    {
        $productIds = $request->input('product_ids', []);

        $totalQuantity = collect($productIds)->sum();

        if ($totalQuantity == 0) {
            return redirect()->back()
                             ->withInput()
                             ->withErrors(['message' => 'Silakan pilih minimal 1 produk.']);
        }

        $selectedProducts = [];

        foreach ($productIds as $id => $qty) {
            if ((int)$qty > 0) {
                $product = Product::find($id);
                $total = $product->price * (int)$qty;

                $selectedProducts[] = [
                    'id' => $product->id,
                    'name' => $product->product_name,
                    'price' => $product->price,
                    'quantity' => $qty,
                    'total' => $total,
                ];
            }
        }

        $grandTotal = array_sum(array_column($selectedProducts, 'total'));

        return view('order.petugas.post', compact('selectedProducts', 'grandTotal'));
    }


    /**
     * Store a newly created resource in storage.
     */


     public function post(Request $request)
     {
         $request->validate([
             'products' => 'required|array',
             'total_price' => 'required|numeric',
             'total_payment' => 'required|numeric',
             'member_status' => 'required|string',
         ]);

         $memberId = null;
         $earnedPoint = floor($request->total_price / 100);
         $pointDisplay = null;

         if ($request->member_status === 'Member' && $request->no_telp) {
            $member = Member::where('no_telp', $request->no_telp)->first();

            if ($member) {
                $memberId = $member->id;
                $pointDisplay = $member->total_point + $earnedPoint;

                session([
                    'member_id' => $memberId,
                    'no_telp' => $member->no_telp,
                    'name' => $member->name,
                    'point' => $member->total_point,
                    'is_new_member' => false
                ]);
            } else {
                // Langsung buat member baru dengan name kosong
                $member = Member::create([
                    'name' => null, // nama belum diketahui
                    'no_telp' => $request->no_telp,
                    'total_point' => 0,
                ]);

                $memberId = $member->id;
                $pointDisplay = $earnedPoint;

                session([
                    'member_id' => $memberId,
                    'no_telp' => $member->no_telp,
                    'name' => null,
                    'point' => 0,
                    'is_new_member' => true
                ]);
            }

            session(['point_display' => $pointDisplay]);
        }

         $totalReturn = $request->total_payment - $request->total_price;

         $order = Order::create([
             'total_price' => $request->total_price,
             'total_payment' => $request->total_payment,
             'total_return' => $totalReturn,
             'user_id' => Auth::id(),
             'member_id' => $memberId,
             'point' => $earnedPoint,
             'used_point' => 0,
         ]);

         session(['order_id' => $order->id]);

         foreach ($request->products as $product) {
             OrderDetail::create([
                 'order_id' => $order->id,
                 'product_id' => $product['product_id'],
                 'qty' => $product['quantity'],
                 'sub_total' => $product['sub_total'],
                 'user_id' => Auth::id(),
             ]);

             $productData = Product::find($product['product_id']);
             if ($productData) {
                 $productData->stock -= $product['quantity'];
                 $productData->save();
             }
         }

         if ($memberId || session('is_new_member')) {
             return redirect()->route('petugas.order.member');
         }

         return redirect()->route('petugas.order.index')->with('success', 'Pesanan berhasil disimpan.');
     }

     public function storeOrder(Request $request)
    {
        $orderId = session('order_id');
        $order = Order::findOrFail($orderId);

        $originalPrice = $order->total_price;
        $finalPayment = $order->total_payment;
        $earnedPoint = floor($originalPrice / 100);
        $usePoint = $request->has('use_point');

        $memberId = session('member_id');
        $member = null;

        // Cek apakah session menandakan bahwa ini member baru
        if (session('is_new_member')) {
            if ($memberId) {
                // Ambil data member yang sudah dibuat di post()
                $member = Member::find($memberId);
                if ($member) {
                    $member->update([
                        'name' => $request->name
                    ]);
                }
            } else {
                // Buat member baru (fallback, semestinya ini tidak terpanggil)
                $member = Member::create([
                    'name' => $request->name,
                    'no_telp' => session('no_telp'),
                    'total_point' => 0,
                ]);
                $memberId = $member->id;
                $order->update(['member_id' => $member->id]);
            }
        } else {
            // Member lama, ambil dari session member_id dan update nama
            if ($memberId) {
                $member = Member::find($memberId);
                if ($member && $request->name && $member->name !== $request->name) {
                    $member->update([
                        'name' => $request->name
                    ]);
                }
            }
        }

        if (!$member) {
            return back()->with('error', 'Member tidak ditemukan.');
        }

        $usedPoint = 0;

        if ($usePoint) {
            $pointDisplay = session('point_display');
            $usedPoint = min($pointDisplay, $originalPrice);

            $discountedPrice = max($originalPrice - $usedPoint, 0);
            $newReturn = $finalPayment - $discountedPrice;

            $member->total_point = $pointDisplay - $usedPoint;
            $member->save();

            $order->update([
                'total_price' => $discountedPrice,
                'total_return' => $newReturn,
                'used_point' => $usedPoint,
                'point' => $earnedPoint,
            ]);
        } else {
            $member->total_point += $earnedPoint;
            $member->save();

            $order->update([
                'point' => $earnedPoint,
                'used_point' => 0,
            ]);
        }

        // Hapus session
        session()->forget([
            'member_id', 'name', 'no_telp', 'point', 'is_new_member', 'order_id', 'point_display'
        ]);

        return redirect()->route('petugas.order.detail', $orderId)
            ->with('success', 'Pesanan member berhasil disimpan.');
    }

     public function unduhBukti($id)
     {
         $order = Order::with('member', 'details.product')->findOrFail($id);

         $pdf = Pdf::loadView('order.petugas.bukti', compact('order'));

         return $pdf->download('bukti-order-' . $order->id . '.pdf');
     }

     public function exportBukti(Request $r)
     {

        return Excel::download(new OrderExport($r), 'data-penjualan.xlsx');
     }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
