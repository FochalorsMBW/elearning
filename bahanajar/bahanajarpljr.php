<?php
include('../backend/auth.php');
include('../backend/koneksi.php');
checkRole('pelajar');

$sql = "SELECT * FROM cards ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Bahan Ajar</title>
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

        .blink {
            animation: blink-animation 1s steps(5, start) infinite;
            -webkit-animation: blink-animation 1s steps(5, start) infinite;
        }

        @keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }

        @-webkit-keyframes blink-animation {
            to {
                visibility: hidden;
            }
        }
    </style>
</head>
<body data-bs-theme="light">
<?php include('../template/navbarpljr.php'); ?>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Bahan Ajar</h1>
    <div class="row">
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="../uploads/bahanajarcards/<?php echo $row['gambar']; ?>" class="card-img-top" alt="Bahan Ajar Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['title']; ?></h5>
                            <p class="card-text deadline text-success" data-deadline="<?= htmlspecialchars(date("d M Y, 23:59", strtotime($row['deadline']))) ?>"><strong>Deadline:</strong> <?= htmlspecialchars(date("d M Y, 23:59", strtotime($row['deadline']))) ?></p>
                            <a href="detailbahanajar.php?id=<?= $row['id'] ?>" class="btn btn-primary w-50">Lihat</a>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">Terakhir diupload: <?= htmlspecialchars(date("d M Y, H:i", strtotime($row['created_at']))) ?></small>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada Bahan Ajar tersedia.</p>
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
            }, index * 300); // 1 kartu 300ms delay
        });

        const deadlineElements = document.querySelectorAll('.deadline');
        const now = new Date();
        deadlineElements.forEach(el => {
            const deadline = new Date(el.getAttribute('data-deadline'));
            const timeDifference = deadline - now;
            const hoursDifference = timeDifference / (1000 * 60 * 60);
            if (hoursDifference <= 24 && hoursDifference > 0) {
                el.classList.remove('text-success');
                el.classList.add('text-danger');
            } else if (hoursDifference <= 0) {
                el.classList.remove('text-success');
                el.classList.add('text-danger', 'blink');
            }
        });
    });
</script>
<script src="../js/darkmode.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>

