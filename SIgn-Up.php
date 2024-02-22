<!-- Sign Up -->
<?php 
    include "database.php";
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
<body>
<div class="form-box">
<form class="form">
    <span class="title">Daftar</span>
    <span class="subtitle">Gak Punya Akun?</span>
    <button onclick="kirimEmail()">Minta 1 Ke Admin!</button>

<script>
function kirimEmail() {
    var tujuanEmail = "pgaurdian45@gmail.com";
    var subjekEmail = "Membuat Akun? Email";
    var isiPesan = "Buat akun";

    var linkEmail = "mailto:" + tujuanEmail + "?subject=" + subjekEmail + "&body=" + isiPesan;

    window.location.href = linkEmail;
}
</script>

</form>
<div class="form-section">
  <p>Udah punya akun? <a href="index.php">Log in</a> </p>
</div>
</div>
</body>
</html>