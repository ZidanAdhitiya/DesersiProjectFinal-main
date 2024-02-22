<?php
// Include the database connection file
include 'database.php';

// Include the library autoload file
require 'vendor/autoload.php';
use Endroid\QrCode\QrCode;

// Periksa apakah data telah dikirimkan melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai judul, deskripsi, dan metode absensi dari inputan form
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $absensi_method = isset($_POST['absensi_method']) ? $_POST['absensi_method'] : '';

    // Validasi input
    if (empty($title) || empty($description) || empty($absensi_method)) {
        // Jika ada bidang yang kosong, tampilkan pesan error
        echo "Error: All fields are required!";
    } else {
        // Gunakan prepared statement untuk memasukkan data ke database
        $query = "INSERT INTO kegiatan (title, description, absensi_method, attendance_time) VALUES (?, ?, ?, NOW())";
        $stmt = mysqli_prepare($db, $query);

        if ($stmt) {
            // Bind parameter ke prepared statement
            mysqli_stmt_bind_param($stmt, "sss", $title, $description, $absensi_method);

            // Eksekusi statement
            if (mysqli_stmt_execute($stmt)) {
                // Kegiatan berhasil ditambahkan ke database
                // Dapatkan ID kegiatan yang baru saja dimasukkan
                $activity_id = mysqli_insert_id($db);

                // Buat objek QR Code dengan konten yang sesuai (gunakan ID kegiatan sebagai konten)
                $qrCode = new QrCode($activity_id);
                
                // Setel ukuran QR Code jika perlu (opsional)
                $qrCode->setSize(300);

                // Tentukan nama file untuk gambar PNG yang akan disimpan
                $fileName = 'qr_code.png';

                // Simpan gambar QR Code ke file
                $qrCode->writeFile($fileName);

                // Redirect user back to the appropriate attendance method page with a success message
                header("Location: qrcode.php");
                exit();
            } else {
                // Penanganan kesalahan jika query tidak berhasil dieksekusi
                echo "Error: Unable to execute statement!";
            }
            
            // Tutup statement
            mysqli_stmt_close($stmt);
        } else {
            // Penanganan kesalahan jika prepared statement tidak berhasil dibuat
            echo "Error: Unable to create prepared statement!";
        }
    }
} else {
    // Jika data tidak dikirimkan melalui metode POST, tampilkan pesan error
    echo "Error: Data not submitted via POST method!";
}

// Tutup koneksi
mysqli_close($db);
?>