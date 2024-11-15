<?php
require_once('includes\koneksi.php');
$query = "SELECT COUNT(*) AS jumlah_kecamatan FROM kecamatan";

$result = pg_query($conn, $query);

$row = pg_fetch_assoc($result);
$jumlah_kecamatan = $row['jumlah_kecamatan'];

$query = "SELECT tahun, SUM(produksi_padi) AS total_produksi_padi 
          FROM produksi_padi 
          WHERE tahun = (SELECT MAX(tahun) FROM produksi_padi)
          GROUP BY tahun";
$result = pg_query($conn, $query);


$row = pg_fetch_assoc($result);
$tahun_terbaru = $row['tahun'];
$total_produksi_padi = $row['total_produksi_padi'];


$query = "SELECT COUNT(DISTINCT jenis_padi) AS jumlah_jenis_padi FROM produksi_padi";
$result = pg_query($conn, $query);

$row = pg_fetch_assoc($result);
$jumlah_jenis_padi = $row['jumlah_jenis_padi'];

   
?>