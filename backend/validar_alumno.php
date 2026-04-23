<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiamos los datos para evitar errores por espacios extra
    $nombre = trim($_POST['nombre']);
    $matricula = trim($_POST['matricula']);

    // La consulta ahora busca que coincidan AMBOS campos
    $query = "SELECT * FROM alumnos WHERE nombre = '$nombre' AND matricula = '$matricula'";
    $resultado = mysqli_query($conn, $query);

    if (mysqli_num_rows($resultado) > 0) {
        // Si coinciden, guardamos la matrícula en la sesión para el dashboard
        $_SESSION['alumno_matricula'] = $matricula;
        header("Location: perfil_alumno.php");
    } else {
        // Si falla uno o ambos, regresamos con error
        header("Location: login_alumno.php?error=1");
    }
}
?>