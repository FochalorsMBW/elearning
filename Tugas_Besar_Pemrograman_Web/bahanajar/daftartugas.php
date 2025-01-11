<?php
include('../backend/koneksi.php');
include('../backend/auth.php');

// Validasi ID bahan ajar
$bahan_ajar_id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$bahan_ajar_id) {
    header("Location: error.php?message=Bahan ajar tidak ditemukan");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM cards WHERE id = ?");
$stmt->bind_param("i", $bahan_ajar_id);
$stmt->execute();
$result = $stmt->get_result();
$bahan_ajar = $result->fetch_assoc();

if (!$bahan_ajar) {
    header("Location: error.php?message=Bahan ajar tidak ditemukan");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM tugas WHERE bahan_ajar_id = ?");
$stmt->bind_param("i", $bahan_ajar_id);
$stmt->execute();
$tugas_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tugas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <style>
        .container {
            max-width: 800px;
        }

        .btn-secondary {
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            background-color: white;
        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }

        .dark-mode-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<?php include('../template/navbar.php'); ?>

<div class="container my-5">
    <a href="bahanajar.php" class="btn btn-secondary mb-3">Kembali</a>
    <h2 class="mb-4">Daftar Tugas untuk: <?= htmlspecialchars($bahan_ajar['title'] ?? "Bahan ajar tidak ditemukan") ?></h2>
    <table class="table table-striped table-hover">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>Nama Pelajar</th>
                <th>Nomor Induk</th>
                <th>File Tugas</th>
                <th>Waktu Pengumpulan</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($tugas_result->num_rows > 0): ?>
                <?php $no = 1; ?>
                <?php while ($row = $tugas_result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($row['student_name']) ?></td>
                        <td><?= htmlspecialchars($row['no_induk']) ?></td>
                        <td>
                            <?php 
                                $file_path = '../uploads/tugas/' . basename($row['task_file']);
                                if (file_exists($file_path)): 
                            ?>
                                <a href="<?= htmlspecialchars($file_path) ?>" target="_blank" class="btn btn-link">Unduh</a>
                            <?php else: ?>
                                <span class="text-danger">File tidak ditemukan</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars(date("d M Y, H:i", strtotime($row['submitted_at']))) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada tugas yang dikirim.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Dark Mode Toggle -->
<div class="dark-mode-toggle" id="toggleButton">
    <i class="bi bi-sun-fill" id="toggleIcon"></i>
</div>

<script src="../js/darkmode.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
