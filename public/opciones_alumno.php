<?php
session_start();
// Si ya hay sesión de alumno, ir directo al perfil
if (isset($_SESSION['alumno_matricula'])) {
    header("Location: perfil_alumno.php");
    exit();
}
// Si hay sesión de admin, redirigir al panel admin
if (isset($_SESSION['admin_auth'])) {
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Opciones Alumno - TEC San Pedro</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <img src="assets/img/logo_tec.png" class="logo-tec" alt="TEC San Pedro">
    <h1>¿Qué deseas hacer?</h1>
    <div class="container">
        <a href="login_alumno.php" class="card">
            <span class="icon">🆔</span>
            <h2>Ingresar</h2>
            <p>Ya estoy registrado</p>
        </a>
        <a href="registrar.php" class="card">
            <span class="icon">📝</span>
            <h2>Registrarme</h2>
            <p>Darse de alta</p>
        </a>
    </div>
    <a href="index.php" class="btn-regresar">← Volver al inicio</a>
</body>
</html>