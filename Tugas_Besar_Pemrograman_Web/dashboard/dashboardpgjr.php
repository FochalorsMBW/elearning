<?php
include('../backend/koneksi.php');
include('../backend/auth.php');

checkRole('pengajar');

$vNO_INDUK = $_SESSION['NO_INDUK'];

$vUSERNAME = ''; 
$vROLE = '';

$stmt = $conn->prepare("SELECT USERNAME, ROLE FROM tbl_pelajar WHERE NO_INDUK = ?");
$stmt->bind_param("s", $vNO_INDUK);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $vUSERNAME = $user['USERNAME']; 
    $vROLE = $user['ROLE']; 
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
    <title>D'Exter</title>
</head>
<body data-bs-theme="light" class="bg-light text-dark">
<?php 
include('../template/navbar.php');
?>
<!-- ================================================================ -->
 
    <br><br>
    <h1 align="center"> Selamat Datang <?php echo htmlspecialchars($vUSERNAME); ?>, di E-Learning D'Exter</h1><br><br><br>
    <div class="container d-flex justify-content-center">
        <div class="card" style="width: 18rem; margin: 10px;">
            <img src="../assets/course.jpg" class="card-img-top" alt="bahanajarygy">
            <div class="card-body">
                <h5 class="card-title">Kursus</h5>
                <p class="card-text">Buat kursus untuk diikuti oleh para pelajar.</p>
                <a href="../kursus/kursuss.php" class="btn btn-primary">Buat</a>
            </div>
        </div>
        <div class="card" style="width: 18rem; margin: 10px;">
            <img src="../assets/bahanajar.jpg" class="card-img-top" alt="kursusygy">
            <div class="card-body">
                <h5 class="card-title">Bahan Ajar</h5>
                <p class="card-text">Berikan dan tambahkan bahan ajar serta tugas kepada para pelajar.</p>
                <a href="../bahanajar/bahanajar.php" class="btn btn-primary">Tambahkan</a>
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
<script src="../js/darkmode.js"></script>
<script src="../js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
