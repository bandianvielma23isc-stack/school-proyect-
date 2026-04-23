<?php
$conn = mysqli_connect("localhost", "root", "", "sistema_clubes");
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}
