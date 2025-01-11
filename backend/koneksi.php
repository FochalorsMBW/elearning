<?php
$host = "localhost";        
$username = "root";         
$password = "";             
$database = "db_elearning";    

// Membuat koneksi ke MySQL
$conn = new mysqli($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil
if ($conn->connect_error) {
    // Jika terjadi error dalam koneksi, tampilkan pesan error
    die("Koneksi gagal: " . $conn->connect_error);
}

// Koneksi berhasil
// echo "Koneksi berhasil";
?>
