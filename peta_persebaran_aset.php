<?php
// Memanggil file koneksi.php
require_once('includes/koneksi.php');

?>
<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Persebaran Padi</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        img.huechange {
            filter: hue-rotate(120deg);
        }
    </style>
</head>

<body>
    <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased 
text-gray-800">
        <?php
        include 'template/sidebar.php';
        include 'includes/controller/peta/geografis_information_controller.php';
        ?>
        <div class="w-screen container flex min-h-screen justify-center pl-[380px]">
            <div class="py-8">
                <div>
                    <h2 class="text-2xl font-semibold leading-tight mb-4">Peta GIS</h2>
                </div>
                <!-- Form untuk pencarian nama kecamatan -->
                <div class="block relative w-[300px] mb-7">
                    <form class="block relative flex" action="peta_persebaran_aset.php" method="GET">
                        <span class="absolute top-0 left-0 inset-y-0 left-0 flex items-center pl-2">
                            <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                <path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path>
                            </svg>
                        </span>
                        <input placeholder="Cari nama kecamatan"
                            class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                            type="text" id="nama_kecamatan" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        <!-- Jika jenis padi sudah ada, tambahkan ke form -->
                        <input type="hidden" name="jenis_padi" value="<?php echo isset($_GET['jenis_padi']) ? htmlspecialchars($_GET['jenis_padi']) : ''; ?>">
                        <button type="submit" class="ml-4 middle none center rounded-lg bg-gradient-to-tr from-pink-600 to-pink-400 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">Cari</button>
                    </form>
                </div>

                <!-- Form untuk memilih jenis padi -->
                <div class="flex items-center mb-4 text-[12px]">
                    <form action="peta_persebaran_aset.php" method="GET" class="flex flex-row space-x-4">
                        <div>
                            <label for="jenis" class="text-gray-500 font-semibold">Tampilkan pada peta yaitu:</label>
                            <select name="jenis_padi" id="jenis" class="rounded-md px-3 py-3 text-white font-semibold bg-sky-500" onchange="this.form.submit()">
                                <option value="Padi Ladang" <?php if (isset($_GET['jenis_padi']) && $_GET['jenis_padi'] == 'Padi Ladang') echo 'selected'; ?>>Padi Ladang</option>
                                <option value="Padi Sawah" <?php if (isset($_GET['jenis_padi']) && $_GET['jenis_padi'] == 'Padi Sawah') echo 'selected'; ?>>Padi Sawah</option>
                                <option value="Padi" <?php if (isset($_GET['jenis_padi']) && $_GET['jenis_padi'] == 'Padi') echo 'selected'; ?>>Padi</option>
                            </select>
                        </div>
                        <div>
                            <label for="tahun" class="text-gray-500 font-semibold">Tahun Produksi:</label>
                            <?php
                            $query = "SELECT MIN(tahun) as tahun_min FROM produksi_padi";
                            $result = pg_query($conn, $query);
                            $row = pg_fetch_assoc($result);
                            $tahun_min = $row['tahun_min'];
                            $tahun_sekarang = date("Y");
                            ?>
                            <select name="tahun" id="tahun" class="rounded-md px-3 py-3 text-white font-semibold bg-sky-500" onchange="this.form.submit()">
                                <option value="">Pilih Tahun</option>
                                <?php
                                // Loop untuk membuat opsi dari tahun minimal hingga tahun sekarang
                                for ($tahun = $tahun_min; $tahun <= $tahun_sekarang; $tahun++) {
                                    // Cek jika tahun yang dipilih sama dengan tahun di dropdown
                                    $selected = (isset($_GET['tahun']) && $_GET['tahun'] == $tahun) ? 'selected' : '';
                                    echo "<option value='$tahun' $selected>$tahun</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Jika ada search, tambahkan ke form -->
                        <input type="hidden" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    </form>
                </div>

                <div class="flex justify-center items-center mb-4 text-[10px] text-gray-400">
                    <p>
                        <?php
                        if ($jenis_padi == 'Padi Sawah') {
                            echo 'Peta Padi Sawah';
                        } elseif ($jenis_padi == 'Padi Ladang') {
                            echo 'Peta Padi Ladang';
                        } else {
                            echo 'Peta Jenis Padi Tidak Diketahui';
                        }
                        ?>
                    </p>
                </div>
                <div class="flex space-x-4 py-3 ">
                        <div class="flex flex-col space-y-1">
                            <p class="text-[10px] text-gray-400">Tidak ada</p>
                            <span class="w-3 h-3 bg-gray-600"></span>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p class="text-[10px] text-gray-400">Rendah</p>
                            <span class="w-3 h-3 bg-red-600"></span>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p class="text-[10px] text-gray-400">Normal</p>
                            <span class="w-3 h-3 bg-yellow-600"></span>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <p class="text-[10px] text-gray-400">TInggi</p>
                            <span class="w-3 h-3 bg-green-600"></span>
                        </div>
                </div>
                <div class="w-100 md:w-[800px]" id="map" style="height: 550px;"></div>
                <div id="custom-popup">
                    <div id="popup-content" class="text-center"></div>
                </div>
                <div id="table-container" class="black">
                </div>
            </div>
        </div>
    </div>

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
        var dataIdSatu = dataProduksi.filter(function(item) {
            return item.id === '1';
        });

        // Sekarang, dataIdSatu akan berisi semua entri dengan id === '1'
        console.log(dataIdSatu);
        var dataKecamatan = <?php echo $data_kecamatan_json; ?>;
        console.log("Data Kecamatan", dataKecamatan)
        dataKecamatan.forEach(function(data) {
            fetch(data.geojson)
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json(); // Mengambil data JSON dari respons
                })
                .then(function(geojsonData) {
                    var geojsonLayer = L.geoJSON(geojsonData, {
                        style: function(feature) {
                            var produksiPadi = data.produksi_padi; // Ambil nilai produksi padi dari geojson
                            console.log("Produksi Padi", produksiPadi); // Cek nilai produksi_padi
                            var fillColor;
                            if (produksiPadi === null || produksiPadi === undefined) {
                                fillColor = 'gray'; // Warna default jika data tidak tersedia
                            } else if (produksiPadi >= 0 && produksiPadi <= 146000) {
                                fillColor = 'red'; // Warna untuk kategori "Rendah"
                            } else if (produksiPadi > 146000 && produksiPadi <= 292000) {
                                fillColor = 'yellow'; // Warna untuk kategori "Normal"
                            } else if (produksiPadi > 292000) {
                                fillColor = 'green'; // Warna untuk kategori "Tinggi"
                            }

                            return {
                                fillColor: fillColor,
                                weight: 2,
                                opacity: 1,
                                color: 'white', // Warna border
                                fillOpacity: 0.7
                            };
                        }
                    }).addTo(map);


                    geojsonLayer.eachLayer(function(layer) {
                        layer.on('click', function(event) {
                            // Setel konten popup sesuai kebutuhan
                            console.log(data)
                            var dataIdSatu = dataProduksi.filter(function(item) {
                                return item.id === data.id;
                            });

                            function createTableFromData(data) {
                                var table = '<table class="table-auto">';
                                table += '<thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50"><tr><th class="p-2 whitespace-nowrap">Jenis Padi</th><th class="p-2 whitespace-nowrap">Tahun Produksi</th><th class="p-2 whitespace-nowrap">Luas Tanam</th><th class="p-2 whitespace-nowrap">Luas Panen</th><th class="p-2 whitespace-nowrap">Produktivitas</th><th class="p-2 whitespace-nowrap">Produksi Padi</th></tr></thead>';
                                table += '<tbody class="text-sm divide-y divide-gray-100">'
                                data.forEach(function(item) {
                                    table += '<tr>';
                                    table += '<td class="p-2 whitespace-nowrap">' + item.jenis_padi + '</td>';
                                    table += '<td class="p-2 whitespace-nowrap">' + item.tahun_prod + '</td>';
                                    table += '<td class="p-2 whitespace-nowrap">' + item.luas_tanam + '</td>';
                                    table += '<td class="p-2 whitespace-nowrap">' + item.luas_panen + '</td>';
                                    table += '<td class="p-2 whitespace-nowrap">' + item.produktivitas + '</td>';
                                    table += '<td class="p-2 whitespace-nowrap">' + item.padi_prod + '</td>';
                                    table += '</tr>';
                                });
                                table += '</tbody>'
                                table += '</table>';
                                return table;
                            }

                            var tableHtml = createTableFromData(dataIdSatu);

                            // Tampilkan tabel di dalam div dengan id 'table-container' (gantilah dengan id yang sesuai)
                            document.getElementById('table-container').innerHTML = tableHtml;
                            popupContent.innerHTML = 'Data Kecamatan ' + data.nama_kecamatan;

                            // Tampilkan div popup
                            customPopup.style.display = 'block';

                            // Atur posisi div popup sesuai dengan lokasi klik
                            customPopup.style.left = (event.originalEvent.clientX + 10) + 'px';
                            customPopup.style.top = (event.originalEvent.clientY - 50) + 'px';
                        });
                    });
                })
                .catch(function(error) {
                    console.error('Fetch error:', error);
                });
        });
    </script>

</body>

</html>