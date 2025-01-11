<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>D'Exter</title>
</head>
<body data-bs-theme="light">
    
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="">D'exter</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      </ul>
      <li class="d-flex">
        <a class="btn btn-outline-success rounded-pill" href="backend/loginpljr.php">Login
        </a>
      </li>
    </div>
  </div>
</nav>
    <div style="all: unset;">
    <div class="container my-5">
        <h1 class="text-center">Dashboard</h1>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h2 id="totalPengunjung">29129</h2>
                        <p>Total Pengunjung</p>
                    </div>
                </div>
            </div><br>
            <div class="col-md-4 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h2 id="totalPengajar">212</h2>
                        <p>Total Pengajar</p>
                    </div>
                </div>
            </div><br>
            <div class="col-md-4 mb-4">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h2 id="totalPelajar">28917</h2>
                        <p>Total Pelajar</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<!-- ======================= Dark Mode =============================== -->
<div class="dark-mode-toggle" id="toggleButton">
    <i class="bi bi-sun-fill" id="toggleIcon"></i>
  </div>
<!-- =============================================================== -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>     
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script src="js/darkmode.js"></script>
</body>
</html>
