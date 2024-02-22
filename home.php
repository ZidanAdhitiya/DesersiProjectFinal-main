<?php 
include "database.php";
session_start();

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Ensure script stops executing after redirect
}


if (isset($_POST['logout'])){
    session_destroy();
    header("location:index.php");
    exit(); // Ensure script stops executing after redirect
}

// Periksa apakah pengguna memiliki akses admin
$admin_akses = isset($_SESSION['admin_akses']) ? $_SESSION['admin_akses'] : null;
$admin = false; // Set default value for admin access

if ($admin_akses !== null) {
    // Ensure that $admin_akses is an array
    $admin_akses = (array) $admin_akses;
    $admin = in_array("admin", $admin_akses);
}

// Query untuk mengambil kegiatan hari ini
$query_today = "SELECT * FROM kegiatan WHERE attendance_time = CURDATE()";
$result_today = mysqli_query($db, $query_today);

// Query untuk mengambil kegiatan yang telah berlalu
$query_past = "SELECT * FROM kegiatan WHERE attendance_time < CURDATE()";
$result_past = mysqli_query($db, $query_past);

if (!$result_today || !$result_past) {
    die("Query failed: " . mysqli_error($db));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style_home.css">
    <link rel="stylesheet" href="css/radio.css">
    <link rel="stylesheet" href="css/style_table_home.css">
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
<h3 class="welcome-message">Selamat Datang <?=$_SESSION["username"]?> </h3>

<!-- List Kegiatan Home -->
<div class="pack-container">
    <div class="header-list">
        <div class="price-container">
            <span>Kegiatan Hari Ini</span>
        </div>
    </div>
    <div>
        <ul class="lists-1">
            <li class="list-2">
            <table class="first-table">
    <thead>
        <tr>
            <th>Nama Kegiatan</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Input Kehadiran</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_assoc($result_today)) : ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['attendance_time']; ?></td>
                <td><a href="manual.php?aktifitas_id=<?php echo $row['aktifitas_id']; ?>">Input Absensi</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>
            </li>
        </ul>
    </div>
</div>

<?php 
// Check if 'admin' is in the array and ensure $_SESSION['admin_akses'] is an array
if (isset($_SESSION['admin_akses']) && is_array($_SESSION['admin_akses']) && in_array("admin", $_SESSION['admin_akses']))
?>

<!-- Button Menambahkan Kegiatan -->
<button onclick="window.location.href='create_activity.php';" id="button-tambahkan">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
    <path fill="none" d="M0 0h24v24H0z"/>
    <path d="M20 11H13V4c0-.55-.45-1-1-1s-1 .45-1 1v7H4c-.55 0-1 .45-1 1s.45 1 1 1h7v7c0 .55.45 1 1 1s1-.45 1-1v-7h7c.55 0 1-.45 1-1s-.45-1-1-1z"/>
  </svg>
</button>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

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
