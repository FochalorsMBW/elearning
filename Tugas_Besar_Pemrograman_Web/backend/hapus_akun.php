<?php
// Mulai sesi
session_start();

// Cek apakah pengguna sudah login dengan memeriksa sesi
if (!isset($_SESSION['NO_INDUK'])) {
    die("Anda harus login terlebih dahulu.");
}

// Ambil NO_INDUK dari sesi yang sudah login
$vNO_INDUK = $_SESSION['NO_INDUK'];

// Include file koneksi database
include('koneksi.php');

// Proses data saat formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi NO_INDUK
    if (empty($vNO_INDUK)) {
        die("NO_INDUK tidak ditemukan.");
    }

    // Cek apakah akun yang akan dihapus ada dalam database
    $stmt = $conn->prepare("SELECT NO_INDUK FROM tbl_pelajar WHERE NO_INDUK = ?");
    $stmt->bind_param("s", $vNO_INDUK);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        die("Akun tidak ditemukan.");
    }
    $stmt->close();

    // Query untuk menghapus akun berdasarkan NO_INDUK
    $stmt = $conn->prepare("DELETE FROM tbl_pelajar WHERE NO_INDUK = ?");
    $stmt->bind_param("s", $vNO_INDUK);

    if ($stmt->execute()) {
        // Hapus data sesi
        session_destroy(); // Hapus sesi pengguna
        echo "Akun berhasil dihapus!";
        // Redirect ke halaman login setelah penghapusan
        header("Location: loginpljr.php");
        exit(); // Pastikan skrip berhenti setelah redirect
    } else {
        echo "Terjadi kesalahan, silakan coba lagi.";
    }

    $stmt->close();
    $conn->close();
}
?>
