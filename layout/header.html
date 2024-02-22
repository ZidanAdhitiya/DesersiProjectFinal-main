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
    <h2>Create New Activity</h2>
    <form action="process_create_activity.php" method="POST">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50" required></textarea><br><br>
        
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" required><br><br>
        
        <label for="absensi_method">Attendance Method:</label><br>
        <select id="absensi_method" name="absensi_method" required>
            <option value="manual">Manual</option>
            <option value="qr_code">QR Code</option>
            <option value="tracking_maps">Tracking Maps</option>
        </select><br><br>
        
        <input type="submit" value="Create Activity">
    </form>
</body>
</html>
