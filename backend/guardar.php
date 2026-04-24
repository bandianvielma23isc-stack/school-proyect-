<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['admin_auth'])) {

    $matricula = mysqli_real_escape_string($conn, $_POST['matricula']);
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $carrera = $_POST['carrera'];
    $club_id = $_POST['club_id'];

    $sql = "INSERT INTO alumnos (matricula, nombre, apellidos, carrera, club_id) 
            VALUES ('$matricula', '$nombre', '$apellidos', '$carrera', '$club_id')";

    if (mysqli_query($conn, $sql)) {
        // Al terminar, te regresa al Dashboard principal
        header("Location: ../fronted/admin.php?success=1");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
