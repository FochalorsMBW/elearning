<?php
include('auth.php');
include('koneksi.php');

checkRole('pengajar');
// Menangani form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judulKursus = $_POST['judulKursus'];
    $namaKursus = $_POST['namaKursus'];
    $tanggalMulai = $_POST['tanggalMulai'];
    $tanggalBerakhir = $_POST['tanggalBerakhir'];
    $urlReferensi = $_POST['urlReferensi'];
    $gambar = $_POST['gambar']; // Mendapatkan nama gambar yang dipilih dari radio button

    

    // Query untuk menyimpan data kursus ke database
    $sql = "INSERT INTO courses (judulKursus, namaKursus, tanggalMulai, tanggalBerakhir, urlReferensi, gambar) 
            VALUES ('$judulKursus', '$namaKursus', '$tanggalMulai', '$tanggalBerakhir', '$urlReferensi', '$gambar')";

    if ($conn->query($sql) === TRUE) {
        header('Location: ../kursus/kursuss.php'); // Redirect ke halaman kursus pengajar
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>