<?php
session_start();
require_once('../../koneksi.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $jenis_padi = $_POST["jenis_padi"];
    $tahun = $_POST["tahun"];
    $luas_tanam = $_POST["luas_tanam"];
    $luas_panen = $_POST["luas_panen"];
    $produktivitas = $_POST["produktivitas"];
    $produksi_padi = $_POST["produksi_padi"];
    $kode_kecamatan = $_POST["kode_kecamatan"];

    $query = "INSERT INTO produksi_padi (jenis_padi, tahun, luas_tanam, luas_panen, produktivitas, produksi_padi,kode_kecamatan) VALUES ($1, $2, $3, $4, $5, $6, $7)";
    $result = pg_query_params($conn, $query, array(
        $jenis_padi,
        $tahun,
        $luas_tanam,
        $luas_panen,
        $produktivitas,
        $produksi_padi,
        $kode_kecamatan,
    ));

    

    if ($result) {
        header("Location: ../../../lihat_data_produksi.php?success=Data%20berhasil%20disimpan.");
    } else {
        die(pg_last_error($conn));
        header("Location: ../../../tambah_data_produksi.php?error=Gagal%20menambahkan%A20data.");
    }
}
