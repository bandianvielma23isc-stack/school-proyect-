<?php
$host = "localhost";
$user = "root";
$pass = "300605"; // Tu contraseña de Workbench si tiene, si no déjala vacía
$db = "sistema_clubes"; 

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
