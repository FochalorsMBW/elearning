<?php
include('auth.php');
include('koneksi.php');

checkRole('pengajar');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil nama gambar yang akan dihapus
    $sql = "SELECT gambar FROM courses WHERE id = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $gambar = $row['gambar1'];

        // Hapus gambar dari folder
        $gambarPath = 'uploads/cardcourses/' . $gambar;
        if (file_exists($gambarPath)) {
            unlink($gambarPath); // Hapus file gambar
        }
    }

    // Hapus kursus dari database
    $sql = "DELETE FROM courses WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: ../kursus/kursuss.php');
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
