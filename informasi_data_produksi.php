<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Data Produksi Padi</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
<?php include 'includes/controller/data_produksi/count_data_produksi_controller.php'; ?>

    <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased 
text-gray-800">
        <?php include 'template/sidebar.php'; ?> <!-- Menyertakan sidebar template -->
        <?php
        if (isset($_GET['error'])) {
            $errorMessage = $_GET['error'];
            echo '<!-- Danger -->
        <div class="card transition-transform ease-in-out duration-500 transform absolute top-[30px] left-[40%] z-[100] px-8 py-6 bg-red-400 text-white flex justify-between rounded">
            <div class="flex items-center">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
                <p>Gagal! ' . $errorMessage . '!</p>
            </div>
            <button id="close" class="text-red-100 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        ';
        }
        ?>
        <?php
        if (isset($_GET['success'])) {
            $successMessage = $_GET['success'];
            echo '  <div class="card transition-transform ease-in-out duration-500 transform absolute top-[30px] left-[40%] z-[100] px-8 py-6 bg-green-400 text-white flex justify-between rounded"> <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"
                />
            </svg>
            <p>Sukses! ' . $successMessage . '!</p>
        </div>

        <button id="close" class="close text-green-100 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button> </div>';
        }
        ?>
        <div class="w-screen container flex flex-col min-h-screen items-center justify-center pl-[300px] pr-[100px]">
            <div class="py-8">
                <div>
                    <h2 class="text-2xl font-semibold leading-tight">Informasi Data Produksi</h2>
                </div>
            </div>
            <canvas id="multiAxisLineChart"></canvas>
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Tahun
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Jenis Padi
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Nama Kecamatan
                        </th>
                        <th
                            class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                            Produksi Terbanyak
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($data_max as $row): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                                <?php echo $row['tahun']; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                <?php echo $row['jenis_padi']; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                <?php echo $row['nama_kecamatan']; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                                <?php echo $row['produksi_terbanyak']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const data = <?php echo $data_produksi_tahun_json; ?>;
            console.log(data)
            var groupedData = {};
            data.forEach(item => {
                if (!groupedData[item.jenis_padi]) {
                    groupedData[item.jenis_padi] = {
                        label: item.jenis_padi,
                        data: [],
                        borderColor: getRandomColor(),
                        fill: false
                    };
                }
                groupedData[item.jenis_padi].data.push(item.total_produksi);
            });

            var uniqueYears = [];

            data.forEach(item => {
                if (!uniqueYears.includes(item.tahun)) {
                    uniqueYears.push(item.tahun);
                }
            });


            // Menyusun data ke dalam format yang sesuai untuk Chart.js
            var chartData = {
                labels: uniqueYears,
                datasets: Object.values(groupedData)
            };

            var ctx = document.getElementById('multiAxisLineChart').getContext('2d');

            var lineChart = new Chart(ctx, {
                type: 'line',
                data: chartData,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Tahun'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Produksi'
                            }
                        }
                    }
                }
            });

            // Fungsi untuk menghasilkan warna acak
            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                    color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
            }
        </script>
</body>

</html>