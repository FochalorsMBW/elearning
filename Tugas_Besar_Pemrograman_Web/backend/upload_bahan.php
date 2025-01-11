<?php
include ('koneksi.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deskripsi = $_POST['deskripsi']; // Menangkap deskripsi
    $target_dir = "uploads/"; // Folder tujuan untuk menyimpan file
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // Nama file
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Cek apakah file adalah file yang valid
    if (isset($_POST["submit"])) {
        // Cek jika file benar-benar merupakan file
        if ($_FILES["fileToUpload"]["size"] > 5000000) { // Batas ukuran file (5MB)
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Cek ekstensi file
        if ($fileType != "pdf" && $fileType != "docx" && $fileType != "pptx") {
            echo "Sorry, only PDF, DOCX, and PPTX files are allowed.";
            $uploadOk = 0;
        }

        // Jika tidak ada error, lakukan upload
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                // Menyimpan data ke dalam database
                $fileName = basename($_FILES["fileToUpload"]["name"]);
                $sql = "INSERT INTO bahan_ajar (NAMA_FILE, DESKRIPSI) VALUES ('$fileName', '$deskripsi')";

                if ($conn->query($sql) === TRUE) {
                    echo "The file ". htmlspecialchars($fileName). " has been uploaded and data has been saved.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>