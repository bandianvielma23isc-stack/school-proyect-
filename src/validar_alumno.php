<?php
session_start();
include '../config/conexion.php';

if (isset($_POST['nombre']) && isset($_POST['matricula'])) {
    $nombre_ingresado = mysqli_real_escape_string($conn, trim($_POST['nombre']));
    $matricula_ingresada = trim($_POST['matricula']); 

    $query = "SELECT * FROM alumnos WHERE nombre LIKE '$nombre_ingresado%'";
    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) > 0) {
        $datos = mysqli_fetch_array($res);
        
        if (password_verify($matricula_ingresada, $datos['matricula'])) {
            
            $_SESSION['alumno_id'] = $datos['id']; 
            $_SESSION['alumno_nombre'] = $datos['nombre'];
            $_SESSION['alumno_matricula_limpia'] = $matricula_ingresada; // Para pintarla limpia en la credencial

            header("Location: ../public/perfil_alumno.php");
            exit();
        } else {
            echo "<script>alert('Datos incorrectos. Verifica tu matrícula.'); window.location='../public/login_alumno.php';</script>";
        }
    } else {
        echo "<script>alert('Alumno no encontrado. Verifica tu nombre.'); window.location='../public/login_alumno.php';</script>";
    }
} else {
    header("Location: ../public/login_alumno.php");
    exit();
}
?>