<!-- navbar.php -->
<?php
$current_page = basename($_SERVER['REQUEST_URI'], ".php");
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand px-3" href="">D'exter</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
</div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
      <li class="nav-item">
          <a class="nav-link px-3 <?php echo ($current_page == 'dashboardpgjr') ? 'active' : ''; ?>" aria-current="page" href="../dashboard/dashboardpgjr.php">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link px-3 <?php echo ($current_page == 'bahanajar') ? 'active' : ''; ?>" href="../bahanajar/bahanajar.php">Bahan Ajar</a>
        </li>
        <li class="nav-item px-3">
          <a class="nav-link <?php echo ($current_page == 'kursuss') ? 'active' : ''; ?>" href="../kursus/kursuss.php">Kursus</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle px-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pengaturan
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../pengaturan/profilpgjr.php">Profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="../backend/sesilogout.php">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
