@extends('layouts.app')

@section('content')
    <div class="main mt-20 ml-72 mr-8">
        <form action="{{ route('petugas.order.index') }}" method="GET" class="flex items-center max-w-sm mb-10">
            @csrf

            @if (Session::get('success'))
                <div class="alert alert-success"> {{ Session::get('success') }}</div>
            @endif
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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

        <nav class="flex ml-2" aria-label="Breadcrumb">
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


        <div class="bg-white p-6 rounded-lg shadow-md grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-xl font-semibold mb-4">Produk yang Dipilih</p>
                <div class="space-y-4">
                    <form action="{{ route('petugas.order.post') }}" method="POST">
                        @csrf
                        @foreach ($selectedProducts as $product)
                            <div class="p-4 border rounded-md shadow-sm">
                                <p class="font-semibold text-gray-800">{{ $product['name'] }}</p>
                                <p>Jumlah: {{ $product['quantity'] }}</p>
                                <p>Harga Satuan: Rp{{ number_format($product['price'], 0, ',', '.') }}</p>
                                <p>Total: Rp{{ number_format($product['total'], 0, ',', '.') }}</p>

                                {{-- Tambahkan hidden input untuk dikirim ke controller --}}
                                <input type="hidden" name="products[{{ $loop->index }}][product_id]"
                                    value="{{ $product['id'] }}">
                                <input type="hidden" name="products[{{ $loop->index }}][quantity]"
                                    value="{{ $product['quantity'] }}">
                                <input type="hidden" name="products[{{ $loop->index }}][sub_total]"
                                    value="{{ $product['total'] }}">
                            </div>
                        @endforeach
                </div>

                <div class="flex justify-between border-t pt-3 mt-4 font-medium text-gray-800">
                    <p>Total</p>
                    <p>Rp{{ number_format($grandTotal, 0, ',', '.') }}</p>
                </div>
            </div>

            <div>
                <div class="mt-5 grid grid-cols-1 gap-4">
                    <input type="hidden" id="total_price" name="total_price" value="{{ $grandTotal }}" required>
                    {{-- <input type="hidden" id="qty" name="qty" value="" required>
                        <input type="hidden" id="sub_total" name="sub_total" value="" required> --}}
                    <div x-data="{ memberStatus: 'No Member' }">
                        <label for="member_status" class="block text-sm font-medium text-gray-700">
                            Member Status <span class="text-red-500">Dapat juga membuat member</span>
                        </label>
                        <select x-model="memberStatus" name="member_status" class="mt-1 p-2 w-full border rounded-lg">
                            <option value="No Member">Bukan Member</option>
                            <option value="Member">Member</option>
                        </select>
                        <input type="hidden" name="member_status" x-bind:value="memberStatus">

                        <div x-show="memberStatus === 'Member'" class="mt-4">
                            <label for="no_telp" class="block text-sm font-medium text-gray-700">
                                Telepon <span class="text-red-500">(daftar/gunakan member)</span>
                            </label>
                            <input type="number" id="no_telp" name="no_telp"
                                class="mt-1 p-2 w-full border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <div x-data="{ totalPrice: {{ $grandTotal }}, totalPayment: '', error: '' }">
                        <label for="total_payment" class="block text-sm font-medium text-gray-700">
                            Total Bayar <span class="text-red-500">*</span>
                        </label>

                        <input type="number" id="total_payment" name="total_payment" x-model="totalPayment"
                            x-on:input="
                                const numeric = parseInt(totalPayment) || 0;
                                if (numeric < totalPrice) {
                                    error = 'Jumlah bayar kurang.';
                                } else {
                                    error = '';
                                }
                            "
                            class="mt-1 p-2 w-full border rounded-lg focus:ring-blue-500 focus:border-blue-500">

                        <template x-if="error">
                            <p class="text-red-500 text-sm mt-1" x-text="error"></p>
                        </template>
                    </div>

                </div>

                <div class="mt-4 text-right">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                        Selanjutnya
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
