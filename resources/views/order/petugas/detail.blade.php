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

        <div class="text-3xl font-medium my-4">Pembayaran</div>

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

        <div class="bg-white p-8 rounded-lg shadow-md grid grid-cols-1 gap-6">
            <div class="mb-5">
                <a href="{{ route('petugas.order.bukti', $order->id) }}">
                    <button type="button"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Unduh
                    </button>
                </a>
                <a href="{{ route('petugas.order.index') }}"
                    class="w-28 text-white bg-gray-500 hover:bg-gray-600 focus:ring-2 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Kembali
                </a>
            </div>

            <div class="flex justify-between">
                <div class="font-normal text-sm uppercase">
                    <p class="font-bold">{{ $member->no_telp }}</p>
                    <p>Member sejak : {{ $member->created_at->format('d M Y') }}</p>
                    <p>Member poin : {{ $member->point ?? '0'}}</p>
                </div>
                <div class="font-normal text-sm text-right">
                    <p>Invoice - #{{ $order->id }}</p>
                    <p>{{ $order->created_at->format('d M Y') }}</p>
                </div>
            </div>

            <table class="w-full text-sm text-left text-gray-700 dark:text-gray-200">
                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-3">Nama Produk</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Quantity</th>
                        <th class="px-4 py-3">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->details as $detail)
                        <tr class="border-b dark:border-gray-600">
                            <td class="px-4 py-2">
                                {{ $detail->product->product_name }}</td>
                            <td class="px-4 py-2">{{ $detail->qty }}</td>
                            <td class="px-4 py-2">Rp.
                                {{ number_format($detail->product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-2">Rp.
                                {{ number_format($detail->sub_total, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                <div class="grid grid-cols-4 gap-4 bg-gray-100 p-6 mt-6 rounded-lg">
                    <div class="text-sm text-gray-600">
                        <p class="uppercase">Poin Digunakan</p>
                        <p class="text-lg font-semibold text-gray-800">{{ $order->used_point }}</p>
                    </div>
                    <div class="text-sm text-gray-600">
                        <p class="uppercase">Kasir</p>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $user->role === 'admin' ? 'Administrator' : 'Petugas' }}</p>
                    </div>
                    <div class="text-sm text-gray-600">
                        <p class="uppercase">Kembalian</p>
                        <p class="text-lg font-semibold text-gray-800">Rp.  {{ number_format($order->total_return, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-gray-800 text-white rounded-lg p-4 text-right">
                        <p class="uppercase text-sm text-gray-400">Total</p>

                        @php
                            $hargaAsli = $order->total_price + $order->used_point;
                        @endphp

                        <p class="text-lg line-through">Rp. {{ number_format($hargaAsli, 0, ',', '.') }}</p>

                        <p class="text-2xl font-bold">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>

            </div>

        </div>

    </div>
