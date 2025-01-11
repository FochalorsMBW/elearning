<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>D'Exter</title>
</head>
<body>
    <div class="navbar">
        <div class="logo"><a onclick=showSidebar() href="#"><svg xmlns="http://www.w3.org/2000/svg" height="29px" viewBox="0 -960 960 960" width="50px" fill="#000000"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></div>
        <div class="nav-links" id="menu-profil">
            <a onclick="toggleDropdown()" href="#kursus"><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="80px" fill="#000000"><path d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z"/></svg></a>
        </div>
    </div>
    <div class="menu-profil" id="menu-profil">
        <ul>
            <li><a>Profil</a></li><hr>
            <li><a href="backend/sesilogout.php">Logout</a></li>
        </ul>
    </div>
    <!-- <nav class="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="logo.png" alt="logo">
                </span>

                <div class="text header-text">
                    <span class="name">D'Exter</span>
                    <span class="profession">Web Engineer</span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>
    </nav> -->
    <div class="sidebar">
        <ul>
            <li><a href="#home">Beranda</a></li>
            <li><a href="#services">Tugas</a></li>
            <li><a href="#contact">Histori</a></li>
            <li><a onclick=hideSidebar()><i class='bx bx-chevron-left'></i></a></li>
        </ul>
    </div>
    <form action="upload_bahan.php" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="fileToUpload">Pilih File untuk Diunggah:</label>
        <input class="form-control" type="file" name="fileToUpload" id="fileToUpload" required><br><br>

        <label for="deskripsi">Deskripsi:</label>
        <input type="text" class="form-control" name="deskripsi"  id="deskripsi" rows="4" cols="50" required></textarea><br><br>

        <input type="submit" class="btn btn-primary" value="Upload File" name="submit">
    </div>
    </form>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

