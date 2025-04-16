<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->search;
            $priceSearch = str_replace('.', '', $search);

            $query->where(function ($q) use ($search, $priceSearch) {
                $q->where('product_name', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $priceSearch . '%')
                ->orWhere('stock', 'like', '%' . $search . '%');
            });
        }

        $products = $query->paginate(5)->withQueryString();

        return view('product.admin.index', compact('products'));
    }

    public function data(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->search;
            $priceSearch = str_replace('.', '', $search);

            $query->where(function ($q) use ($search, $priceSearch) {
                $q->where('product_name', 'like', '%' . $search . '%')
                ->orWhere('price', 'like', '%' . $priceSearch . '%')
                ->orWhere('stock', 'like', '%' . $search . '%');
            });
        }

        $products = $query->paginate(10)->withQueryString();

        return view('product.petugas.index', compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'product_image' => 'required|image|mimes:jpeg,png,jpg',
        ]);


        $file = $request->file('product_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $imageUrl = $file->storeAs('product', $fileName, 'public');

        Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'product_image' => $imageUrl,
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('product.admin.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'stock' => 'required',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg'
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('product_image')) {
            // Hapus gambar lama
            if ($product->product_image) {
                Storage::disk('public')->delete($product->product_image);
            }

            $file = $request->file('product_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $imageUrl = $file->storeAs('product', $fileName, 'public');
            $data['product_image'] = $imageUrl;
        }

        $product->update($data);

        return redirect()->route('admin.product.index')->with('success', 'Data berhasil diupdate');
    }

    public function updateStock(Request $request, $id)
    {
        // Validasi hanya untuk stock
        $data = $request->validate([
            'stock' => 'required|integer',
        ]);

        // Ambil data product berdasarkan id
        $product = Product::findOrFail($id);

        // Update hanya stock
        $product->update([
            'stock' => $data['stock'],
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('admin.product.index')->with('success', 'Stock berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::where('id', $id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil menghapus data !');
    }
}
