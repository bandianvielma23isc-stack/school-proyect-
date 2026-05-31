<?php
session_start();

$usuario_ingresado = $_POST['usuario'];
$password_ingresado = $_POST['password'];

$usuario_correcto = "admin";
$password_correcto = "TECSP";

if ($usuario_ingresado === $usuario_correcto && $password_ingresado === $password_correcto) {
    $_SESSION['admin_auth'] = "Administrador";
    header("Location: ../public/admin.php");
    exit();
} else {
    echo "<script>
            alert('Usuario o Contraseña de Administrador Incorrectos');
            window.location='../public/login.php';
          </script>";
}
