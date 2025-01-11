<?php
include('koneksi.php');
session_start(); // Pastikan sesi dimulai

function checkRole($requiredRole) {
    // Pastikan pengguna sudah login
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: loginpljr.php"); // Redirect ke halaman login
        exit();
    }

    // Cek apakah role pengguna sesuai
    if (!isset($_SESSION['ROLE']) || $_SESSION['ROLE'] !== $requiredRole) {
        header("Location: ../unauthorized.php"); // Halaman Cek Role
        exit();
    }
}
