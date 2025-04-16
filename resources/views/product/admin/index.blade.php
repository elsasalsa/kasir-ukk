@extends('layouts.app')

@section('content')

    <div class="main mt-20 ml-72 mr-8">
        <form class="flex items-center max-w-sm mb-10" method="GET" action="{{ route('admin.product.index') }}">
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
            <a href="{{ route('admin.product.index') }}"
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
                            class="ms-1 text-sm font-medium text-gray-700  md:ms-2 dark:text-gray-400 dark:hover:text-white">Produk</a>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="text-3xl font-medium my-4">Produk</div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-12 px-4 py-8 bg-white p-4">
            <div class="flex justify-end">
                <a href="{{ route('admin.product.create') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300
                    font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700
                    focus:outline-none dark:focus:ring-blue-800">
                    Tambah Produk
                </a>
            </div>
            <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama Produk
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Harga
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Stok
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($products as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">
                                {{ $no++ }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->product_image)
                                    <img src="{{ asset('storage/' . $item['product_image']) }}"
                                        class="card-img-top w-24 h-24 object-cover rounded" alt="Bukti">
                                @else
                                    <span class="text-gray-500">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $item['product_name'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($item['price'], 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item['stock'] }}
                            </td>
                            <td class="px-6 py-4">
                                <button type="button"
                                    onclick="window.location.href='{{ route('admin.product.edit', $item->id) }}'"
                                    class="inline-flex items-center justify-center focus:outline-none text-white bg-yellow-400
                                    hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5
                                    me-1 mb-1 dark:focus:ring-yellow-900">
                                    Edit
                                </button>
                                <!-- Tombol Update Stock -->
                                <button type="button" data-modal-target="crud-modal-{{ $item->id }}"
                                    data-modal-toggle="crud-modal-{{ $item->id }}"
                                    class="inline-flex items-center justify-center focus:outline-none text-white bg-blue-300
                                        hover:bg-blue-400 focus:ring-4 focus:ring-blue-200 font-medium rounded-lg text-sm px-5 py-2.5
                                        me-1 mb-1 dark:focus:ring-blue-800">
                                    Update Stock
                                </button>

                                <!-- Modal (Harus dalam loop, jadi 1 modal per produk) -->
                                <div id="crud-modal-{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Update Stock Product
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="crud-modal-{{ $item->id }}">
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
                                            <!-- Modal body -->
                                            <form class="p-4 md:p-5"
                                                action="{{ route('admin.product.updateStock', $item['id']) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="name"
                                                            class="block mb-2 text-sm font-medium text-left text-gray-900 dark:text-white">
                                                            Nama Produk<span class="text-red-500">*</span>
                                                        </label>
                                                        <input type="text" name="product_name"
                                                            value="{{ $item['product_name'] }}"
                                                            class="bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300 border border-gray-300
                                                                   text-sm rounded-lg focus:ring-0 focus:border-gray-300 block w-full p-2.5 cursor-not-allowed"
                                                            disabled>
                                                    </div>
                                                    <div class="col-span-2">
                                                        <label for="stock"
                                                            class="block mb-2 text-sm font-medium text-left text-gray-900 dark:text-white">
                                                            Stock<span class="text-red-500">*</span>
                                                        </label>
                                                        <input type="number" name="stock"
                                                        value="{{ $item['stock'] }}"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                                                               focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                                                               dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white
                                                               dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        required min="0" max="9999">

                                                    </div>
                                                </div>
                                                <div class="flex justify-end mt-10">
                                                    <button type="submit"
                                                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800
                                                                focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg
                                                                text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700
                                                                dark:focus:ring-blue-800">
                                                        Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <form action="{{ route('admin.product.delete', $item->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center justify-center focus:outline-none text-white bg-red-700 hover:bg-red-800
                                        focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5
                                        me-1 mb-1 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between pt-6 px-10"
                aria-label="Table navigation">
                <span
                    class="text-sm font-normal text-gray-500 dark:text-gray-400 mb-4 md:mb-0 block w-full md:inline md:w-auto">
                    Showing
                    <span
                        class="font-semibold text-gray-900 dark:text-white">{{ $products->firstItem() }}-{{ $products->lastItem() }}</span>
                    of
                    <span class="font-semibold text-gray-900 dark:text-white">{{ $products->total() }}</span>
                </span>

                <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                    {{-- Previous Page Link --}}
                    @if ($products->onFirstPage())
                        <li>
                            <span
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-400 bg-white border border-gray-300 rounded-s-lg">Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $products->previousPageUrl() }}"
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                        </li>
                    @endif

                    {{-- Pagination Numbers --}}
                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <li>
                                <span
                                    class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                        <li>
                            <a href="{{ $products->nextPageUrl() }}"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                        </li>
                    @else
                        <li>
                            <span
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-400 bg-white border border-gray-300 rounded-e-lg">Next</span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>

    </div>
