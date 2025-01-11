<?php
include('koneksi.php');
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $NO_INDUK = htmlspecialchars(trim($_POST['NO_INDUK']));
    $USERNAME = htmlspecialchars(trim($_POST['USERNAME']));
    $PASSWORD = htmlspecialchars(trim($_POST['PASSWORD']));

    $stmt = $conn->prepare("SELECT * FROM tbl_pelajar WHERE NO_INDUK = ?");
    $stmt->bind_param("s", $NO_INDUK);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if (password_verify($PASSWORD, $user['PASSWORD'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['NO_INDUK'] = $user['NO_INDUK'];
            $_SESSION['ROLE'] = $user['ROLE'];

            if ($user['ROLE'] == 'admin') {
                header("Location: admin_dashboard.php");
            } elseif ($user['ROLE'] == 'pengajar') {
                header("Location: ../dashboard/dashboardpgjr.php");
            } elseif ($user['ROLE'] == 'pelajar') {
                header("Location: ../dashboard/dashboardpljr.php");
            } else {
                header("Location: ../index.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Login gagal. Periksa kembali No Induk dan Password.";
            header("Location: loginpljr.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Login gagal. Periksa kembali No Induk dan Password.";
        header("Location: loginpljr.php");
        exit();
    }
    $stmt->close();
}
?>
