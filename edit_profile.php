<?php
require_once('includes\koneksi.php');

?>
<?php
session_start();

if (!isset($_SESSION['uname'])) {
  header("Location: login.php");
  exit();
}

// Tampilkan konten dashboard di sini
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="bg-white">
        <?php include 'template/sidebar.php'; ?>
        <?php
        if (isset($_GET['error'])) {
            $errorMessage = $_GET['error'];
            echo '<div class="card transition-transform ease-in-out duration-500 px-8 py-6 bg-red-400 text-white flex justify-between rounded">
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
            $successMessage = $_GET['success'];
            echo '  <div class="card transition-transform ease-in-out duration-500 transform absolute top-[30px] left-[40%] z-[100] px-8 py-6 bg-green-400 text-white flex justify-between rounded"> <div class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
                <path
                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z"
                />
            </svg>
            <p>Sukses! ' . $successMessage . '!</p>
        </div>

        <button id="closeBtn" class="close text-green-100 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button> </div>';
        }
        ?>

        <?php

        $uname = $_GET['uname'];

        // Query untuk mengambil data bangunan yang akan diedit
        $query = "SELECT * FROM admin WHERE nama_lengkap = '$uname'";
        $result = pg_query($conn, $query);
        $row = pg_fetch_assoc($result);
        ?>
        <div class="mx-auto flex justify-center items-center">
            <div>
            <h2 class="text-2xl font-semibold text-center mb-4">Edit Profil</h2>
            <div class="">
                <div class="w-full max-w-[550px] bg-white">

                    <form class="py-6 px-9"
                        action="includes\controller\profil\update_profil_controller.php?uname=<?php echo $uname ?>"
                        method="POST" enctype="multipart/form-data">
                        <div class="mb-5">
                            <label for="nama_lengkap" class="mb-3 block text-base font-medium text-[#07074D]">
                                Nama Lengkap:
                            </label>
                            <input value="<?php echo $row['nama_lengkap'] ?>" type="text" name="nama_lengkap"
                                id="nama_lengkap" value="<?php echo $row['nama_lengkap'] ?>" required
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div class="mb-5">
                            <label for="email" class="mb-3 block text-base font-medium text-[#07074D]">
                                Email:
                            </label>
                            <input value="<?php echo $row['email'] ?>" type="email" name="email" id="email"
                                required
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div class="mb-5">
                            <label for="number" class="mb-3 block text-base font-medium text-[#07074D]">
                                No Telepon:
                            </label>
                            <input value="<?php echo $row['no_telepon'] ?>" type="number" name="no_telepon" id="email"
                                required
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        <div class="mb-5">
                            <label for="alamat" class="mb-3 block text-base font-medium text-[#07074D]">
                                Alamat:
                            </label>
                            <input value="<?php echo $row['alamat'] ?>" type="text" name="alamat"
                                id="alamat" value="<?php echo $row['alamat'] ?>" required
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
                        </div>
                        
                        <div class="mb-6 pt-4">
                            <label class="mb-5 block text-xl font-semibold text-[#07074D]">
                                Upload Foto Profil
                            </label>

                            <div class="mb-8">
                                <input type="file" name="gambar" id="gambarInput" accept="image/*" class="sr-only" />
                                <label for="gambarInput"
                                    class="relative flex min-h-[200px] items-center justify-center rounded-md border border-dashed border-[#e0e0e0] p-12 text-center">
                                    <div>
                                        <span class="mb-2 block text-xl font-semibold text-[#07074D]">
                                            Drop files here
                                        </span>
                                        <span class="mb-2 block text-base font-medium text-[#6B7280]">
                                            Or
                                        </span>
                                        <span
                                            class="inline-flex rounded border border-[#e0e0e0] py-2 px-7 text-base font-medium text-[#07074D]">
                                            Browse
                                        </span>
                                    </div>
                                </label>
                                <img id="preview" src="<?php echo $row['gambar'] ?>" alt="Preview Gambar" class="block">
                            </div>

                        </div>

                        <div>
                            <button
                                class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                                Send File
                            </button>
                        </div>

                    </form>

                </div>
            </div>
            </div>

        </div>

    </div>

</body>

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
    var card = document.querySelector('.card');
    var closeButton = document.getElementById('closeBtn');

    // Menambahkan event listener untuk tombol
    closeButton.addEventListener('click', function () {
        card.classList.add('scale-0');
        setTimeout(function () {
            card.classList.add('hidden');
        }, 500); // Tunggu sampai anima// Menyembunyikan kartu
    });
</script>

</html>