<?php
session_start();
require_once('includes\koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Produksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>

<body class="bg-white">
    <?php include 'template/sidebar.php'; ?> <!-- Menyertakan sidebar template -->

    <div class="absolute left-[40%]  top-0 max-w-md mt-5 p-5 bg-white rounded-lg shadow-md">
        <?php
        if (isset($_GET['error'])) {
            $errorMessage = $_GET['error'];
            echo '<div class="card-error transition-transform ease-in-out duration-500 px-8 py-6 bg-red-400 text-white flex justify-between rounded">
            <div class="flex items-center">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
                <p>Gagal! Data gagal ditambahkan!</p>
            </div>
            <button id="closeBtn" class=" text-red-100 hover:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>';
        }
        ?>
        <?php
        if (isset($_GET['success'])) {
            $errorMessage = $_GET['success'];
            echo "<div class='alert alert-danger'>$errorMessage</div>";
        }
        ?>

        <?php

        $id_data_produksi = $_GET['id'];

        // Query untuk mengambil data produksi yang akan diedit
        $query = "SELECT * FROM produksi_padi WHERE id = $id_data_produksi";
        $result = pg_query($conn, $query);
        $row = pg_fetch_assoc($result);

        ?>




        <h2 class="text-2xl font-semibold text-center mb-4">Edit Data Produksi</h2>
        <div class="">
            <div class="w-full max-w-[550px] bg-white">
                <div class="py-6 px-9"
                    action="includes\controller\data_produksi\update_data_produksi_controller.php?id=<?php echo $id_data_produksi ?>"
                    method="POST" enctype="multipart/form-data">
                    <div class="mb-5">
                        <label for="jenis_padi" class="mb-3 block text-base font-medium text-[#07074D]">
                            Jenis padi:
                        </label>
                        <input type="text" value="<?= $row['jenis_padi'] ?>" name="jenis_padi" id="jenis_padi"
                            placeholder="Padi Beras"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" disabled/>
                    </div>
                    <div class="mb-5">
                        <label for="tahun" class="mb-3 block text-base font-medium text-[#07074D]">
                            Tahun:
                        </label>
                        <input type="number" value="<?= $row['tahun'] ?>" name="tahun" id="tahun" placeholder="2017"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" disabled/>
                    </div>
                    <div class="mb-5">
                        <label for="luas_tanam" class="mb-3 block text-base font-medium text-[#07074D]">
                            Luas Tanam (H<sup>2</sup>)::
                        </label>
                        <input type="number" value="<?= $row['luas_tanam'] ?>" name="luas_tanam" id="luas_tanam"
                            placeholder="100"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" disabled/>
                    </div>
                    <div class="mb-5">
                        <label for="luas_panen" class="mb-3 block text-base font-medium text-[#07074D]">
                            Luas Panen (H<sup>2</sup>)::
                        </label>
                        <input type="number" value="<?= $row['luas_panen'] ?>" name="luas_panen" id="luas_panen"
                            placeholder="100"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" disabled/>
                    </div>
                    <div class="mb-5">
                        <label for="produktivitas" class="mb-3 block text-base font-medium text-[#07074D]">
                            Produktivitas (H<sup>2</sup>)::
                        </label>
                        <input type="number" value="<?= $row['produktivitas'] ?>" name="produktivitas" id="produktivitas"
                            placeholder="100"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" disabled/>
                    </div>
                    <div class="mb-5">
                        <label for="produksi_padi" class="mb-3 block text-base font-medium text-[#07074D]">
                            Produksi Padi:
                        </label>
                        <input type="number" value="<?= $row['produksi_padi'] ?>" name="produksi_padi" id="produksi_padi"
                            placeholder="100"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" disabled/>
                    </div>
                    <?php
                    require_once('includes\koneksi.php');
                    $query_kecamatan = "SELECT id, nama_kecamatan FROM kecamatan";
                    $result_kecamatan = pg_query($conn, $query_kecamatan);
                    ?>

                    <label for="kode_kecamatan"
                        class="mb-3 block text-base font-medium text-[#07074D]">Kecamatan:</label>
                    <select name="kode_kecamatan"
                        class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" disabled>
                        <?php
                        while ($row_kec = pg_fetch_assoc($result_kecamatan)) {
                            $selected = ($row_kec['id'] == $row['kode_kecamatan']) ? 'selected' : ''; // Periksa apakah id sama dengan kode_kecamatan
                            echo '<option value="' . $row_kec['id'] . '" ' . $selected . '>' . $row_kec['nama_kecamatan'] . '</option>';
                        }
                        ?>
                    </select>
                    </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet-src.js"
        integrity="sha512-x4B5AXtD8SqDqEpzOFXxCE0OOUhQ0Fep3Qka6WtUa3tw7z4fC7eOI4Vjm191HB63//4Y554Zxydbt2Hi8b+bVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var latitude = document.getElementById('latitude').value;
        var longitude = document.getElementById('longitude').value;
        var map = L.map('map').setView([latitude, longitude], 12); // Ganti latitude dan longitude dengan koordinat yang sesuai
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 12,
        }).addTo(map);
        var marker = L.marker([latitude, longitude]).addTo(map);

        function updateMap() {
            var latitude = document.getElementById('latitude').value;
            var longitude = document.getElementById('longitude').value;
            if (!isNaN(latitude) && !isNaN(longitude)) {
                map.setView([latitude, longitude], 13);
                marker.setLatLng([latitude, longitude]);
            } else {
                alert("Harap masukkan koordinat yang valid.");
            }
        }
    </script>
    <script>
        document.getElementById("gambarInput").addEventListener("change", function () {
            const preview = document.getElementById("preview");
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = "block";
                    this.files.value = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
                preview.style.display = "none";
            }
        });

    </script>

    <script>
        // Mengambil referensi elemen kartu dan tombol
        var card = document.querySelector('.card-error');
        var closeButton = document.getElementById('closeBtn');

        // Menambahkan event listener untuk tombol
        closeButton.addEventListener('click', function () {
            card.classList.add('scale-0');
            setTimeout(function () {
                card.classList.add('hidden');
            }, 500); // Tunggu sampai anima// Menyembunyikan kartu
        });
    </script>
</body>

</html>