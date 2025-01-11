<?php
include ('koneksi.php');
include ('auth.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT id, title, description, deadline, file_path, gambar FROM cards WHERE id = ?";
    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $bahanajar = $result->fetch_assoc();

        if ($bahanajar) {
            echo json_encode($bahanajar);
        } else {
            echo json_encode(['error' => 'Data tidak ditemukan']);
        }

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Gagal mempersiapkan statement']);
    }

    $conn->close();
} else {
    echo json_encode(['error' => 'ID tidak diberikan atau bukan angka']);
}
?>
