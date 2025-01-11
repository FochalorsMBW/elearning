<?php
include('koneksi.php')
session_start(); // Mulai sesi

// Jika pengguna memilih untuk tetap login (remember me)
if (isset($_POST['remember_me'])) {
    // Set cookie yang berisi username dan ID sesi selama 30 hari (secara default browser akan menghapus cookie saat ditutup)
    setcookie('USERNAME', $_POST['USERNAME'], time() + (30 * 24 * 60 * 60), '/'); // 30 hari
    setcookie('loggedin', true, time() + (30 * 24 * 60 * 60), '/'); // 30 hari
}

// Verifikasi apakah cookie sudah ada
if (isset($_COOKIE['USERNAME']) && isset($_COOKIE['loggedin'])) {
    // Jika cookie ada, anggap pengguna sudah login
    $_SESSION['USERNAME'] = $_COOKIE['USERNAME'];
    $_SESSION['loggedin'] = $_COOKIE['loggedin'];
}

ini_set('session.gc_maxlifetime', 30 * 24 * 60 * 60); // 30 hari
session_start();
header("Location : ../dashboardpljr.php")
?>

