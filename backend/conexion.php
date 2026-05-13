<?php
$host = "localhost";
$user = "root";
$pass = ""; // Tu contraseña de Workbench si tiene, si no déjala vacía
$db = "sistema_clubes"; // <--- CAMBIADO A SISTEMA_CLUBES

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
