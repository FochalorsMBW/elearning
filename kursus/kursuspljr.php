<?php
include('../backend/auth.php');
include('../backend/koneksi.php');
checkRole('pelajar');

$NO_INDUK = $_SESSION['NO_INDUK']; // Ambil NO_INDUK dari sesi login
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Kursus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        .card {
            opacity: 0;
            transition: opacity 1s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card.fade-in {
            opacity: 1;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .dark-mode-toggle {
            position: fixed;
            bottom: 20px;
            right: 20px;
            cursor: pointer;
        }
    </style>
</head>
<body data-bs-theme="light">
<?php 
include('../template/navbarpljr.php');
?>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Kursus</h1>
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <?php
                    $course_id = $row['id'];
                    $check_sql = "SELECT * FROM course_enrollments WHERE course_id = ? AND NO_INDUK = ?";
                    $stmt = $conn->prepare($check_sql);
                    $stmt->bind_param("is", $course_id, $NO_INDUK);
                    $stmt->execute();
                    $check_result = $stmt->get_result();
                    $is_joined = $check_result->num_rows > 0;
                    $stmt->close();
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="../uploads/cardcourses/<?php echo $row['gambar']; ?>" class="card-img-top" alt="Kursus Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['judulKursus']; ?></h5>
                            <p class="card-text"><?php echo $row['namaKursus']; ?></p>
                            <p class="card-text"><strong>Tanggal Mulai:</strong> <?php echo $row['tanggalMulai']; ?></p>
                            <p class="card-text"><strong>Tanggal Berakhir:</strong> <?php echo $row['tanggalBerakhir']; ?></p>
                            <a href="<?php echo $row['urlReferensi']; ?>" target="_blank" class="btn btn-link">Lihat Referensi</a>
                            <form action="../backend/join_kursus.php" method="POST" class="mt-3">
                                <input type="hidden" name="course_id" value="<?= $row['id'] ?>">
                                <button type="submit" class="btn btn-primary" <?= $is_joined ? 'disabled' : '' ?>>
                                    <?= $is_joined ? 'Joined' : 'Join' ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada kursus tersedia.</p>
        <?php endif; ?>
    </div>
</div>

<!-- ======================= Dark Mode =============================== -->
<div class="dark-mode-toggle" id="toggleButton">
    <i class="bi bi-sun-fill" id="toggleIcon"></i>
  </div>
<!-- =============================================================== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.classList.add('fade-in');
            }, index * 300); // delay of 300ms for each card
        });
    });
</script>
<script src="../js/darkmode.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
