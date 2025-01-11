<?php 
include('../backend/koneksi.php');
include('../backend/auth.php');

checkRole('pengajar');
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kursus Pengajar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body class="bg-light">
<?php 
include('../template/navbar.php');
?>
<div class="container mt-5">
    <h1 class="mb-4">Daftar Kursus</h1>
    <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addKursusModal">Tambah Kursus</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Judul Kursus</th>
                <th>Nama Kursus</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Berakhir</th>
                <th>URL Referensi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['judulKursus']; ?></td>
                    <td><?php echo $row['namaKursus']; ?></td>
                    <td><?php echo $row['tanggalMulai']; ?></td>
                    <td><?php echo $row['tanggalBerakhir']; ?></td>
                    <td><a href="<?php echo $row['urlReferensi']; ?>" target="_blank">Link</a></td>
                    <td>
                    <button class="btn btn-warning btn-sm edit-button" data-id="<?php echo $row['id']; ?>" data-bs-toggle="modal" data-bs-target="#editKursusModal">Edit</button>
                        <a href="../backend/delete_kursus.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus kursus ini?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Modal untuk Nambah Kursus -->
<div class="modal fade" id="addKursusModal" tabindex="-1" aria-labelledby="addKursusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addKursusModalLabel">Tambah Kursus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backend/add_kursus.php" method="POST">
                    <div class="mb-3">
                        <label for="judulKursus" class="form-label">Judul Kursus</label>
                        <input type="text" class="form-control" id="judulKursus" name="judulKursus" required>
                    </div>
                    <div class="mb-3">
                        <label for="namaKursus" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" id="namaKursus" name="namaKursus" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalMulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="tanggalMulai" name="tanggalMulai" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggalBerakhir" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control" id="tanggalBerakhir" name="tanggalBerakhir" required>
                    </div>
                    <div class="mb-3">
                        <label for="urlReferensi" class="form-label">URL Referensi</label>
                        <input type="url" class="form-control" id="urlReferensi" name="urlReferensi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Gambar Kursus</label>
                        <div class="row row-cols-3 g-3">
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar1" value="gambar1.jpg" required>
                                <label class="form-check-label" for="gambar1">
                                    <img src="../uploads/cardcourses/gambar1.jpg" alt="Gambar 1" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar2" value="gambar2.jpg" required>
                                <label class="form-check-label" for="gambar2">
                                    <img src="../uploads/cardcourses/gambar2.jpg" alt="Gambar 2" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar3" value="gambar3.jpg" required>
                                <label class="form-check-label" for="gambar3">
                                    <img src="../uploads/cardcourses/gambar3.jpg" alt="Gambar 3" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar4" value="gambar4.jpg" required>
                                <label class="form-check-label" for="gambar4">
                                    <img src="../uploads/cardcourses/gambar4.jpg" alt="Gambar 4" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar5" value="gambar5.jpg" required>
                                <label class="form-check-label" for="gambar5">
                                    <img src="../uploads/cardcourses/gambar5.jpg" alt="Gambar 5" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar6" value="gambar6.jpg" required>
                                <label class="form-check-label" for="gambar6">
                                    <img src="../uploads/cardcourses/gambar6.jpg" alt="Gambar 6" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Kursus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Edit Kursus -->
<div class="modal fade" id="editKursusModal" tabindex="-1" aria-labelledby="editKursusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKursusModalLabel">Edit Kursus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backend/update_kursus.php" method="POST">
                    <input type="hidden" id="editId" name="id">
                    <div class="mb-3">
                        <label for="editJudulKursus" class="form-label">Judul Kursus</label>
                        <input type="text" class="form-control" id="editJudulKursus" name="judulKursus" required>
                    </div>
                    <div class="mb-3">
                        <label for="editNamaKursus" class="form-label">Nama Kursus</label>
                        <input type="text" class="form-control" id="editNamaKursus" name="namaKursus" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTanggalMulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" class="form-control" id="editTanggalMulai" name="tanggalMulai" required>
                    </div>
                    <div class="mb-3">
                        <label for="editTanggalBerakhir" class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control" id="editTanggalBerakhir" name="tanggalBerakhir" required>
                    </div>
                    <div class="mb-3">
                        <label for="editUrlReferensi" class="form-label">URL Referensi</label>
                        <input type="url" class="form-control" id="editUrlReferensi" name="urlReferensi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pilih Gambar Kursus</label>
                        <div class="row row-cols-3 g-3">
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar1" value="gambar1.jpg">
                                <label class="form-check-label" for="editGambar1">
                                    <img src="../uploads/cardcourses/gambar1.jpg" alt="Gambar 1" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar2" value="gambar2.jpg">
                                <label class="form-check-label" for="editGambar2">
                                    <img src="../uploads/cardcourses/gambar2.jpg" alt="Gambar 2" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar3" value="gambar3.jpg">
                                <label class="form-check-label" for="editGambar3">
                                    <img src="../uploads/cardcourses/gambar3.jpg" alt="Gambar 3" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar4" value="gambar4.jpg">
                                <label class="form-check-label" for="editGambar4">
                                    <img src="../uploads/cardcourses/gambar4.jpg" alt="Gambar 4" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar5" value="gambar5.jpg">
                                <label class="form-check-label" for="editGambar3">
                                    <img src="../uploads/cardcourses/gambar5.jpg" alt="Gambar 5" class="img-fluid" style="width: 100px; height: auto;">
                                </label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" name="gambar" id="editGambar6" value="gambar6.jpg">
                                <label class="form-check-label" for="editGambar3">
                                    <img src="../uploads/cardcourses/gambar6.jpg" alt="Gambar 6" class="img-fluid" style="width: 100px; height: auto;">
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
<!-- ======================= Dark Mode =============================== -->
<div class="dark-mode-toggle" id="toggleButton">
    <i class="bi bi-sun-fill" id="toggleIcon"></i>
  </div>
<!-- =============================================================== -->
<script>
document.querySelectorAll('.edit-button').forEach(button => {
    button.addEventListener('click', function() {
        const kursusId = this.getAttribute('data-id');
        fetch(`../backend/get_kursus.php?id=${kursusId}`)
            .then(response => response.json())
            .then(data => {
                if (!data.error) {
                    document.getElementById('editId').value = data.id;
                    document.getElementById('editJudulKursus').value = data.judulKursus;
                    document.getElementById('editNamaKursus').value = data.namaKursus;
                    document.getElementById('editTanggalMulai').value = data.tanggalMulai;
                    document.getElementById('editTanggalBerakhir').value = data.tanggalBerakhir;
                    document.getElementById('editUrlReferensi').value = data.urlReferensi;

                    // Tombol radio buat gambar
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

</script>
<script src="../js/darkmode.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
