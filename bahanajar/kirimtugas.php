<?php
// Koneksi ke database
include('../backend/koneksi.php');
include('../backend/auth.php');

// Ambil ID bahan ajar dari parameter URL
$bahan_ajar_id = $_GET['id'] ?? null;

if (!$bahan_ajar_id) {
    die("Bahan ajar tidak ditemukan.");
}

// Ambil detail bahan ajar untuk validasi
$stmt = $conn->prepare("SELECT * FROM cards WHERE id = ?");
$stmt->bind_param("i", $bahan_ajar_id);
$stmt->execute();
$result = $stmt->get_result();
$bahan_ajar = $result->fetch_assoc();

if (!$bahan_ajar) {
    die("Bahan ajar tidak ditemukan.");
}

// Proses pengiriman tugas
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_name = $_POST['student_name'] ?? '';
    $no_induk = $_POST['no_induk'] ?? '';
    $task_file = $_FILES['task_file'] ?? null;

    if (empty($student_name) || !$task_file || $task_file['error'] != 0) {
        $message = "Nama siswa dan file tugas wajib diisi.";
    } else {
        // Upload file
        $upload_dir = '../uploads/tugas/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_name = time() . '_' . basename($task_file['name']);
        $upload_path = $upload_dir . $file_name;

        if (move_uploaded_file($task_file['tmp_name'], $upload_path)) {
            // Simpan data tugas ke database
            $stmt = $conn->prepare("INSERT INTO tugas (bahan_ajar_id,student_name,no_induk,task_file) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $bahan_ajar_id, $student_name, $no_induk, $file_name);

            if ($stmt->execute()) {
                $message = "Tugas berhasil dikirim.";
            } else {
                $message = "Gagal menyimpan tugas ke database.";
            }
        } else {
            $message = "Gagal mengunggah file.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kirim Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
    <a href="bahanajarpljr.php" class="btn btn-secondary mb-3">Kembali</a>
        <h2 class="mb-4">Kirim Tugas untuk: <?= $bahan_ajar['title'] ?></h2>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="student_name" class="form-label">Nama Siswa</label>
                <input type="text" name="student_name" id="student_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="no_induk" class="form-label">No Induk</label>
                <input type="text" name="no_induk" id="no_induk" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="task_file" class="form-label">Unggah Tugas</label>
                <input type="file" name="task_file" id="task_file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png" required>
            </div>
            <button type="submit" class="btn btn-success">Kirim Tugas</button>
        </form>
    </div>
<!-- ======================= Dark Mode =============================== -->
<div class="dark-mode-toggle" id="toggleButton">
    <i class="bi bi-sun-fill" id="toggleIcon"></i>
  </div>
<!-- =============================================================== -->
    <!-- Bootstrap JS -->
    <script src="../js/darkmode.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="../js/script.js">
</body>
</html>
