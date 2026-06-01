<?php
session_start();
include '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['admin_auth'])) {
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $matricula = mysqli_real_escape_string($conn, $_POST['matricula']);
    $carrera = $_POST['carrera'];
    $club_id = $_POST['club_id'];

    if (!preg_match('/^[0-9]{7,12}$/', $matricula)) {
        header("Location: ../public/editar_alumno.php?id=$id&status=error");
        exit();
    }

    // Verificar si la matrícula ya está registrada en otro alumno
    $query_check = "SELECT id FROM alumnos WHERE matricula_visible = '$matricula' AND id != '$id'";
    $res_check = mysqli_query($conn, $query_check);
    
    if (mysqli_num_rows($res_check) > 0) {
        header("Location: ../public/editar_alumno.php?id=$id&status=matricula_existe");
        exit();
    }

    $columna_visible = mysqli_query($conn, "SHOW COLUMNS FROM alumnos LIKE 'matricula_visible'");
    if ($columna_visible && mysqli_num_rows($columna_visible) === 0) {
        mysqli_query($conn, "ALTER TABLE alumnos ADD COLUMN matricula_visible VARCHAR(255) NULL");
    }

    $matricula_hash = password_hash($matricula, PASSWORD_BCRYPT);
    $sql = "UPDATE alumnos SET nombre='$nombre', apellidos='$apellidos', matricula='$matricula_hash', matricula_visible='$matricula', carrera='$carrera', club_id='$club_id' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../public/admin.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
