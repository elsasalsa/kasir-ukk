@extends('layouts.app')

@section('content')
    <div class="main mt-20 ml-72 mr-8">
        <form action="{{ route('petugas.order.index') }}" method="GET" class="flex items-center max-w-sm mb-10">
            @csrf

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

        @if (Session::get('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ Session::get('success') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.remove();">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <title>Close</title>
                        <path
                            d="M14.348 5.652a1 1 0 1 0-1.414-1.414L10 7.172 7.066 4.238a1 1 0 1 0-1.414 1.414L8.586 8.586l-2.934 2.934a1 1 0 1 0 1.414 1.414L10 10.828l2.934 2.934a1 1 0 0 0 1.414-1.414L11.414 8.586l2.934-2.934z" />
                    </svg>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <ul class="list-disc list-inside mt-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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

        <form action="{{ route('petugas.order.storeOrder') }}" method="POST">
            @csrf

            <div class="bg-white p-6 rounded-lg shadow-md grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Ringkasan Pembelian -->
                <div class="border p-6 rounded-lg shadow-md max-w-2xl mx-auto">
                    <h2 class="text-lg font-medium mb-4">Ringkasan Pembelian</h2>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-700">
                            <thead class="text-xs text-gray-500 uppercase bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-4 py-3">Nama Produk</th>
                                    <th scope="col" class="px-4 py-3">Qty</th>
                                    <th scope="col" class="px-4 py-3">Harga</th>
                                    <th scope="col" class="px-4 py-3">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->details as $detail)
                                    <tr class="border-b">
                                        <td class="px-4 py-2">{{ $detail->product->product_name }}</td>
                                        <td class="px-4 py-2">{{ $detail->qty }}</td>
                                        <td class="px-4 py-2">Rp. {{ number_format($detail->product->price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-4 py-2">Rp. {{ number_format($detail->sub_total, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 text-right space-y-2">
                        <p class="font-semibold text-base">Total Harga:
                            <span class="text-black font-bold">
                                Rp. {{ number_format($order->total_price, 0, ',', '.') }}
                            </span>
                        </p>
                        <p class="font-semibold text-base">Total Bayar:
                            <span class="text-black font-bold">
                                Rp. {{ number_format($order->total_payment, 0, ',', '.') }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Form Input Member -->
                <div>

                    <div class="mt-5 grid grid-cols-1 gap-4">
                        <input type="hidden" name="member_id" value="{{ session('member_id') }}">
                        <input type="hidden" name="no_telp" value="{{ session('no_telp') }}">
                        <input type="hidden" name="total_price" value="{{ $order->total_price }}">

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Member (identitas)
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', session('name')) }}"
                                class="mt-1 p-2 w-full border rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        @if (session('point_display'))
                            <div class="mb-4">
                                <label for="point" class="block text-sm font-medium text-gray-700">Total Poin
                                    Sekarang</label>
                                <input type="text" id="point" name="point"
                                    value="{{ session('point_display') }}" readonly
                                    class="mt-1 p-2 w-full border rounded-lg bg-gray-100 text-gray-700">
                            </div>
                        @endif

                    </div>

                    @if (session('is_new_member'))
                        <span class="text-red-500 text-sm">Poin akan aktif pada pembelanjaan berikutnya.</span>
                    @else
                        <div class="flex items-center mt-3">
                            <input id="use_point" type="checkbox" name="use_point" value="1"
                                {{ request('use_point') ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm">
                            <label for="use_point" class="ms-2 text-sm">Gunakan poin untuk potongan harga</label>
                        </div>
                    @endif

                    <div class="mt-4 text-right">
                        <button type="submit"
                            class="px-5 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300">
                            Selanjutnya
                        </button>
                    </div>
                </div>


            </div>
        </form>

    </div>
