<?php
session_start();
include "database.php";

// Periksa apakah pengguna sudah login sebagai admin
$admin_akses = isset($_SESSION['admin_akses']) ? $_SESSION['admin_akses'] : null;

if ($admin_akses !== null) {
    // Pastikan bahwa $admin_akses adalah array
    $admin_akses = (array) $admin_akses;
    $admin = in_array("admin", $admin_akses);

    if (!$admin) {
        // Redirect pengguna tanpa hak admin ke home.php
        header("Location: home.php");
        exit();
    }
} else {
    // Redirect pengguna yang belum login ke halaman login
    header("Location: index.php");
    exit();
}

// Periksa apakah data telah dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai username, activity_id, dan attendance_time dari inputan form
    $username = $_POST['username'];
    $activity_id = $_POST['activity_id'];
    $attendance_time = $_POST['attendance_time'];

    // Query untuk mencari ID guru berdasarkan username
    $query = "SELECT id FROM users WHERE username = '$username'";
    $result = mysqli_query($db, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $guru_id = $row['id'];

        // Lakukan koneksi ke database (sesuaikan dengan koneksi Anda)
        include 'database.php';

        // Gunakan pernyataan SQL INSERT untuk menyimpan data kehadiran
        $query = "INSERT INTO kehadiran (id, aktivitas_id, guru_id, waktu_kehadiran) VALUES (NULL, '$activity_id', '$guru_id', '$attendance_time')";
        $result = mysqli_query($db, $query);

        if ($result) {
            // Redirect pengguna kembali ke halaman manual.php dengan pesan sukses
            header("Location: qrcode.php");
            exit();
        } else {
            // Penanganan kesalahan jika gagal menyimpan data
            echo "Error: " . mysqli_error($db);
        }
    } else {
        // Error jika pengguna tidak ditemukan
        echo "Error: User with username '$username' not found!";
    }

    // Tutup koneksi database
    mysqli_close($db);
} else {
    // Jika data tidak dikirimkan melalui metode POST, tampilkan pesan error
    echo "Error: Data not submitted via POST method!";
}
?>
