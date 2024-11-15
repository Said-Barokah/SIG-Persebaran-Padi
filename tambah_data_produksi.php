<?php
session_start();
include 'includes\koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Data Produksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-white">
    <?php include 'template/sidebar.php'; ?> <!-- Menyertakan sidebar template -->

    <div class="absolute left-[40%]  top-0 max-w-md mt-5 p-5 bg-white rounded-lg shadow-md">
        <?php
        if (isset($_GET['error'])) {
            $errorMessage = $_GET['error'];
            echo '<!-- Danger -->
            <div class="px-8 py-6 bg-red-400 text-white flex justify-between rounded">
                <div class="flex items-center">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
                    <p>Gagal! Data gagal ditambahkan!</p>
                </div>
                <button class="text-red-100 hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            ';
        }
        ?>
        <h2 class="text-2xl font-semibold text-center mb-4">Tambah Data Produksi</h2>

        <div class="">
            <div class="w-full max-w-[550px] bg-white"> 
                <form class="py-6 px-9" action="includes\controller\data_produksi\tambah_data_produksi_controller.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-5">
                        <label for="jenis_padi" class="mb-3 block text-base font-medium text-[#07074D]">
                            Jenis padi:
                        </label>
                        <input type="text" name="jenis_padi" id="jenis_padi" placeholder="Produksi Gedung Gol .." class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="tahun" class="mb-3 block text-base font-medium text-[#07074D]">
                            Tahun:
                        </label>
                        <input type="number" name="tahun" id="tahun" placeholder="2019" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="luas_tanam" class="mb-3 block text-base font-medium text-[#07074D]">
                            Luas Tanam (H<sup>2</sup>)::
                        </label>
                        <input type="text" name="luas_tanam" id="luas_tanam" placeholder="100" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="luas_panen" class="mb-3 block text-base font-medium text-[#07074D]">
                            Luas Panen (H<sup>2</sup>)::
                        </label>
                        <input type="text" name="luas_panen" id="luas_panen" placeholder="100" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="produktivitas" class="mb-3 block text-base font-medium text-[#07074D]">
                            Produktivitas (H<sup>2</sup>)::
                        </label>
                        <input type="text" name="produktivitas" id="produktivitas" placeholder="100" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <div class="mb-5">
                        <label for="produksi_padi" class="mb-3 block text-base font-medium text-[#07074D]">
                            Produksi Padi:
                        </label>
                        <input type="text" name="produksi_padi" id="produksi_padi" placeholder="100" class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                    <?php
                    require_once('includes\koneksi.php');
                    $query_kecamatan = "SELECT id, nama_kecamatan FROM kecamatan";
                    $result_kecamatan = pg_query($conn, $query_kecamatan);
                    ?>
                    <label for="kode_kecamatan" class="mb-3 block text-base font-medium text-[#07074D]">Kecamatan:</label>
                    <select name="kode_kecamatan" class="mb-3 w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md">
                        <?php
                        while ($row = pg_fetch_assoc($result_kecamatan)) {
                            echo '<option value="' . $row['id'] . '">' . $row['nama_kecamatan'] . '</option>';
                        }
                        ?>
                    </select>
                
                    <div>
                        <button class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                            Send File
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    


</body>


</html>