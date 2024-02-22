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
    <title>Attendance List</title>
    <link rel="stylesheet" href="css/list.css">
</head>
<body>
    <div class="container">
        <h2>Attendance List</h2>
        <div class="attendance-table">
            <table>
                <tr>
                    <th>Username</th>
                    <th>Activity ID</th>
                    <th>Waktu Kehadiran</th>
                </tr>
                <!-- PHP code to fetch and display attendance data goes here -->
                <?php
                // Query to fetch all attendance data
                $query = "SELECT kehadiran.*, users.username 
                FROM kehadiran 
                INNER JOIN users ON kehadiran.guru_id = users.id";

                $result = mysqli_query($db, $query); // Execute the query and store the result

                if ($result && mysqli_num_rows($result) > 0) {
                    // Iterate through each row of attendance data and display it in the table
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['aktivitas_id'] . "</td>";
                        echo "<td>" . $row['waktu_kehadiran'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // Display a message if there is no attendance data
                    echo "<tr><td colspan='3'>No attendance data available.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
