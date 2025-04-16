@extends('layouts.app')

@section('content')
    <div class="main ml-72 mt-20 mr-8">
        <form action="{{ route('petugas.order.index') }}" method="GET" class="flex items-center max-w-sm mb-10">
            @csrf

            @if (Session::get('success'))
                <div class="alert alert-success"> {{ Session::get('success') }}</div>
            @endif

            <div class="relative w-full">
                <input type="text" name="query" id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-6 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search..." value="{{ request('query') }}" />
            </div>
            <button type="submit"
                class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </form>

        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('index') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="{{ route('petugas.order.index') }}"
                            class="ms-1 text-sm font-medium text-gray-700  md:ms-2 dark:text-gray-400 dark:hover:text-white">Penjualan</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#"
                            class="ms-1 text-sm font-medium text-gray-700  md:ms-2 dark:text-gray-400 dark:hover:text-white">Tambah
                            Penjualan</a>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="text-3xl font-medium my-4">Penjualan</div>

        @if ($errors->has('message'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ $errors->first('message') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.remove();">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a1 1 0 1 0-1.414-1.414L10 7.172 7.066 4.238a1 1 0 1 0-1.414 1.414L8.586 8.586l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 10.828l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 8.586l2.934-2.934z" />
                    </svg>
                </button>
            </div>
        @endif

        <form action="{{ route('petugas.order.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($products as $product)
                    <div class="max-w-sm p-6 bg-white border rounded-lg shadow-sm">
                        <img src="{{ asset('storage/' . $product['product_image']) }}" alt="Product Image">
                        <p class="text-center font-semibold mt-3">{{ $product->product_name }}</p>
                        <p class="text-center">Stock: {{ $product->stock }}</p>
                        <p class="text-center font-bold">Rp{{ number_format($product->price, 0, ',', '.') }}</p>

                        <div class="flex justify-center items-center gap-4 mt-2">
                            <button type="button"
                                onclick="decreaseQuantity({{ $product->id }}, {{ $product->price }})">-</button>
                            <span id="quantity-{{ $product->id }}">0</span>
                            <button type="button"
                                onclick="increaseQuantity({{ $product->id }}, {{ $product->price }}, {{ $product->stock }})">+</button>
                        </div>

                        <p class="text-center text-sm mt-2">Total: Rp<span id="total-{{ $product->id }}">0</span></p>

                        <!-- Hidden input -->
                        <input type="hidden" name="product_ids[{{ $product->id }}]" id="input-{{ $product->id }}"
                            value="0">
                    </div>
                @endforeach
            </div>

            <footer
                class="fixed bottom-0 left-64 right-0 bg-white mt-24 rounded-lg shadow-sm dark:bg-gray-800 z-50 flex justify-center py-4">
                <button type="submit" class="px-5 py-2.5 bg-blue-700 text-white rounded-lg hover:bg-blue-800">
                    Selanjutnya
                </button>
            </footer>
        </form>


        <script>
            function increaseQuantity(productId, price, stock) {
                let quantityElement = document.getElementById(`quantity-${productId}`);
                let totalElement = document.getElementById(`total-${productId}`);
                let inputElement = document.getElementById(`input-${productId}`);

                let quantity = parseInt(quantityElement.textContent);

                if (quantity < stock) {
                    quantity++;
                    quantityElement.textContent = quantity;
                    totalElement.textContent = (quantity * price).toLocaleString('id-ID');
                    inputElement.value = quantity;
                } else {
                    alert("Stok produk sudah habis!");
                }
            }

            function decreaseQuantity(productId, price) {
                let quantityElement = document.getElementById(`quantity-${productId}`);
                let totalElement = document.getElementById(`total-${productId}`);
                let inputElement = document.getElementById(`input-${productId}`);

                let quantity = parseInt(quantityElement.textContent);
                if (quantity > 0) {
                    quantity--;
                    quantityElement.textContent = quantity;
                    totalElement.textContent = (quantity * price).toLocaleString('id-ID');
                    inputElement.value = quantity;
                }
            }
        </script>

    </div>



    {{-- <script>
    let selectedProducts = {};

    function increaseQuantity(productId, price) {
        let quantityElement = document.getElementById(`quantity-${productId}`);
        let totalElement = document.getElementById(`total-${productId}`);
        let productName = document.getElementById(`product-name-${productId}`).textContent;

        let quantity = parseInt(quantityElement.textContent);
        quantity++;
        quantityElement.textContent = quantity;
        totalElement.textContent = (quantity * price).toLocaleString('id-ID');

        selectedProducts[productId] = {
            name: productName,
            quantity: quantity,
            price: price
        };

        saveToLocalStorage();
    }

    function decreaseQuantity(productId, price) {
        let quantityElement = document.getElementById(`quantity-${productId}`);
        let totalElement = document.getElementById(`total-${productId}`);

        let quantity = parseInt(quantityElement.textContent);
        if (quantity > 0) {
            quantity--;
            quantityElement.textContent = quantity;
            totalElement.textContent = (quantity * price).toLocaleString('id-ID');

            if (quantity === 0) {
                delete selectedProducts[productId];
            } else {
                selectedProducts[productId].quantity = quantity;
            }

            saveToLocalStorage();
        }
    }

    function saveToLocalStorage() {
        localStorage.setItem('selectedProducts', JSON.stringify(selectedProducts));
    }
</script> --}}
