<?php
include 'conexion.php';

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$matricula = $_POST['matricula'];
$carrera = $_POST['carrera'];
$club_id = $_POST['club_id'];

$query = "INSERT INTO alumnos (nombre, apellidos, matricula, carrera, club_id) 
          VALUES ('$nombre', '$apellidos', '$matricula', '$carrera', '$club_id')";

if (mysqli_query($conn, $query)) {
    // Redirigir con mensaje de éxito
    header("Location: ../fronted/registrar.php?status=success");
} else {
    // Redirigir con mensaje de error
    header("Location: ../fronted/registrar.php?status=error");
}
