<?php
// Include file koneksi database
include('koneksi.php');
session_start(); // Mulai session

// Pastikan pengguna sudah login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: loginpljr.php"); // Jika belum login, redirect ke halaman login
    exit();
}

// Ambil NO_INDUK dari session yang sudah login
$vNO_INDUK = $_SESSION['NO_INDUK'];

// Variabel default
$vUSERNAME = '';
$vROLE = '';

// Proses data saat formulir disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil input baru dari pengguna
    $vUSERNAME = $_POST['USERNAME'];
    $vPASSWORD = $_POST['PASSWORD'];
    $vCONFIRM_PASSWORD = $_POST['CONFIRM_PASSWORD'];

    // Validasi input
    if (empty($vUSERNAME) || empty($vPASSWORD) || empty($vCONFIRM_PASSWORD)) {
        die("Semua field harus diisi!");
    }

    // Pastikan password dan konfirmasi password sama
    if ($vPASSWORD !== $vCONFIRM_PASSWORD) {
        die("Password dan konfirmasi password tidak cocok!");
    }

    // Hash password baru sebelum disimpan
    $hashed_password = password_hash($vPASSWORD, PASSWORD_DEFAULT);

    // Gunakan prepared statement untuk mengupdate data
    $stmt = $conn->prepare("UPDATE tbl_pelajar SET USERNAME = ?, PASSWORD = ? WHERE NO_INDUK = ?");
    $stmt->bind_param("sss", $vUSERNAME, $hashed_password, $vNO_INDUK);

    if ($stmt->execute()) {
        // Jika profil berhasil diperbarui, beri pesan dan arahkan ke halaman login
        echo "Profil berhasil diperbarui!";
        
        // Mengarahkan ke halaman login setelah beberapa detik
        header("refresh:2; url=loginpljr.php"); // 2 detik penundaan sebelum mengalihkan
        
        exit();
    } else {
        echo "Terjadi kesalahan, silakan coba lagi.";
    }

    $stmt->close();
    $conn->close();
} else {
    // Menampilkan data pengguna yang sudah ada di database
    $stmt = $conn->prepare("SELECT USERNAME, PASSWORD, ROLE FROM tbl_pelajar WHERE NO_INDUK = ?");
    $stmt->bind_param("s", $vNO_INDUK);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $vUSERNAME = $user['USERNAME'];
        $vROLE = $user['ROLE'];
    } else {
        echo "Pengguna tidak ditemukan.";
    }

    $stmt->close();
}

?>
