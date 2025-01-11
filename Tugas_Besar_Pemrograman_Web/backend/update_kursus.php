<?php
include 'koneksi.php';
include 'auth.php';
checkRole('pengajar');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $judulKursus = $_POST['judulKursus'];
    $namaKursus = $_POST['namaKursus'];
    $tanggalMulai = $_POST['tanggalMulai'];
    $tanggalBerakhir = $_POST['tanggalBerakhir'];
    $urlReferensi = $_POST['urlReferensi'];
    $gambar = $_POST['gambar'];

    $query = "UPDATE courses SET judulKursus = ?, namaKursus = ?, tanggalMulai = ?, tanggalBerakhir = ?, urlReferensi = ?, gambar = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssssssi", $judulKursus, $namaKursus, $tanggalMulai, $tanggalBerakhir, $urlReferensi, $gambar, $id);

    if ($stmt->execute()) {
        header("Location: ../kursus/kursuss.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>