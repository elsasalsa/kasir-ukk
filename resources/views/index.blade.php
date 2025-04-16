@extends('layouts.app')

@section('content')

    <div class="jumbotron">
        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>

    <div class="main mt-20 ml-72 mr-8">
        <form class="flex items-center max-w-sm mb-10">
            <div class="relative w-full">
                <input type="text" id="simple-search"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-6 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search..." required />
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
                        <a href="#"
                            class="ms-1 text-sm font-medium text-gray-700 md:ms-2 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
                    </div>
                </li>
            </ol>
        </nav>
        <div class="text-3xl font-medium my-4">Dashboard</div>

        @if (Auth::user()->role == 'admin')
            <!-- Card containing the graph -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h3 class="text-xl font-semibold mb-4">Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}!</h3>
                <div class="flex">
                    <!-- Left Column: Bar Chart -->
                    <div class="w-2/3">
                        <canvas id="salesChart" width="500" height="300"></canvas>
                    </div>

                    <!-- Right Column: Pie Chart -->
                    <div class="w-1/3 pl-6">
                        <h4 class="text-lg font-semibold mb-4">Persentase Penjualan Produk</h4>
                        <canvas id="productSalesPieChart" width="300" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- Chart.js CDN -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!-- Chart Script -->
            <script>
                const ordersByDate = @json($ordersByDate);
                const productSales = @json($productSales);

                // Bar Chart: Orders by Date
                const ctx1 = document.getElementById('salesChart').getContext('2d');
                new Chart(ctx1, {
                    type: 'bar',
                    data: {
                        labels: ordersByDate.map(item => item.date),
                        datasets: [{
                            label: 'Jumlah Order',
                            data: ordersByDate.map(item => item.total),
                            backgroundColor: 'rgba(100, 181, 246, 0.6)',
                            borderColor: 'rgba(100, 181, 246, 1)',
                            borderWidth: 1,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tanggal'
                                }
                            },
                            y: {
                                title: {
                                    display: true,
                                    text: 'Jumlah'
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Pie Chart: Product Sales Percentage
                const ctx2 = document.getElementById('productSalesPieChart').getContext('2d');
                new Chart(ctx2, {
                    type: 'pie',
                    data: {
                        labels: productSales.map(item => item.product_name),
                        datasets: [{
                            data: productSales.map(item => item.total_sold),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)',
                                'rgba(99, 255, 132, 0.6)',
                                'rgba(162, 54, 235, 0.6)',
                                'rgba(206, 255, 86, 0.6)',
                                'rgba(192, 75, 192, 0.6)'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            }
                        }
                    }
                });
            </script>
        @endif

        @if (Auth::user()->role == 'petugas')
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <h3 class="text-xl font-semibold mb-4">Selamat Datang, {{ Auth::user()->name ?? 'Petugas' }}!</h3>

                <div class="bg-gray-100 rounded-lg p-4 text-center">
                    <p class="text-gray-500 text-sm mb-5">Total Penjualan Hari Ini</p>
                    <hr>
                    <h2 class="text-2xl font-bold mt-2 mb-3">{{ $totalPenjualan ?? 0 }}</h2>
                    <p class="text-gray-500 text-sm mb-5">Jumlah total penjualan yang terjadi hari ini.</p>
                    <p class="text-gray-400 text-xs mt-2">
                        Terakhir diperbarui: {{ $lastUpdated }}
                    </p>
                </div>
            </div>
        @endif
    </div>
