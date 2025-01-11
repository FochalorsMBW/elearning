<?php
include ('koneksi.php');
include ('auth.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT id, judulKursus, namaKursus, tanggalMulai, tanggalBerakhir, urlReferensi, gambar FROM courses WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $kursus = $result->fetch_assoc();
    
    if ($kursus) {
        echo json_encode($kursus);
    } else {
        echo json_encode(['error' => 'Data tidak ditemukan']);
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'ID tidak diberikan']);
}
?>
