<?php
$nama_kecamatan_cari = $_POST['nama_kecamatan'];
$query = "SELECT * FROM kecamatan WHERE kecamatan.nama_kecamatan ILIKE '%" . pg_escape_string($nama_kecamatan_cari) . "%'";

// Eksekusi query
$result = pg_query($conn, $query);

$data_kecamatan = array();

while($row = pg_fetch_assoc($result)){
    $data_kecamatan[] = array(
        'geojson' => $row['geojson'],
        'nama_kecamatan' => $row['nama_kecamatan'],
        'id' => $row['id'],
        'luas_kecamatan' => $row['luas_kecamatan'] 
    );
}

$data_kecamatan_json = json_encode($data_kecamatan);
?>