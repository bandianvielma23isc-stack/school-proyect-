<?php
session_start();
include 'conexion.php';

if (isset($_GET['id']) && $_SESSION['rol'] === 'admin') {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM alumnos WHERE id = '$id'");
    header("Location: admin.php");
}
