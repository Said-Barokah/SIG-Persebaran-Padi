<?php
session_start();
require_once('../../koneksi.php'); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $uname = $_GET['uname'];
    $nama_lengkap = $_POST["nama_lengkap"];
    $email = $_POST["email"];
    $alamat = $_POST["alamat"];
    $no_telepon = $_POST["no_telepon"];


    // Membuat koneksi ke database (ganti dengan koneksi sesuai dengan pengaturan Anda)

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $filename = time() . '_' . rand(100, 999) . '_' . $_FILES['gambar']['name'];
        $file_path = "uploads/user_profile/" . $filename;
        $filename = time() . '_' . rand(100, 999) . '_' . $_FILES['gambar']['name'];
        $file_path = "uploads/user_profile/" . $filename;
    } else {
        $result = pg_query($conn, "SELECT gambar FROM profil WHERE username = $uname");
        if ($result) {
            $row = pg_fetch_assoc($result);
            $file_path = $row['gambar'];
        }
    }
    move_uploaded_file($_FILES['gambar']['tmp_name'], '../../../' . $file_path);
    $query = "UPDATE admin 
    SET nama_lengkap = $1, email = $2, alamat = $3, no_telepon=$4, gambar = $5
    WHERE nama_lengkap = $6"; 

    $result = pg_query_params($conn, $query, array(
        $nama_lengkap,
        $email,
        $alamat,
        $no_telepon,
        $file_path,
        $nama_lengkap
    ));

    if ($result) {
       $_SESSION["uname"] = $nama_lengkap;
        header("Location: ../../../edit_profile.php?uname=".$nama_lengkap."&success=Data%20berhasil%20diedit.");
    } else {
        die(pg_last_error($conn));
        header("Location: ../../../edit_profile.php?error=".$nama_lengkap."&Gagal%20menambahkan%A20data.");

    }
}
?>