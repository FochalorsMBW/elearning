<?php
include('../backend/koneksi.php');
include('../backend/auth.php');
checkRole('pelajar');

$vNO_INDUK = $_SESSION['NO_INDUK'];

$vUSERNAME = ''; 
$vROLE = '';

$stmt = $conn->prepare("SELECT USERNAME, ROLE FROM tbl_pelajar WHERE NO_INDUK = ?");
$stmt->bind_param("s", $vNO_INDUK);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $vUSERNAME = $user['USERNAME']; // Menetapkan nilai username
    $vROLE = $user['ROLE']; // Menetapkan nilai role
} else {
    echo "Pengguna tidak ditemukan.";
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
    <title>D'Exter</title>
</head>
<body data-bs-theme="light" class="bg-light text-dark">
<?php 
include('../template/navbarpljr.php');
?>
<!-- ================================================================ -->
 
    <br><br>
    <h1 align="center"> Selamat Datang <?php echo htmlspecialchars($vUSERNAME); ?>, di E-Learning D'Exter</h1><br><br><br>
    <div class="container d-flex justify-content-center">
        <div class="card" style="width: 18rem; margin: 10px;">
            <img src="../assets/course.jpg" class="card-img-top" alt="bahanajarygy">
            <div class="card-body">
                <h5 class="card-title">Kursus</h5>
                <p class="card-text">Bergabung dengan kursus yang dibuat oleh pengajar.</p>
                <a href="../kursus/kursuspljr.php" class="btn btn-primary">Gabung</a>
            </div>
        </div>
        <div class="card" style="width: 18rem; margin: 10px;">
            <img src="../assets/bahanajar.jpg" class="card-img-top" alt="kursusygy">
            <div class="card-body">
                <h5 class="card-title">Bahan Ajar</h5>
                <p class="card-text">Pelajari dan kerjakan bahan ajar serta tugas yang diberikan oleh pengajar.</p>
                <a href="../bahanajar/bahanajarpljr.php" class="btn btn-primary">Kerjakan</a>
            </div>
        </div>
    </div>
<!-- ======================= Dark Mode =============================== -->
<div class="dark-mode-toggle" id="toggleButton">
    <i class="bi bi-sun-fill" id="toggleIcon"></i>
  </div>
<!-- =============================================================== -->
  <?php 
  include('../template/footer.php');
  ?>
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
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
