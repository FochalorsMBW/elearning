<?php 
include('../backend/koneksi.php');
include('../backend/auth.php');
checkRole('pengajar');

$sql = "SELECT * FROM cards ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bahan Ajar Pengajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-light">
<?php 
include('../template/navbar.php');
?>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Bahan Ajar</h1>
    <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addBahanAjarModal">Tambah Bahan Ajar</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Judul Bahan Ajar</th>
                <th>Deskripsi</th>
                <th>Deadline</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['deadline']; ?></td>
                    <td>
                    <button class="btn btn-warning btn-sm edit-button" data-id="<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#editBahanAjarModal">Edit</button>
                        <a href="../backend/delete_bhnajar.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kursus ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal untuk Nambah BahanAjar -->
<div class="modal fade" id="addBahanAjarModal" tabindex="-1" aria-labelledby="addBahanAjarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBahanAjarModalLabel">Tambah BahanAjar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backend/add_bhnajar.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="judulBahanAjar" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalMulai" class="form-label">Deadline</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" required>
                    </div>
                    <div class="mb-3">
                        <label for="Filepath" class="form-label">Bahan Ajar</label>
                        <input type="file" class="form-control" id="Filepath" name="file_path">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Gambar BahanAjar</label>
                        <div class="row row-cols-3 g-3">
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar1" value="gambar1.jpg" required>
                                <label class="form-check-label" for="gambar1">
                                    <img src="../uploads/bahanajarcards/gambar1.jpg" alt="Gambar 1" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar2" value="gambar2.jpg" required>
                                <label class="form-check-label" for="gambar2">
                                    <img src="../uploads/bahanajarcards/gambar2.jpg" alt="Gambar 2" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar3" value="gambar3.jpg" required>
                                <label class="form-check-label" for="gambar3">
                                    <img src="../uploads/bahanajarcards/gambar3.jpg" alt="Gambar 3" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar4" value="gambar4.jpg" required>
                                <label class="form-check-label" for="gambar4">
                                    <img src="../uploads/bahanajarcards/gambar4.jpg" alt="Gambar 4" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar5" value="gambar5.jpg" required>
                                <label class="form-check-label" for="gambar5">
                                    <img src="../uploads/bahanajarcards/gambar5.jpg" alt="Gambar 5" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar6" value="gambar6.jpg" required>
                                <label class="form-check-label" for="gambar6">
                                    <img src="../uploads/bahanajarcards/gambar6.jpg" alt="Gambar 6" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah BahanAjar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Edit BahanAjar -->
<div class="modal fade" id="editBahanAjarModal" tabindex="-1" aria-labelledby="editBahanAjarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBahanAjarModalLabel">Edit Bahan Ajar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backend/update_bhnajar.php" method="POST">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="editTitle" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescription" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" id="editDescription" name="description" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDeadline" class="form-label">Deadline</label>
                        <input type="date" class="form-control" id="editDeadline" name="deadline" required>
                    </div>
                    <div class="mb-3">
                        <label for="editFilepath" class="form-label">Bahan Ajar</label>
                        <input type="file" class="form-control" id="editFilepath" name="file_path" disabled>
                        <a id="editFileLink" href="#" target="_blank" style="display: none;">Lihat file yang sudah diupload</a>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Gambar BahanAjar</label>
                        <div class="row row-cols-3 g-3">
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar1" value="gambar1.jpg">
                                <label class="form-check-label" for="editGambar1">
                                    <img src="../uploads/bahanajarcards/gambar1.jpg" alt="Gambar 1" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar2" value="gambar2.jpg">
                                <label class="form-check-label" for="editGambar2">
                                    <img src="../uploads/bahanajarcards/gambar2.jpg" alt="Gambar 2" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar3" value="gambar3.jpg">
                                <label class="form-check-label" for="editGambar3">
                                    <img src="../uploads/bahanajarcards/gambar3.jpg" alt="Gambar 3" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar4" value="gambar4.jpg">
                                <label class="form-check-label" for="editGambar4">
                                    <img src="../uploads/bahanajarcards/gambar4.jpg" alt="Gambar 4" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar5" value="gambar5.jpg">
                                <label class="form-check-label" for="editGambar3">
                                    <img src="../uploads/bahanajarcards/gambar5.jpg" alt="Gambar 5" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar6" value="gambar6.jpg">
                                <label class="form-check-label" for="editGambar3">
                                    <img src="../uploads/bahanajarcards/gambar6.jpg" alt="Gambar 6" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <!-- Tambahan kalau ada gambar lain-->
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <h2 class="mb-4">Pengumpulan Tugas</h2>
    <form id="cardFrom" method="POST">
    <div class="mb-3">
    <label for="bahan_ajar" class="form-label">Bahan Ajar</label>
    <select name="bahan_ajar_id" id="bahan_ajar" class="form-select" required>
        <option value="" disabled selected>Pilih Bahan Ajar</option>
        <?php foreach ($result as $card): ?>
            <option value="<?= htmlspecialchars($card['id']) ?>">
                <?= htmlspecialchars($card['title']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<a href="daftartugas.php?id=" id="lihat_button" class="btn btn-primary">Lihat</a>

<!-- ======================= Dark Mode =============================== -->
<div class="dark-mode-toggle" id="toggleButton">
    <i class="bi bi-sun-fill" id="toggleIcon"></i>
  </div>
<!-- =============================================================== -->
<script>
document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', function() {
        const bhnajarId = this.getAttribute('data-id');
        console.log('ID bahan ajar:', bhnajarId); // Log ID bahan ajar
        fetch(`../backend/get_bhnajar.php?id=${bhnajarId}`)
            .then(response => response.json())
            .then(data => {
                console.log('Data yang diterima:', data); // Log data yang diterima
                if (!data.error) {
                    document.getElementById('editId').value = data.id;
                    document.getElementById('editTitle').value = data.title;
                    document.getElementById('editDescription').value = data.description;
                    document.getElementById('editDeadline').value = data.deadline;

                    // Set file path link
                    if (data.file_path) {
                        const fileLink = document.getElementById('editFileLink');
                        fileLink.style.display = 'inline'; // Menampilkan link
                        fileLink.href = data.file_path; // Menetapkan URL file
                    }

                    // Tombol radio untuk gambar
                    document.querySelectorAll('input[name="gambar"]').forEach(radio => {
                        radio.checked = radio.value === data.gambar;
                    });
                } else {
                    alert(data.error);
                }
            })
            .catch(error => console.error('Error fetching course data:', error));
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
