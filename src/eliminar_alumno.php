<?php
session_start();
include '../config/conexion.php';

if (isset($_SESSION['admin_auth']) && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    if (mysqli_query($conn, "DELETE FROM alumnos WHERE id = '$id'")) {
        header("Location: ../public/admin.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
