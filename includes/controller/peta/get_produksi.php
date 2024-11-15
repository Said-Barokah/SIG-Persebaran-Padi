<?php
require_once('includes\koneksi.php'); 
if (isset($_GET['id_kecamatan'])) {
    $id_kecamatan = $_GET['id_kecamatan'];

    // Lakukan koneksi ke database dan jalankan query untuk mengambil data sesuai dengan ID kecamatan
    // Gantilah dengan koneksi ke database dan query yang sesuai
    $query = "SELECT kecamatan.nama_kecamatan as kec, kecamatan.luas_kecamatan as luas_kec, 
              kecamatan.geojson, produksi_padi.jenis_padi as jenis_padi, 
              produksi_padi.tahun as tahun_prod, produksi_padi.luas_tanam, produksi_padi.luas_panen, 
              produksi_padi.produktivitas, produksi_padi.produksi_padi as padi_prod  
              FROM kecamatan
              INNER JOIN produksi_padi ON kecamatan.id = produksi_padi.kode_kecamatan
              WHERE kecamatan.id = $id_kecamatan";
    
    $result = pg_query($conn, $query);
    $data_produksi = pg_fetch_assoc($result);

    // Mengembalikan data dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($data_produksi);
} else {
    echo "ID kecamatan tidak valid.";
}
?>
