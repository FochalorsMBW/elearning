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
    $vUSERNAME = $user['USERNAME']; // USERNAME
    $vROLE = $user['ROLE']; // ROLE
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
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>D'Exter</title>
</head>
<body>
<?php 
include('../template/navbar.php');
?>
<!-- ================================================================ -->

<div class="container mt-5">
    <div class="card p-4 shadow">
        <h1 class="text-center mb-4">Update Profil</h1>
        <form action="../backend/updateprofil.php" method="POST" onsubmit="return validateForm()">
            <div class="row g-3">
                <!-- Username -->
                <div class="col-md-6">
                    <label for="USERNAME" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="USERNAME" name="USERNAME" value="<?php echo htmlspecialchars($vUSERNAME); ?>" required>
                </div>
            </div>
            <div class="row g-3">
                <!-- Password -->
                <div class="col-md-6">
                    <label for="PASSWORD" class="form-label">New Password:</label>
                    <input type="password" class="form-control" id="PASSWORD" name="PASSWORD" value="" required>
                </div>
            </div>
            <div class="row g-3">
                <!-- Confirm Password -->
                <div class="col-md-6">
                    <label for="CONFIRM_PASSWORD" class="form-label">Confirm New Password:</label>
                    <input type="password" class="form-control" id="CONFIRM_PASSWORD" name="CONFIRM_PASSWORD" required>
                    <span id="error-message" class="form-text text-danger" style="display: none;">Password dan konfirmasi password tidak cocok!</span>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <button class="btn btn-primary" type="submit">Update</button>
                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Hapus Akun</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Akun</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah anda yakin ingin menghapus akun? ini akan menghapus segala data yang telah anda buat termasuk tugas dan record anda selama melakukan pembelajaran di E-Learning ini.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="backend/hapus_akun.php" method="POST">
        <button type="submit" id="disabled" class="btn btn-danger">Hapus</button></form>
      </div>
    </div>
  </div>
</div>
<!-- ======================= Dark Mode =============================== -->
<div class="dark-mode-toggle" id="toggleButton">
    <i class="bi bi-sun-fill" id="toggleIcon"></i>
  </div>
<!-- =============================================================== -->
<script src="../js/darkmode.js"></script>
<script src="../js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
