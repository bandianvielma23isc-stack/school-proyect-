<?php
$host = "localhost";
$user = "root";
$pass = "1234"; 
$db = "sistema_clubes"; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");
?>