<?php
include('auth.php');
include('koneksi.php');

checkRole('pengajar');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama gambar yang akan dihapus
    $sql = "SELECT gambar FROM cards WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gambar = $row['gambar'];

        // Hapus gambar dari folder
        $gambarPath = 'uploads/bahanajarcards/' . $gambar;
        if (file_exists($gambarPath)) {
            unlink($gambarPath); // Hapus file gambar
        }
    }

    $sql = "DELETE FROM cards WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: ../bahanajar/bahanajar.php');
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
