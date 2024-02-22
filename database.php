<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "login";

$db = mysqli_connect($hostname, $username, $password, $database_name);
if($db->connect_errno){
    echo "Failed to connect to MySQL: ";
    die("error!");
}

?>