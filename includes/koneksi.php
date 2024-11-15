<?php
// Menyimpan data koneksi ke variabel
$host = "localhost";
$port = "5432";
$dbname = "sig_padi";
$user = "postgres";
$password = "said12202474";

// Membuat string koneksi
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";

// Membuat koneksi dengan PostgreSQL
$conn = pg_connect($conn_string);
if (!$conn) {
  die("Koneksi gagal: " . pg_last_error());
}
?>