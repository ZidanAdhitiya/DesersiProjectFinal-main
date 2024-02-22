<?php 
include "database.php";
    session_start();
    if (isset($_POST['logout'])){
    session_destroy();
    header("location:index.php");
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
    <link rel="stylesheet" href="css/style_home.css">
    <link rel="stylesheet" href="css/style_profil.css">
    <link rel="stylesheet" href="css/logout.css">
    <link rel="stylesheet" href="css/radio.css">
    <link rel="stylesheet" href="css/list_kegiatan_home.css">
<form action="home.php" method="POST">
    <button class="btn" type="submit" name="logout">
    <svg width="40" height="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#0092E4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <path d="M12 2L20 9L12 16M20 9H4M20 9L4 9"/>
</svg>
  </svg>
</button>
</form>
</head>
<body>

<script>
function handleRadioButtonClick(event) {
    // Menghapus kelas "checked" dari semua elemen radio
    var radioButtons = document.querySelectorAll('.radio-inputs .radio');
    radioButtons.forEach(function(radioButton) {
        radioButton.classList.remove('checked');
    });

    // Menambahkan kelas "checked" pada elemen radio yang dipilih
    var selectedRadioButton = event.currentTarget;
    selectedRadioButton.classList.add('checked');
}
</script>

<!-- Welcome Message -->
<h3 class="welcome-message">Selamat Datang  di halaman admin <?=$_SESSION["username"]?> </h3>




<!-- List Kegiatan -->
<div class="pack-container">
    <div class="header">
      <p class="title">
        
      </p>
      <div class="price-container">
        <span></span>
        <span>Kegiatan</span>
      </div>
    </div>
    <div>
      <ul class="lists">
        <li class="list">
          <span>
            <svg aria-hidden="true" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 12.75l6 6 9-13.5" stroke-linejoin="round" stroke-linecap="round"></path>
            </svg>
          </span>
          <p>
            Kegiatan Hari Ini
          </p>
        </li>
        <li class="list">
          <span>
            <svg aria-hidden="true" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M4.5 12.75l6 6 9-13.5" stroke-linejoin="round" stroke-linecap="round"></path>
            </svg>
          </span>
          <p>
            Timeline
          </p>
        </li>
    </div>
  </div>

  

<!-- Pindah Halaman -->
<div class="radio-inputs">
  <label class="radio" for="radio-home" onclick="window.location.href='home.php'">
    <input id="radio-home" type="radio" name="radio" checked="">
    <span class="name">Home</span>
  </label>
  <label class="radio" for="radio-kegiatan" onclick="window.location.href='kegiatan.php'">
    <input id="radio-kegiatan" type="radio" name="radio">
    <span class="name">Kegiatan</span>
  </label>
  <label class="radio" for="radio-akun" onclick="window.location.href='akun.php'">
    <input id="radio-akun" type="radio" name="radio">
    <span class="name">Akun</span>
  </label>
</div>

</body>
</html>