<?php
// Koneksi ke database
include('backend/koneksi.php')

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk menghitung total
$sql = "SELECT 
            COUNT(CASE WHEN role = 'pengajar' THEN 1 END) AS total_pengajar,
            COUNT(CASE WHEN role = 'pelajar' THEN 1 END) AS total_pelajar
        FROM tbl_pelajar";
$result = $conn->query($sql);

// Ambil hasil
$data = $result->fetch_assoc();
$total_pengajar = $data['total_pengajar'];
$total_pelajar = $data['total_pelajar'];

// Kirim data ke front-end (opsional)
header('Content-Type: application/json');
echo json_encode(['pengajar' => $total_pengajar, 'pelajar' => $total_pelajar]);

$conn->close();
?>