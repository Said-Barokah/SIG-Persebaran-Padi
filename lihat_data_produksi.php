<?php session_start() ?>
<?php
require_once('includes\koneksi.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lihat Data Produksi Padi</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
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
        <div class="w-screen container flex min-h-screen items-center justify-center pl-[300px]">
            <div class="py-8">
                <div>
                    <h2 class="text-2xl font-semibold leading-tight">Data Produksi</h2>
                </div>
                <div class="my-2 flex sm:flex-row flex-col w-[800px] justify-between">
                    <div class='flex'>
                        <!-- <div class="flex flex-row mb-1 sm:mb-0">
                            <div class="relative">
                                <select
                                    class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                    <option>5</option>
                                    <option>10</option>
                                    <option>20</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="relative">
                                <select
                                    class="appearance-none h-full rounded-r border-t sm:rounded-r-none sm:border-r-0 border-r border-b block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:border-l focus:border-r focus:bg-white focus:border-gray-500">
                                    <option>All</option>
                                    <option>Active</option>
                                    <option>Inactive</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div> -->
                        <form method="GET" action="" class="flex justify-center items-center">
                            <div class="block relative">
                                <span class="absolute top-0 left-0 inset-y-0 flex items-center pl-2">
                                    <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                        <path
                                            d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                        </path>
                                    </svg>
                                </span>
                                <input name="search" placeholder="Search"
                                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                                    class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                            </div>
                            <button type="submit" class="ml-5 px-4 py-2 bg-blue-500 text-white rounded">Search</button>
                        </form>

                    </div>

                    <?php


                    // Buat pilihan select
                    

                    if (isset($_SESSION['uname'])) {
                        $query = "SELECT DISTINCT jenis_padi FROM produksi_padi";
                        $result = pg_query($conn, $query);
                        echo '<a href="tambah_data_produksi.php" class="middle none center rounded-lg bg-gradient-to-tr from-pink-600 to-pink-400 px-6 pt-[10px] font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
                                Tambah Data
                                    </a>';
                    echo '<button onclick="exportToExcel()" class="middle none center rounded-lg bg-gradient-to-tr from-green-600 to-green-400 px-6 font-sans text-xs font-bold uppercase text-white shadow-md shadow-pink-500/20 transition-all hover:shadow-lg hover:shadow-pink-500/40 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" data-ripple-light="true">
                            Cetak Data
                            </button>';
                    } ?>
                </div>
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Kecamatan
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Jenis Padi
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Luas Tanam
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Luas Panen
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Produktivitas
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Produksi Padi
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'includes\controller\data_produksi\lihat_data_produksi_controller.php';
                                ?>
                            </tbody>
                        </table>
                        <!-- <div
                            class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                            <span class="text-xs xs:text-sm text-gray-900">
                                Showing 1 to 4 of 50 Entries
                            </span>
                            <div class="inline-flex mt-2 xs:mt-0">
                                <button
                                    class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                    Prev
                                </button>
                                <button
                                    class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r">
                                    Next
                                </button>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Mengambil referensi elemen kartu dan tombol
            var card = document.querySelector('.card');
            var closeButton = document.getElementById('close');

            // Menambahkan event listener untuk tombol
            closeButton.addEventListener('click', function () {
                card.classList.add('scale-0');
                setTimeout(function () {
                    card.classList.add('hidden');
                }, 500); // Tunggu sampai anima// Menyembunyikan kartu
            });
        </script>
            <script>
                function exportToExcel() {
                    // Redirect ke file PHP yang menghasilkan Excel
                    window.location.href = 'includes/controller/data_produksi/cetak_data_produksi_controller.php'; // Ubah 'jenis_padi' sesuai kebutuhan
                }
            </script>
</body>

</html>