<?php
session_start();

// Recibimos los datos del formulario de login
$usuario_ingresado = $_POST['usuario'];
$password_ingresado = $_POST['password'];

// Definimos tus credenciales fijas
$usuario_correcto = "admin";
$password_correcto = "TECSP";

if ($usuario_ingresado === $usuario_correcto && $password_ingresado === $password_correcto) {
    // Si coinciden, creamos la sesión y mandamos al panel oscuro
    $_SESSION['admin_auth'] = "Administrador";
    header("Location: ../public/admin.php");
    exit();
} else {
    // Si fallan, mandamos una alerta y regresamos al login
    echo "<script>
            alert('Usuario o Contraseña de Administrador Incorrectos');
            window.location='../public/login.php';
          </script>";
}
