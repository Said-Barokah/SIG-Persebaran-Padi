<?php
require_once('includes\koneksi.php'); 
// Menghitung total jumlah data tanah
$query = "SELECT produksi_padi.jenis_padi, produksi_padi.tahun, SUM(produksi_padi.produksi_padi) as total_produksi
          FROM produksi_padi
          GROUP BY produksi_padi.jenis_padi, produksi_padi.tahun
          ORDER BY produksi_padi.tahun;";

$result = pg_query($conn, $query);


$data_produksi_tahun = array();

while ($row = pg_fetch_assoc($result)) {
    $data_produksi_tahun[] = array(
        'jenis_padi' => $row['jenis_padi'],
        'tahun' => $row['tahun'],
        'total_produksi' => $row['total_produksi']
    );
}

$data_produksi_tahun_json = json_encode($data_produksi_tahun);


$query = "SELECT DISTINCT ON (tahun, jenis_padi)
          tahun,
          jenis_padi,
          nama_kecamatan,
          MAX(produksi_padi) AS produksi_terbanyak
          FROM (
            SELECT p.tahun,
                   p.jenis_padi,
                   k.nama_kecamatan,
                   p.produksi_padi
            FROM produksi_padi AS p
            JOIN kecamatan AS k ON p.kode_kecamatan = k.id
          ) AS subquery
          GROUP BY tahun, jenis_padi, nama_kecamatan
          ORDER BY tahun DESC";

$result = pg_query($conn, $query);

$data_max = array();

while ($row = pg_fetch_assoc($result)) {
    $data_max[] = $row;
}

?>