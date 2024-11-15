<?php
require_once('includes\koneksi.php');

// Ambil nilai pencarian dari input GET
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query utama dengan kondisi pencarian
$query = "SELECT kecamatan.id, kecamatan.nama_kecamatan as kec, kecamatan.luas_kecamatan as luas_kec, 
kecamatan.geojson, produksi_padi.jenis_padi as jenis_padi, 
produksi_padi.tahun as tahun_prod, produksi_padi.luas_tanam, produksi_padi.luas_panen, 
produksi_padi.produktivitas, produksi_padi.produksi_padi
FROM kecamatan
INNER JOIN produksi_padi ON kecamatan.id = produksi_padi.kode_kecamatan";

// Tambahkan kondisi pencarian jika ada
if (!empty($search)) {
    $query .= " WHERE kecamatan.nama_kecamatan ILIKE '%$search%'";
}


$result = pg_query($conn, $query);

$data_produksi = array();

while ($row = pg_fetch_assoc($result)) {
    $data_produksi[] = array(
        'id' => $row['id'],
        'nama_kecamatan'  => $row['kec'],
        'luas_kec' => $row['luas_kec'],
        'geojson' => $row['geojson'],
        'jenis_padi' => $row['jenis_padi'],
        'tahun_prod' => $row['tahun_prod'],
        'luas_tanam' => $row['luas_tanam'],
        'luas_panen' => $row['luas_panen'],
        'produktivitas' => $row['produktivitas'],
        'padi_prod' => $row['produksi_padi'],
    );
}

$data_produksi_json = json_encode($data_produksi);

// Query untuk mengambil data kecamatan (opsional jika Anda perlu data kecamatan)
// Ambil nilai tahun dari GET atau gunakan tahun saat ini jika kosong
$tahun = isset($_GET['tahun']) && is_numeric($_GET['tahun']) ? (int)$_GET['tahun'] : (int)date('Y');
// Ambil tahun dari GET atau tahun sekarang sebagai default
$jenis_padi = isset($_GET['jenis_padi']) ? $_GET['jenis_padi'] : 'Padi Sawah';
$search = isset($_GET['search']) ? $_GET['search'] : ''; // Get search parameter

// Query tanpa produksi_padi.produksi_padi dan tanpa $produksi
$query = "SELECT kecamatan.*, produksi_padi.tahun, produksi_padi.jenis_padi, produksi_padi.luas_tanam, produksi_padi.luas_panen, produksi_padi.produksi_padi
          FROM kecamatan
          LEFT JOIN produksi_padi 
              ON kecamatan.id = produksi_padi.kode_kecamatan
              AND produksi_padi.tahun = '$tahun'
              AND produksi_padi.jenis_padi = '$jenis_padi'";

// Tambahkan filter pencarian kecamatan berdasarkan nama (jika ada)
if (!empty($search)) {
    $query .= " WHERE kecamatan.nama_kecamatan ILIKE '%$search%'";
}

// Eksekusi query
$result = pg_query($conn, $query);

// Siapkan data kecamatan berdasarkan hasil query
$data_kecamatan = array();
while ($row = pg_fetch_assoc($result)) {
    $data_kecamatan[] = array(
        'geojson' => $row['geojson'],
        'nama_kecamatan' => $row['nama_kecamatan'],
        'id' => $row['id'],
        'luas_kecamatan' => $row['luas_kecamatan'],
        'tahun' => $row['tahun'],
        'jenis_padi' => $row['jenis_padi'],
        'luas_tanam' => $row['luas_tanam'],
        'luas_panen' => $row['luas_panen'],
        'produksi_padi' => $row['produksi_padi']
    );
}

// Output the data as JSON
$data_kecamatan_json = json_encode($data_kecamatan);


