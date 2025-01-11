<?php
include('koneksi.php');
include('auth.php');

$course_id = $_POST['course_id'];
$NO_INDUK = $_SESSION['NO_INDUK'];

$check_sql = "SELECT * FROM course_enrollments WHERE course_id = ? AND NO_INDUK = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param("is", $course_id, $NO_INDUK);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Anda sudah bergabung dengan kursus ini.";
    header('Location: ../kursus/kursuspljr.php');
} else {
    // Tambahkan pelajar ke kursus
    $insert_sql = "INSERT INTO course_enrollments (course_id, NO_INDUK) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("is", $course_id, $NO_INDUK);
    if ($stmt->execute()) {
        header('Location: ../kursus/kursuspljr.php');
    } else {
        echo "Gagal bergabung dengan kursus.";
    }
}

$stmt->close();
$conn->close();
?>