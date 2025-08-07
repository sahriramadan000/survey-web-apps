<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Statistik Pemilihan Desain</title>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">
  <header class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white py-6 shadow text-center">
    <h1 class="text-2xl font-semibold">Dashboard Statistik Pemilihan Desain</h1>
  </header>

  <main class="px-6 py-10 max-w-7xl mx-auto">
    <!-- CHART SECTION -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
      <div class="bg-white p-5 rounded-2xl shadow">
        <h2 class="text-indigo-600 font-semibold mb-4">Ukuran Baju</h2>
        <canvas id="sizeChart"></canvas>
      </div>
      <div class="bg-white p-5 rounded-2xl shadow">
        <h2 class="text-indigo-600 font-semibold mb-4">Tipe Baju</h2>
        <canvas id="typeChart"></canvas>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
      <div class="bg-white p-5 rounded-2xl shadow">
        <h2 class="text-indigo-600 font-semibold mb-4">Jumlah Pemilih per Desain</h2>
        <canvas id="designChart"></canvas>
      </div>
      <div class="bg-white p-5 rounded-2xl shadow">
        <h2 class="text-indigo-600 font-semibold mb-4">Kategori Desain</h2>
        <canvas id="categoryChart"></canvas>
      </div>
    </div>

    <div class="bg-white p-5 rounded-2xl shadow mb-10">
      <h2 class="text-indigo-600 font-semibold mb-4">Distribusi Tahun Lahir</h2>
      <canvas id="birthYearChart"></canvas>
    </div>

    <!-- TABLE: Desain Count -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Data Jumlah Pemilih per Desain</h2>
        <div class="overflow-x-auto">
            <table class="stripe hover w-full text-sm datatable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4 text-sm font-semibold">No</th>
                        <th class="py-3 px-4 text-sm font-semibold">Nama Desain</th>
                        <th class="py-3 px-4 text-sm font-semibold">Jumlah Pemilih</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                @foreach($designCounts as $design => $count)
                    <tr class="hover:bg-indigo-50">
                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4">{{ ucwords(str_replace('_', ' ', $design)) }}</td>
                    <td class="py-2 px-4">{{ $count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- TABLE: Survey Data -->
    <div class="bg-white p-6 rounded-lg shadow-md mt-10">
        <h2 class="text-2xl font-bold mb-4">Data Survey</h2>
        <div class="overflow-x-auto">
            <table class="stripe hover w-full text-sm datatable">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Nama Lengkap</th>
                        <th class="py-3 px-4">Tahun Lahir</th>
                        @foreach ([
                        'resurge_2025',
                        'no_mercy',
                        'flower_of_snake',
                        'gordon',
                        'wing_of_love',
                        'nemesis',
                        'make_money_not_girlfriend',
                        'born_to_die',
                        'bloomrage',
                        'samurai'
                        ] as $item)
                        <th class="py-3 px-4">{{ ucwords(str_replace('_', ' ', $item)) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                @foreach($user_selections as $key => $data)
                    <tr class="hover:bg-indigo-50">
                    <td class="py-2 px-4">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4">{{ $data->name }}</td>
                    <td class="py-2 px-4">{{ $data->birth_year }}</td>
                    @foreach ([
                        'resurge_2025',
                        'no_mercy',
                        'flower_of_snake',
                        'gordon',
                        'wing_of_love',
                        'nemesis',
                        'make_money_not_girlfriend',
                        'born_to_die',
                        'bloomrage',
                        'samurai'
                    ] as $item)
                        <td class="py-2 px-4">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $data->$item == 1 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $data->$item == 1 ? 'Suka' : 'Tidak Suka' }}
                        </span>
                        </td>
                    @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</main>

  <script>
    $(document).ready(function () {
        new Chart(document.getElementById('designChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_map('ucwords', str_replace('_', ' ', array_keys($designCounts)))) !!},
            datasets: [{
            label: 'Jumlah Pemilih',
            data: {!! json_encode(array_values($designCounts)) !!},
            backgroundColor: 'rgba(99, 102, 241, 0.7)'
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        new Chart(document.getElementById('sizeChart'), {
        type: 'pie',
        data: {
            labels: {!! json_encode($shirtSizes->keys()) !!},
            datasets: [{
            data: {!! json_encode($shirtSizes->values()) !!},
            backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ef4444']
            }]
        }
        });

        new Chart(document.getElementById('typeChart'), {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($shirtTypes->keys()) !!},
            datasets: [{
            data: {!! json_encode($shirtTypes->values()) !!},
            backgroundColor: ['#8b5cf6', '#06b6d4', '#f43f5e']
            }]
        }
        });

        new Chart(document.getElementById('categoryChart'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($designCategories->keys()) !!},
            datasets: [{
            label: 'Jumlah',
            data: {!! json_encode($designCategories->values()) !!},
            backgroundColor: 'rgba(255, 159, 64, 0.7)'
            }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });

        new Chart(document.getElementById('birthYearChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($birthYears->keys()) !!},
            datasets: [{
            label: 'Jumlah Orang',
            data: {!! json_encode($birthYears->values()) !!},
            borderColor: 'rgba(255, 99, 132, 1)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            fill: true,
            tension: 0.3
            }]
        }
        });

        $('.datatable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Monitoring Data'
                }
            ]
        });
    });
  </script>
</body>
</html>
