<?php
session_start();
require_once('../../koneksi.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $id_produksi = $_GET['id'];
    $jenis_padi = $_POST["jenis_padi"];
    $tahun = $_POST["tahun"];
    $luas_tanam = $_POST["luas_tanam"];
    $luas_panen = $_POST["luas_panen"];
    $produktivitas = $_POST["produktivitas"];
    $produksi_padi = $_POST["produksi_padi"];
    $kode_kecamatan = $_POST["kode_kecamatan"];
    $query = "UPDATE produksi_padi 
    SET jenis_padi = $1, tahun = $2, luas_tanam = $3, luas_panen = $4, produktivitas = $5, produksi_padi = $6, kode_kecamatan = $7
    WHERE id = $8";
    $result = pg_query_params($conn, $query, array(
        $jenis_padi,
        $tahun,
        $luas_tanam,
        $luas_panen,
        $produktivitas,
        $produksi_padi,
        $kode_kecamatan,
        $id_produksi
    )
    );


    if ($result) {
        header("Location: ../../../lihat_data_produksi.php?success=Data%20berhasil%20disimpan.");
    } else {
        header("Location: ../../../edit_data_produksi.php?id=" . $id_produksi . "&error=Gagal%20menambahkan%A20data.");
    }






    // Membuat koneksi ke database (ganti dengan koneksi sesuai dengan pengaturan Anda)

    // Query untuk menambahkan data ke dalam tabel data_tanah

}
?>