<?php
session_start();
// Si ya hay sesión de alumno, redirigir a su perfil
if (isset($_SESSION['alumno_matricula'])) {
    header("Location: perfil_alumno.php");
    exit();
}
// Si hay sesión de admin activa, cerrarla antes de entrar como alumno
if (isset($_SESSION['admin_auth'])) {
    session_destroy();
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Alumnos - TEC San Pedro</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="card alumno">
        <img src="assets/img/logo_tec.png" alt="TEC San Pedro" class="logo-tec">
        <h2>Bienvenido</h2>
        <p>Ingresa tus datos para acceder a tu club</p>
        <form action="../src/validar_alumno.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="text" name="matricula" placeholder="Matrícula" required>
            <button type="submit">ENTRAR</button>
        </form>
        <a href="opciones_alumno.php" class="back-link">← Volver a opciones</a>
    </div>
</body>
</html>