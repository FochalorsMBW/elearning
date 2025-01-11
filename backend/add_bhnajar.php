<?php
include('auth.php');
include('koneksi.php');
checkRole('pengajar');

// Menangani form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $gambar = $_POST['gambar']; // Mendapatkan nama gambar yang dipilih dari radio button

    if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] == UPLOAD_ERR_OK) {
        // Path absolut untuk direktori upload
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/Tugas_Besar_Pemrograman_Web/uploads/bahan_ajar/'; 

        // Cek dan buat direktori jika belum ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true); // Membuat direktori jika belum ada
        }

        // Sanitize nama file
        $filename = basename($_FILES['file_path']['name']);
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename); // Sanitasi nama file
        $upload_file = $upload_dir . $filename;

        // Validasi jenis file
        $allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
        if (!in_array($_FILES['file_path']['type'], $allowed_types)) {
            echo "Error: Jenis file tidak diizinkan.";
            exit;
        }

        // Pindahkan file ke direktori upload
        if (move_uploaded_file($_FILES['file_path']['tmp_name'], $upload_file)) {
            // File berhasil diunggah, simpan path file
            $filepath = '../uploads/bahan_ajar/' . $filename;  // Simpan path relatif untuk database
        } else {
            echo "Error: File tidak bisa diunggah.";
            exit;
        }
    } else {
        echo "Error: Tidak ada file yang diunggah atau ada kesalahan dalam unggahan.";
        exit;
    }

    // Gunakan prepared statement untuk menyimpan data ke database
    $stmt = $conn->prepare("INSERT INTO cards (title, description, deadline, file_path, gambar) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $title, $description, $deadline, $filepath, $gambar);

    if ($stmt->execute()) {
        header('Location: ../bahanajar/bahanajar.php'); // Redirect ke halaman kursus pengajar
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
