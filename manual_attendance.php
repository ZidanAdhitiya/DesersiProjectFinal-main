<?php
session_start();
include "database.php"; // Pastikan file ini berisi kode koneksi database yang diperlukan
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit(); // Ensure script stops executing after redirect
}

// Periksa apakah pengguna sudah login sebagai admin
$admin_akses = isset($_SESSION['admin_akses']) ? $_SESSION['admin_akses'] : null;

if ($admin_akses !== null) {
    // Ensure that $admin_akses is an array
    $admin_akses = (array)$admin_akses;
    $admin = in_array("admin", $admin_akses);

    if (!$admin) {
        // Redirect users without admin access to home.php
        header("Location: home.php");
        exit(); // Make sure to exit after a redirect
    }
} else {
    // Redirect users who are not logged in to the login page
    header("Location: index.php");
    exit(); // Make sure to exit after a redirect
}
// Check if aktivitas_id is included in the URL parameter and is not empty
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manual Attendance</title>
    <link rel="stylesheet" href="css/manual.css">
    <link rel="stylesheet" href="layout/button_manual.css">
</head>
<body>
    <h2>Manual Attendance</h2>
    <form action="process_manual_attendance.php" method="POST">
        <label for="username">Username Guru:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="activity_id">Activity ID:</label><br>
        <input type="text" id="activity_id" name="activity_id" required><br><br>
        
        <label for="attendance_time">Attendance Time:</label><br>
        <input type="datetime-local" id="attendance_time" name="attendance_time" required><br><br>
        
        <input type="submit" value="Submit Attendance">
        <button type="button" onclick="window.location.href='list_hadir.php'">List Kehadiran</button>
    </form>
</body>
</html>
