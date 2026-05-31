<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../config/conexion.php';

if (!isset($_SESSION['admin_auth'])) {
    header("Location: ../public/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre_input    = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellidos_input = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
    $club_id_input   = isset($_POST['club_id']) ? intval($_POST['club_id']) : 0;

    if (empty($nombre_input) || empty($apellidos_input) || $club_id_input === 0) {
        header("Location: ../public/insertar_maestro.php?status=error");
        exit();
    }

    $nombre    = mysqli_real_escape_string($conn, $nombre_input);
    $apellidos = mysqli_real_escape_string($conn, $apellidos_input);

    $query = "INSERT INTO maestros (nombre, apellidos, club_id) VALUES ('$nombre', '$apellidos', $club_id_input)";

    if (mysqli_query($conn, $query)) {
        header("Location: ../public/insertar_maestro.php?status=success");
        exit();
    } else {
        echo "Error en la base de datos: " . mysqli_error($conn);
        exit();
    }
} else {
    header("Location: ../public/insertar_maestro.php");
    exit();
}
?>