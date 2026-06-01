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

    if (
        empty($nombre_input) ||
        empty($apellidos_input) ||
        $club_id_input === 0 ||
        !preg_match('/^[\p{L} ]{1,25}$/u', $nombre_input) ||
        !preg_match('/^[\p{L} ]{1,30}$/u', $apellidos_input)
    ) {
        header("Location: ../public/insertar_maestro.php?status=error");
        exit();
    }

    $nombre    = mysqli_real_escape_string($conn, $nombre_input);
    $apellidos = mysqli_real_escape_string($conn, $apellidos_input);

    $existe_query = "SELECT id FROM maestros WHERE club_id = $club_id_input ORDER BY id DESC LIMIT 1";
    $existe_res = mysqli_query($conn, $existe_query);

    if ($existe_res && mysqli_num_rows($existe_res) > 0) {
        $maestro_actual = mysqli_fetch_assoc($existe_res);
        $maestro_id = intval($maestro_actual['id']);
        $query = "UPDATE maestros SET nombre = '$nombre', apellidos = '$apellidos' WHERE id = $maestro_id";
    } else {
        $query = "INSERT INTO maestros (nombre, apellidos, club_id) VALUES ('$nombre', '$apellidos', $club_id_input)";
    }

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
