<?php 
session_start();
include "database.php";
if (isset($_POST['logout'])){
    session_destroy();
    header("location:index.php");
}

if(isset($_SESSION['photo_filename'])){
    $photo_filename = $_SESSION['photo_filename'];
    // You can continue adding more code here if needed
}else{
    echo "Session variable 'photo_filename' is not set.";
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION["is_login"]) || $_SESSION["is_login"] !== true) {
    header("Location: index.php"); // Arahkan pengguna ke halaman login jika belum login
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style_profil.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="stylesheet" href="css/radio.css">
    <link rel="stylesheet" href="css/akun.css">
</head>
<body>



<!-- Welcome Message -->
<h3 class="welcome-message">Selamat Datang <?=$_SESSION["username"]?> </h3>


<div class="container">
<div class="card">
<div class="card-photo">
    <?php if(isset($_SESSION['photo_filename'])): ?>
        <img src="photo/<?php echo $_SESSION['photo_filename']; ?>" alt="Foto Profil" height="50px" width="50px">
    <?php endif; ?>
</div>
    <div class="card-title"><?=$_SESSION["username"]?> <br>
    </div>
    <form action="home.php" method="POST">
    <button class="btn" type="submit" name="logout">
    <span>Logout</span>
    <path d="M12 2L20 9L12 16M20 9H4M20 9L4 9"/>
</svg>
</button>
</form>
</div>
</div>

<!-- Radio -->
<div class="radio-inputs">
  <label class="radio" for="radio-home" onclick="window.location.href='home.php'">
    <input id="radio-home" type="radio" name="radio">
    <span class="name">Home</span>
  </label>
  <label class="radio" for="radio-kegiatan" onclick="window.location.href='kegiatan.php'">
    <input id="radio-kegiatan" type="radio" name="radio">
    <span class="name">Kegiatan</span>
  </label>
  <label class="radio" for="radio-akun" onclick="window.location.href='akun.php'">
    <input id="radio-akun" type="radio" name="radio" checked="">
    <span class="name">Akun</span>
  </label>
</div>



<div>

</div>

</body>
</html>