<?php
include "database.php";
session_start();

$err = "";

// Prevent double login redirect
if (isset($_SESSION['is_login'], $_SESSION['admin_akses'])) {
    header("location: home.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Checking empty fields
    if (empty($username) || empty($password)) {
        $err = "Tolong lengkapi data Anda.";
    } else {
        // Using prepared statement for user login
        $sql = "SELECT id, username, password, photo_filename FROM users WHERE username=? LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            
            // Verifying password using password_verify()
            if (password_verify($password, $data["password"])) {
                // Store user information in session variables
                $_SESSION['username'] = $data['username'];
                $_SESSION['photo_filename'] = $data['photo_filename'];
                $_SESSION['is_login'] = true;

                // Check admin access
                $id = $data['id'];
                $sqlAdmin = "SELECT * FROM admin_akses WHERE id = '$id'";
                $resultAdmin = mysqli_query($db, $sqlAdmin);

                if ($resultAdmin) {
                    // Initialize an empty array to store admin access
                    $akses = array();

                    while ($dataAdmin = mysqli_fetch_assoc($resultAdmin)) {
                        // Assuming 'akses_id' is the column name in the admin_akses table
                        $akses[] = $dataAdmin['akses_id'];
                    }

                    // Store admin access in session variable
                    $_SESSION['admin_akses'] = $akses;
                }

                // Redirect to home page after setting session variables
                header("location: home.php");
                exit();
            } else {
                $err = "Password tidak cocok";
            }
        } else {
            $err = "Akun tidak ditemukan";
        }
    }

    $stmt->close();
}

$db->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form-box">
        <form action="index.php" method="POST" class="form">
            <span class="title">Login</span>
            <span class="subtitle">Senang melihat anda kembali!</span>
            <div class="form-container">
                <input type="text" class="input" placeholder="Username" name="username">
                <input type="password" class="input" placeholder="Password" name="password" id="passwordInput">
                <span toggle="#passwordInput" class="toggle-password">Lihat</span>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
        <div class="form-section">
            <p>Gk punya Akun?? <a href="SIgn-Up.php">Daftar Sekarang!</a></p>
            <?php
            if (!empty($err)) {
                echo "<ul>$err</ul>";
            }
            ?>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var passwordInput = document.getElementById("passwordInput");
            var togglePassword = document.querySelector(".toggle-password");

            togglePassword.addEventListener("click", function () {
                var type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);
            });
        });
    </script>
</body>
</html>
