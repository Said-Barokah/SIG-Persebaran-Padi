<?php
session_start();
require_once('../koneksi.php'); // Sesuaikan path dengan struktur proyek Anda

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE nama_lengkap = $1";
    $result = pg_query_params($conn, $query, array($username));
    if ($result) {
        $row = pg_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['uname'] = $row['nama_lengkap'];
            header("Location: ../../dashboard.php?uname=" . urlencode($_SESSION['uname']));
            exit();
        } else {
            header("Location: ../../login.php?error=1"); // Login gagal
            exit();
        }
    } else {
        // Kesalahan saat mengeksekusi kueri
        header("Location: ../../login.php?error=2");
        exit();
    }
}
?>
