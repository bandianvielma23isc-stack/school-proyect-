<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $matricula = trim($_POST['matricula']);
    $carrera = $_POST['carrera'];
    $club_id = $_POST['club_id'];

    // 1. Verificar si la matrícula ya existe
    $check_mat = mysqli_query($conn, "SELECT * FROM alumnos WHERE matricula = '$matricula'");

    // 2. Verificar si el nombre completo ya existe
    $check_nom = mysqli_query($conn, "SELECT * FROM alumnos WHERE nombre = '$nombre' AND apellidos = '$apellidos'");

    if (mysqli_num_rows($check_mat) > 0) {
        echo "<script>alert('Error: La matrícula $matricula ya está registrada.'); window.location='registrar.php';</script>";
    } elseif (mysqli_num_rows($check_nom) > 0) {
        echo "<script>alert('Error: El alumno $nombre $apellidos ya está inscrito en un club.'); window.location='registrar.php';</script>";
    } else {
        // Si todo está limpio, insertamos
        $sql = "INSERT INTO alumnos (nombre, apellidos, matricula, carrera, club_id) 
                VALUES ('$nombre', '$apellidos', '$matricula', '$carrera', '$club_id')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('¡Registro exitoso! Bienvenido.'); window.location='index.php';</script>";
        } else {
            echo "Error técnico: " . mysqli_error($conn);
        }
    }
}
