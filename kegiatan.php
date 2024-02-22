<?php 
include "database.php";
session_start();

// Check if the user clicked on logout
if (isset($_POST['logout'])){
    session_destroy();
    header("location:index.php");
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION["is_login"]) || $_SESSION["is_login"] !== true) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
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
    <link rel="stylesheet" href="css/radio.css">
    <link rel="stylesheet" href="layout/table.css">
    <link rel="stylesheet" href="css/style_kegiatan.css">
</head>
<body>

<h1 class="welcome-message">Selamat Datang <?=$_SESSION["username"]?> </h1>

<h2 class="section-title-1">Kegiatan Hari Ini</h2>
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

<h2 class="section-title-2">Kegiatan yang Telah Berlalu</h2>
<table class="second-table">
    <thead>
        <tr>
            <th>Nama Kegiatan</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Input Kehadiran</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result_past)) : ?>
            <tr>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td><?php echo $row['attendance_time']; ?></td>
                <td><a href="list_hadir.php?aktifitas_id=<?php echo $row['aktifitas_id']; ?>">List Kehadiran</a></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="radio-inputs">
    <label class="radio" for="radio-home" onclick="window.location.href='home.php'">
        <input id="radio-home" type="radio" name="radio">
        <span class="name">Home</span>
    </label>
    <label class="radio" for="radio-kegiatan" onclick="window.location.href='kegiatan.php'">
        <input id="radio-kegiatan" type="radio" name="radio" checked="">
        <span class="name">Kegiatan</span>
    </label>
    <label class="radio" for="radio-akun" onclick="window.location.href='akun.php'">
        <input id="radio-akun" type="radio" name="radio">
        <span class="name">Akun</span>
    </label>
</div>

</body>
</html>
