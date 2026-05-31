<?php
// Activar reportes de error por seguridad en el desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombre_val    = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido_val  = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
    $matricula_val = isset($_POST['matricula']) ? trim($_POST['matricula']) : '';
    $carrera_val   = isset($_POST['carrera']) ? trim($_POST['carrera']) : '';
    $club_val      = isset($_POST['club_id']) ? intval($_POST['club_id']) : 0;

    if (empty($nombre_val) || empty($apellido_val) || !preg_match('/^[0-9]{7,12}$/', $matricula_val) || $club_val === 0) {
        header("Location: ../public/registrar.php?status=error");
        exit();
    }

    $nombres   = mysqli_real_escape_string($conn, $nombre_val);
    $apellidos = mysqli_real_escape_string($conn, $apellido_val);
    $carrera   = mysqli_real_escape_string($conn, $carrera_val);

    $nombre_completo = $nombres . ' ' . $apellidos;
    $matricula_encriptada = password_hash($matricula_val, PASSWORD_BCRYPT);
    $matricula_limpia = mysqli_real_escape_string($conn, $matricula_val);

    $columna_visible = mysqli_query($conn, "SHOW COLUMNS FROM alumnos LIKE 'matricula_visible'");
    if ($columna_visible && mysqli_num_rows($columna_visible) === 0) {
        mysqli_query($conn, "ALTER TABLE alumnos ADD COLUMN matricula_visible VARCHAR(255) NULL");
    }

    $query = "INSERT INTO alumnos (nombre, matricula, matricula_visible, carrera, club_id) 
              VALUES ('$nombre_completo', '$matricula_encriptada', '$matricula_limpia', '$carrera', $club_val)";

    if (mysqli_query($conn, $query)) {
        $nuevo_id = mysqli_insert_id($conn);

        $_SESSION['alumno_id'] = $nuevo_id; 
        $_SESSION['alumno_nombre'] = $nombre_completo;
        $_SESSION['alumno_matricula_limpia'] = $matricula_val; // Guardamos la limpia para la credencial

        header("Location: ../public/perfil_alumno.php");
        exit();
    } else {
        echo "Error en la base de datos: " . mysqli_error($conn);
        exit();
    }
} else {
    header("Location: ../public/registrar.php");
    exit();
}
?>
