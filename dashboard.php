<!-- dashboard.php -->
<?php
session_start();
require_once('includes\koneksi.php');

// Tampilkan konten dashboard di sini
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Tambahkan tag head sesuai kebutuhan -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
  <style>

  </style>
</head>

<body>
  <?php include 'template/sidebar.php'; ?>
  <?php include 'includes/controller/data_produksi/count_dashboard.php'; ?>
  <?php
  include 'template/sidebar.php';
  include 'includes/controller/peta/geografis_information_controller.php';
  ?>

  <!-- Menyertakan sidebar template -->
  <div class=" ml-[300px] top-0 mt-5 bg-white pr-[100px]">
    <div class="mt-7 mb-7">
      <h1 class="text-center text-gray-500 text-4xl font-bold">SISTEM INFORMASI GEOGRAFIS PRODUKSI PADI KABUPATEN BANGKALAN</h1>
    </div>
    <div class="flex mt-7 mb-7">
      <div class="flex flex-row m-auto p-6 gap-8 rounded-lg border-2 border-gray-400 mr-7">
        <div class="my-auto">
          <div class="text-lg text-gray-700">Jumlah Kecamatan</div>
          <div class="text-4xl text-gray-700">
            <?= $jumlah_kecamatan; ?>
          </div>
        </div>
        <div class="text-purple-300 my-auto bg-[#A7D397] rounded-full p-4">
          <svg class="fill-[#eaf2f9]" height="52px" width="52px"  viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"
            stroke="">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <path
                d="M12 23.5c-1 0 .183-1.579-4.747-4.035a7.857 7.857 0 0 1-.785-.45C4.015 17.419 2.5 14.5 2.5 11.358 2.5 6.19 6.753 2 12 2s9.5 4.19 9.5 9.357c0 3.462-1.844 6.657-4.745 8.104C11.82 21.92 13 23.5 12 23.5zm0-8.39c2.111 0 3.8-1.672 3.8-3.705C15.8 9.372 14.111 7.7 12 7.7c-2.111 0-3.8 1.672-3.8 3.705 0 2.033 1.689 3.705 3.8 3.705z"
                ></path>
            </g>
          </svg>
        </div>
      </div>
      <div class="flex flex-row m-auto p-6 gap-8 rounded-lg border-2 border-gray-400 mr-7">
        <div class="my-auto">
          <div class="text-lg text-gray-700">Total produksi tahun
            <?= $tahun_terbaru ?>
          </div>
          <div class="text-4xl text-gray-700">
            <?= $total_produksi_padi ?>
          </div>
        </div>
        <div class="text-purple-300 my-auto bg-[#A7D397] rounded-full p-4">
          <svg class="fill-[#eaf2f9]" height="52px" width="52px" viewBox="0 0 24 24" id="statistic-grow"
            data-name="Flat Line" xmlns="http://www.w3.org/2000/svg" class="icon flat-line">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <line id="primary" x1="3" y1="19" x2="21" y2="19"
                style="fill: none; stroke: #eaf2f9; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
              </line>
              <polyline id="primary-2" data-name="primary" points="3 15 8 9 14 12 21 5"
                style="fill: none; stroke: #eaf2f9; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
              </polyline>
              <polyline id="primary-3" data-name="primary" points="21 10 21 5 16 5"
                style="fill: none; stroke: #eaf2f9; stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
              </polyline>
            </g>
          </svg>
        </div>
      </div>
      <div class="flex flex-row m-auto p-6 gap-8 rounded-lg border-2 border-gray-400">
        <div class="my-auto">
          <div class="text-lg text-gray-700">Jumlah Data Padi</div>
          <div class="text-4xl text-gray-700">
            <?= $jumlah_jenis_padi ?>
          </div>
        </div>
        <div class="text-purple-300 my-auto bg-[#A7D397]  rounded-full p-4">
          <svg class="fill-[#eaf2f9]" height="52px" width="52px" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" stroke="">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
              <path
                d="M22.5,13c0-0.3-0.2-0.5-0.5-0.5c-0.5,0-1,0.1-1.5,0.2c1.2-1.2,2-2.8,2-4.7c0-0.3-0.2-0.5-0.5-0.5c-1.5,0-2.9,0.5-4,1.4 c0.7-2.2,0.1-4.8-1.6-6.5c-0.2-0.2-0.5-0.2-0.7,0c-1.8,1.8-2.3,4.3-1.6,6.5c-1.1-0.9-2.5-1.4-4-1.4C9.7,7.5,9.5,7.7,9.5,8 c0,1.8,0.8,3.5,2,4.7c-0.5-0.1-1-0.2-1.5-0.2c-0.3,0-0.5,0.2-0.5,0.5c0,1.8,0.8,3.5,2,4.7c-0.5-0.1-1-0.2-1.5-0.2 c-0.3,0-0.5,0.2-0.5,0.5c0,3.2,2.4,5.9,5.5,6.4V29c0,0.6,0.4,1,1,1s1-0.4,1-1v-4.6c3.1-0.5,5.5-3.2,5.5-6.4c0-0.3-0.2-0.5-0.5-0.5 c-0.5,0-1,0.1-1.5,0.2C21.7,16.5,22.5,14.8,22.5,13z M16,14.5c0.5,0,1-0.1,1.5-0.2c-0.6,0.6-1.2,1.4-1.5,2.2 c-0.3-0.8-0.9-1.6-1.5-2.2C15,14.4,15.5,14.5,16,14.5z M16,21.5c-0.3-0.8-0.9-1.6-1.5-2.2c0.5,0.1,1,0.2,1.5,0.2s1-0.1,1.5-0.2 C16.9,19.9,16.3,20.7,16,21.5z">
              </path>
            </g>
          </svg>
        </div>
      </div>

    </div>
    <div class="mb-9" id="map" style="width: 100%; height: 550px;"></div>
    <div id="custom-popup">
      <div id="popup-content" class="text-center"></div>
    </div>

    <div id="table-container" class="black">
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet-src.js"
    integrity="sha512-x4B5AXtD8SqDqEpzOFXxCE0OOUhQ0Fep3Qka6WtUa3tw7z4fC7eOI4Vjm191HB63//4Y554Zxydbt2Hi8b+bVQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    var map = L.map('map').setView([-7.036328, 112.738405], 12); // Ganti latitude dan longitude dengan koordinat yang sesuai
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 12,
    }).addTo(map);

    var customPopup = document.getElementById('custom-popup');
    var popupContent = document.getElementById('popup-content');

    var dataProduksi = <?php echo $data_produksi_json; ?>;
    var dataIdSatu = dataProduksi.filter(function (item) {
      return item.id === '1';
    });

    // Sekarang, dataIdSatu akan berisi semua entri dengan id === '1'
    console.log(dataIdSatu);
    var dataKecamatan = <?php echo $data_kecamatan_json; ?>;
    dataKecamatan.forEach(function (data) {
      fetch(data.geojson)
        .then(function (response) {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json(); // Mengambil data JSON dari respons
        })
        .then(function (geojsonData) {
          L.geoJSON(geojsonData).addTo(map);
         
        })
        .catch(function (error) {
          console.error('Fetch error:', error);
        });
    });
  </script>
</body>

</html>