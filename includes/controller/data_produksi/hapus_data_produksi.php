<?php 
require_once('../../koneksi.php'); 
$id_data_produksi = $_GET['id'];
$query_delete = "DELETE FROM produksi_padi WHERE id = $id_data_produksi";
$result_delete = pg_query($conn, $query_delete);
if ($result_delete) {
    header("Location: ../../../lihat_data_produksi.php?success=Data%20berhasil%20dihapus.");
} else {
    die(pg_last_error($conn));
    header("Location: ../../../lihat_data_produksi.php?error=Data%20gagal%20dihapus.");
}
?>