<?php
session_start();
include '../config/conexion.php';

if (isset($_POST['matricula'])) {
    $matricula = mysqli_real_escape_string($conn, $_POST['matricula']);
    $query = "SELECT * FROM alumnos WHERE matricula = '$matricula'";
    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) > 0) {
        $datos = mysqli_fetch_array($res);
        $_SESSION['alumno_matricula'] = $datos['matricula'];
        $_SESSION['alumno_nombre'] = $datos['nombre'];

      
        header("Location: ../public/perfil_alumno.php");
        exit();
    } else {
        echo "<script>alert('Matrícula no encontrada'); window.location='../public/login_alumno.php';</script>";
    }
}
