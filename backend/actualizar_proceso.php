<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['rol'] === 'admin') {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $apellidos = trim($_POST['apellidos']);
    $carrera = $_POST['carrera'];
    $club_id = $_POST['club_id'];

    // Actualizamos los datos (No permitimos cambiar la matrícula por seguridad del sistema)
    $sql = "UPDATE alumnos SET 
            nombre = '$nombre', 
            apellidos = '$apellidos', 
            carrera = '$carrera', 
            club_id = '$club_id' 
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Datos actualizados correctamente'); window.location='admin.php';</script>";
    } else {
        echo "Error al actualizar: " . mysqli_error($conn);
    }
}
