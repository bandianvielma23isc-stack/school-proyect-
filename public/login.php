<?php
session_start();
// Si ya hay sesión de admin, redirigir directo al panel
if (isset($_SESSION['admin_auth'])) {
    header("Location: admin.php");
    exit();
}
// Si hay sesión de alumno activa, cerrarla antes de entrar como admin
if (isset($_SESSION['alumno_matricula'])) {
    session_destroy();
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - TEC San Pedro</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="card">
        <img src="assets/img/logo_tec.png" class="logo-tec" alt="TEC San Pedro">
        <h2>Panel Admin</h2>
        <form action="../src/validar_acceso.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">ENTRAR</button>
        </form>
        <a href="index.php" class="btn-regresar">← Volver</a>
    </div>
</body>
</html>