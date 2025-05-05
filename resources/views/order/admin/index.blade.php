@extends('layouts.app')

@section('content')

    <div class="main mt-20 ml-72 mr-8">
        <form class="flex items-center max-w-sm mb-10" method="GET" action="{{ route('admin.order.index') }}">
            <div class="relative w-full">
                <input type="text" id="simple-search" name="search" value="{{ request('search') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-6 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search..." />
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
            <a href="{{ route('admin.order.index') }}"
                class="p-2.5 ms-2 text-sm font-medium text-white bg-gray-500 rounded-lg border border-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                <svg class="w-4 h-4 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 14 3-3m-3 3 3 3m-3-3h16v-3m2-7-3 3m3-3-3-3m3 3H3v3" />
                </svg>
                <span class="sr-only">Refresh</span>
            </a>
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
                        <a href="#"
                            class="ms-1 text-sm font-medium text-gray-700  md:ms-2 dark:text-gray-400 dark:hover:text-white">Pembelian</a>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="text-3xl font-medium my-4">Pembelian</div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-12 bg-white p-4">
            <div class="mb-4 flex justify-between">
                <form action="{{ route('petugas.order.export') }}" method="get">
                    <input type="hidden" name="yearFilter" value="{{ request('yearFilter') }}">
                    <input type="hidden" name="monthFilter" value="{{ request('monthFilter') }}">
                    <input type="hidden" name="dayFilter" value="{{ request('dayFilter') }}">
                    <button
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300
                    font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700
                    focus:outline-none dark:focus:ring-blue-800">
                        Export Penjualan (.xlsx)</button>
                </form>
                <form action="{{ route('petugas.order.index') }}" method="GET" class="flex items-center gap-4">

                    <select name="yearFilter" onchange="this.form.submit()"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Tahun</option>
                        <option value="2025" {{ request('yearFilter') == '2025' ? 'selected' : '' }}>2025</option>
                        <option value="2024" {{ request('yearFilter') == '2024' ? 'selected' : '' }}>2024</option>
                    </select>

                    <select name="monthFilter" onchange="this.form.submit()"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Bulan</option>
                        <option value="01" {{ request('monthFilter') == '01' ? 'selected' : '' }}>Januari</option>
                        <option value="02" {{ request('monthFilter') == '02' ? 'selected' : '' }}>Februari</option>
                        <option value="03" {{ request('monthFilter') == '03' ? 'selected' : '' }}>Maret</option>
                        <option value="04" {{ request('monthFilter') == '04' ? 'selected' : '' }}>April</option>
                        <option value="05" {{ request('monthFilter') == '05' ? 'selected' : '' }}>Mei</option>
                        <option value="06" {{ request('monthFilter') == '06' ? 'selected' : '' }}>Juni</option>
                        <option value="07" {{ request('monthFilter') == '07' ? 'selected' : '' }}>Juli</option>
                        <option value="08" {{ request('monthFilter') == '08' ? 'selected' : '' }}>Agustus</option>
                        <option value="09" {{ request('monthFilter') == '09' ? 'selected' : '' }}>September</option>
                        <option value="10" {{ request('monthFilter') == '10' ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ request('monthFilter') == '11' ? 'selected' : '' }}>November</option>
                        <option value="12" {{ request('monthFilter') == '12' ? 'selected' : '' }}>Desember</option>
                    </select>

                    <select name="dayFilter" onchange="this.form.submit()"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Pilih Hari</option>
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                {{ request('dayFilter') == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                            </option>
                        @endfor
                    </select>

                </form>
            </div>

            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-1">
                            <div class="flex items-center">
                                #
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-3 py-1">
                            <div class="flex items-center">
                                Nama Pelanggan
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-3 py-1">
                            <div class="flex items-center">
                                Tanggal Penjualan
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-3 py-1">
                            <div class="flex items-center">
                                Total Harga
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-3 py-1">
                            <div class="flex items-center">
                                Dibuat Oleh
                                <a href="#"><svg class="w-3 h-3 ms-1.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.574 11.024h6.852a2.075 2.075 0 0 0 1.847-1.086 1.9 1.9 0 0 0-.11-1.986L13.736 2.9a2.122 2.122 0 0 0-3.472 0L6.837 7.952a1.9 1.9 0 0 0-.11 1.986 2.074 2.074 0 0 0 1.847 1.086Zm6.852 1.952H8.574a2.072 2.072 0 0 0-1.847 1.087 1.9 1.9 0 0 0 .11 1.985l3.426 5.05a2.123 2.123 0 0 0 3.472 0l3.427-5.05a1.9 1.9 0 0 0 .11-1.985 2.074 2.074 0 0 0-1.846-1.087Z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-3 py-1">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($orders as $order)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">
                                {{ $no++ }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->member_id ? $order->member?->name ?? '' : 'non member' }}
                                {{-- {{ $member->name }} --}}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->created_at->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->user->name ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <button data-modal-target="modal-{{ $order->id }}"
                                    data-modal-toggle="modal-{{ $order->id }}" type="button"
                                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-1 mb-1 dark:focus:ring-yellow-900">Lihat</button>

                                <div id="modal-{{ $order->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden fixed inset-0 z-50 justify-center items-center overflow-y-auto overflow-x-hidden">

                                    <div class="fixed inset-0 bg-black bg-opacity-50"></div>

                                    <div class="relative z-50 p-8 w-full max-w-2xl max-h-full">
                                        <div class="relative bg-white dark:bg-gray-700 rounded-lg shadow-lg">
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-600 rounded-t">
                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                    Detail Penjualan
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-hide="modal-{{ $order->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>

                                            <div class="p-4 md:p-5 space-y-4">
                                                <div class="overflow-x-auto">
                                                    <div class="mb-5 flex justify-between text-sm">
                                                        <div class="text-left">
                                                            <p>Status Member : {{ $order->member ? 'Member' : 'Non Member' }}</p>
                                                            <p>No. HP : {{ $order->member->no_telp ?? '-' }}</p>
                                                            <p>Poin member : {{ $order->member->point ?? 0 }}</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p>Bergabung sejak : {{ $order->member?->created_at?->format('d-m-Y') ?? '-' }}</p>
                                                        </div>
                                                    </div>
                                                    <table
                                                        class="w-full text-sm text-left text-gray-700 dark:text-gray-200">
                                                        <thead
                                                            class="uppercase text-xs bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">
                                                            <tr>
                                                                <th class="px-4 py-3">Nama Produk</th>
                                                                <th class="px-4 py-3">Qty</th>
                                                                <th class="px-4 py-3">Harga</th>
                                                                <th class="px-4 py-3">Sub Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($order->details as $detail)
                                                                <tr class="border-b dark:border-gray-600 text-base">
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
                                                    <p class="text-right text-base font-bold mr-8 mt-3">Total Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>

                                                    <div class="mt-8">
                                                        <p class="text-base">Dibuat pada : {{ $order->created_at }}</p>
                                                        <p class="text-base mt-1">Oleh : {{ $user->role === 'admin' ? 'Administrator' : 'Petugas' }}</p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('admin.order.bukti', $order->id) }}">
                                    <button type="button"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                                        Unduh Bukti
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-4" aria-label="Table navigation">
                <span class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                    Showing
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $orders->firstItem() }}-{{ $orders->lastItem() }}</span>
                    of
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $orders->total() }}</span>
                </span>

                <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                    {{-- Previous Page Link --}}
                    @if ($orders->onFirstPage())
                        <li>
                            <span class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-400 bg-white border border-gray-300 rounded-s-lg">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $orders->previousPageUrl() }}" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                        </li>
                    @endif

                    {{-- Pagination Numbers --}}
                    @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                        @if ($page == $orders->currentPage())
                            <li>
                                <span class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($orders->hasMorePages())
                        <li>
                            <a href="{{ $orders->nextPageUrl() }}" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                        </li>
                    @else
                        <li>
                            <span class="flex items-center justify-center px-3 h-8 leading-tight text-gray-400 bg-white border border-gray-300 rounded-e-lg">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

    </div>
