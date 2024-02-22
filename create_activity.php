<?php
session_start();
// Periksa apakah pengguna sudah login
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Activity</title>
    <link rel="stylesheet" href="CSS/create_activity.css">
</head>
<body>
    <h2>Buat Kegiatan Baru</h2>
    <p>Mangga, di pilih dulu metode absensi nya:</p>
    <ul>
        <li><a href="qrcode_form.php">QR Code</a></li>
        <li><a href="manual_form.php">Manual</a></li>
        <li><a href="tracking_form.php">Tracking Maps (Koming Sun)</a></li>
    </ul>
</body>
</html>
