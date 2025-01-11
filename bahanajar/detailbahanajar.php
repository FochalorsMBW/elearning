<?php
include('../backend/koneksi.php');
include('../backend/auth.php');

checkRole('pelajar');
// Ambil ID dari parameter URL
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Bahan ajar tidak ditemukan.");
}

$stmt = $conn->prepare("SELECT * FROM cards WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$card = $result->fetch_assoc();

if (!$card) {
    die("Bahan ajar tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Bahan Ajar</title>
    <link href="../css/styles.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<?php include('../template/navbarpljr.php'); ?>
<div class="container my-5">
    <h2 class="mb-4"><?= $card['title'] ?></h2>
    <a href="bahanajarpljr.php" class="btn btn-secondary" aria-label="Close">Kembali</a><br><br>
    <div class="card w-50 h-50">
        <img src="../uploads/bahanajarcards/<?= $card['gambar'] ?>" class="card-img-top img-fluid" alt="<?= $card['title'] ?>">
        <div class="card-body">
            <h5 class="card-title">Deskripsi</h5>
            <p class="card-text"><?= $card['description'] ?></p>
            <h5 class="card-title">Tanggal Dirilis</h5>
            <p class="card-text"><?= htmlspecialchars(date("d M Y, H:i", strtotime($card['created_at']))) ?></p>
            <h5 class="card-title">Deadline</h5>
            <p class="card-text deadline text-success" data-deadline="<?= htmlspecialchars(date("d M Y, 23:59", strtotime($card['deadline']))) ?>"><strong>Deadline:</strong> <?= htmlspecialchars(date("d M Y, 23:59", strtotime($card['deadline']))) ?></p>
            <h5 class="card-title">Bahan Ajar</h5>
            <a href="<?= htmlspecialchars($card['file_path']); ?>" class="btn btn-primary" download>Unduh Bahan Ajar</a><br><br>
            <a href="kirimtugas.php?id=<?= $card['id'] ?>" class="btn btn-success">Kirim Tugas</a>
        </div>
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

        const deadlineElements = document.querySelectorAll('.card-text.deadline');
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

    const selectElement = document.getElementById('bahan_ajar');
    const lihatButton = document.getElementById('lihat_button');

    // Event listener untuk perubahan pada select
    selectElement.addEventListener('change', function() {
        const selectedValue = selectElement.value;

        // Jika ada nilai yang dipilih, update URL tombol Lihat
        if (selectedValue) {
            lihatButton.href = 'daftartugas.php?id=' + selectedValue;
        } else {
            // Jika tidak ada yang dipilih, link direset atau ditutup
            lihatButton.href = '#';
            window.location.href = 'bahanajar.php'
        }
});
</script>
<script src="../js/darkmode.js"></script>
<script src="../js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>

<?php $conn->close(); ?>
