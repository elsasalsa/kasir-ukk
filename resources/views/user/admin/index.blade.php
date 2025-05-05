@extends('layouts.app')

@section('content')

    <div class="main mt-20 ml-72 mr-8">
        <form class="flex items-center max-w-sm mb-10" method="GET" action="{{ route('admin.user.index') }}">
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
            <a href="{{ route('admin.user.index') }}"
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
                            class="ms-1 text-sm font-medium text-gray-700  md:ms-2 dark:text-gray-400 dark:hover:text-white">User</a>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="text-3xl font-medium my-4">User</div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-12 bg-white p-4">
            <div class="flex justify-end mb-4">
                <a href="{{ route('admin.user.create') }}"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300
                        font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700
                        focus:outline-none dark:focus:ring-blue-800">
                    Tambah User
                </a>
            </div>
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @foreach ($users as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td class="px-6 py-4">
                                {{ $no++ }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item['email'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item['name'] }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item['role'] == 'employee' ? 'petugas' : $item['role'] }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($item['role'] !== 'admin')
                                <button type="button"
                                        onclick="window.location.href='{{ route('admin.user.edit', $item->id) }}'"
                                        class="inline-flex items-center justify-center focus:outline-none text-white bg-yellow-400
                                        hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5
                                        me-1 mb-1 dark:focus:ring-yellow-900">
                                    Edit
                                </button>
                                @else
                                    <button type="button" class="inline-flex items-center justify-center focus:outline-none text-gray-500 bg-gray-300
                                    cursor-not-allowed text-sm px-5 py-2.5 me-1 mb-1 rounded-lg">
                                        Edit
                                    </button>
                                @endif

                                {{-- Show the delete button only if the role is not admin --}}
                                @if ($item['role'] !== 'admin')
                                    <form action="{{ route('admin.user.delete', $item->id) }}" method="POST"
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
                                @else
                                    <button type="button" class="inline-flex items-center justify-center focus:outline-none text-gray-500 bg-gray-300
                                    cursor-not-allowed text-sm px-5 py-2.5 me-1 mb-1 rounded-lg">
                                        Hapus
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>


                {{-- <div class="mt-4">
                    {{ $users->links() }}
                </div> --}}
            </table>
        </div>

    </div>
