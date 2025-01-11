<?php
include('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $vNO_INDUK = $_POST['NO_INDUK'];
    $vUSERNAME = $_POST['USERNAME'];
    $vPASSWORD = $_POST['PASSWORD'];
    $vROLE = $_POST['ROLE'];

    if (empty($vNO_INDUK) || empty($vPASSWORD) || empty($vROLE)) {
        die("Semua field harus diisi!");
    }

    if (!in_array($vROLE, ['pelajar', 'pengajar'])) {
        die("Role tidak valid.");
    }
    
    // Cek duplikasi NO_INDUK
    $stmt = $conn->prepare("SELECT NO_INDUK FROM tbl_pelajar WHERE NO_INDUK = ?");
    $stmt->bind_param("s", $vNO_INDUK);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo ('No Induk sudah terdaftar');
        header("refresh:2; url=loginpljr.php"); 
        die; 
        
    }
    $stmt->close();
    

    $hashed_password = password_hash($vPASSWORD, PASSWORD_DEFAULT);

    // Gunakan prepared statement untuk menyimpan data
    $stmt = $conn->prepare("INSERT INTO tbl_pelajar (NO_INDUK, USERNAME, PASSWORD, ROLE) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $vNO_INDUK, $vUSERNAME, $hashed_password, $vROLE);

    if ($stmt->execute()) {
        // Tutup statement dan koneksi
        $stmt->close();
        $conn->close();
        echo "Pendaftaran Berhasil!";
        // Redirect ke halaman login
        header("refresh:2; url=loginpljr.php");
        exit();
    } else {
        echo "Terjadi kesalahan, silakan coba lagi.";
        $stmt->close();
        $conn->close();
    }
}
?>
