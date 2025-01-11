<?php
include 'koneksi.php';
include 'auth.php';
checkRole('pengajar');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $gambar = $_POST['gambar'];

    // Ambil file path yang ada dari database sebelum update
    $query = "SELECT file_path FROM cards WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $card = $result->fetch_assoc();

    // Jika ada file baru yang diupload, proses file tersebut
    if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] == UPLOAD_ERR_OK) {
        // Path relatif untuk direktori upload
        $upload_dir = 'uploads/bahan_ajar/'; 

        // Cek dan buat direktori jika belum ada
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Sanitasi nama file
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
            // File berhasil diunggah, gunakan path file baru
            $file_path = $upload_file;
        } else {
            echo "Error: File tidak bisa diunggah.";
            exit;
        }
    } else {
        // Jika tidak ada file baru, gunakan file path lama yang diambil dari database
        $file_path = $card['file_path'];
    }

    // Update data ke database
    $query = "UPDATE cards SET title = ?, description = ?, file_path = ?, deadline = ?, gambar = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $title, $description, $file_path, $deadline, $gambar, $id);

    if ($stmt->execute()) {
        header("Location: ../bahanajar/bahanajar.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
