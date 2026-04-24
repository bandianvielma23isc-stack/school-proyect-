<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['admin_auth'])) {
    $id = $_POST['id'];
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $matricula = mysqli_real_escape_string($conn, $_POST['matricula']);
    $carrera = $_POST['carrera'];
    $club_id = $_POST['club_id'];

    $sql = "UPDATE alumnos SET nombre='$nombre', apellidos='$apellidos', matricula='$matricula', carrera='$carrera', club_id='$club_id' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: ../fronted/admin.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
