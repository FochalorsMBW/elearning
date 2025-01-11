<?php
include('koneksi.php');
include('auth.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="../css/styles.css" rel="stylesheet" type="text/css">
    <title>Login</title>
</head>

<body data-bs-theme="light" class="bg-light text-dark">
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">D'exter</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <li class="d-flex">
        <a class="btn btn-success rounded-pill disabled" href="loginpljr.php">Login</a>
      </li>
    </div>
  </div>
</nav>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-sm" style="width: 100%; max-width: 400px;">
        <div class="card-body">
            <h1 class="text-center mb-4">Masuk</h1>
            <form action="rolelogin.php" method="POST" onsubmit="return validateForm()">
                <div class="mb-3">
                    <label for="NO_INDUK" class="form-label">No Induk</label>
                    <input type="text" name="NO_INDUK" id="NO_INDUK" class="form-control" placeholder="No Induk" required>
                </div>
                <div class="mb-3">
                    <label for="PASSWORD" class="form-label">Password</label>
                    <input type="password" name="PASSWORD" id="PASSWORD" class="form-control" placeholder="Password" required>
                </div>
                <?php
                    if (isset($_SESSION['error'])) {
                        echo "<div class='alert alert-danger'>".$_SESSION['error']."</div>";
                        unset($_SESSION['error']);
                    }
                ?>
                <button type="submit" class="btn btn-success w-100">Masuk</button>
            </form>
            <div class="text-center mt-3">
                <button class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk Sign Up -->
<div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signUpModalLabel">Daftar Akun</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="signup_pljr.php" method="POST">
                    <div class="mb-3">
                        <label for="NO_INDUK" class="form-label">No Induk</label>
                        <input type="text" name="NO_INDUK" id="NO_INDUK" class="form-control" placeholder="No Induk" required>
                    </div>
                    <div class="mb-3">
                        <label for="USERNAME" class="form-label">Nama Pengguna</label>
                        <input type="text" name="USERNAME" id="USERNAME" class="form-control" placeholder="Nama Pengguna" required>
                    </div>
                    <div class="mb-3">
                        <label for="SIGNUP_PASSWORD" class="form-label">Password</label>
                        <input type="password" name="PASSWORD" id="SIGNUP_PASSWORD" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="SIGNUP_CONFIRM_PASSWORD" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="CONFIRM_PASSWORD" id="SIGNUP_CONFIRM_PASSWORD" class="form-control" placeholder="Konfirmasi Password" required>
                        <div id="passwordError" class="text-danger mt-2" style="display: none;">Password tidak cocok!</div>
                    </div>
                    <label class="form-label">Posisi</label><br>
                    <div class="btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" value="pelajar" class="btn-check" name="ROLE" id="btnradio1" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="btnradio1">Pelajar</label>

                        <input type="radio" value="pengajar" class="btn-check" name="ROLE" id="btnradio2" autocomplete="off">
                        <label class="btn btn-outline-danger" for="btnradio2">Pengajar</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="dark-mode-toggle" id="toggleButton">
    <i class="bi bi-sun-fill" id="toggleIcon"></i>
  </div>
  <script src="../js/darkmode.js"></script>
    <script src="../js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script>
    const passwordField = document.querySelector('#SIGNUP_PASSWORD');
    const confirmPasswordField = document.querySelector('#SIGNUP_CONFIRM_PASSWORD');
    const signUpForm = document.querySelector('form[action="signup_pljr.php"]');
    const passwordError = document.querySelector('#passwordError');

    signUpForm.addEventListener('submit', function(event) {
        if (passwordField.value !== confirmPasswordField.value) {
            event.preventDefault();
            passwordError.style.display = 'block';
        } else {
            passwordError.style.display = 'none';
        }
    });
    </script>

</body>
</html>