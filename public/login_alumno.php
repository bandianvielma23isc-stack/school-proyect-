<?php
session_start();

if (isset($_SESSION['alumno_id'])) {
    header("Location: perfil_alumno.php");
    exit();
}

if (isset($_SESSION['admin_auth']) || isset($_SESSION['alumno_matricula'])) {
    session_destroy();
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Alumnos - TEC San Pedro</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="card alumno">
        <img src="assets/img/logo_tec.png" alt="TEC San Pedro" class="logo-tec"
             onclick="window.location.href='index.php'" style="cursor:pointer;">
        <h2>Bienvenido</h2>
        <p>Ingresa tus datos para acceder a tu club</p>
        <form action="../src/validar_alumno.php" method="POST" id="formLogin">
            <input
                type="text"
                name="nombre"
                id="nombre"
                placeholder="Nombre(s)"
                maxlength="30"
                title="Solo letras, máximo 30 caracteres"
                oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '')"
                required>
            <input
                type="text"
                name="matricula"
                placeholder="Matrícula"
                pattern="[0-9]{7,12}"
                title="La matricula debe tener entre 7 y 12 digitos numericos"
                maxlength="12"
                minlength="7"
                inputmode="numeric"
                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 12)"
                required>
            <button type="submit">ENTRAR</button>
        </form>
        <a href="opciones_alumno.php" class="back-link">← Volver a opciones</a>
    </div>

    <script>
        function tieneLetraRepetida(valor) {
            return /([a-záéíóúñ])\1{3,}/i.test(valor);
        }

        document.getElementById('formLogin').addEventListener('submit', function(e) {
            const nombre = document.getElementById('nombre').value.trim();

            if (nombre.length > 30) {
                e.preventDefault();
                Swal.fire({ title: 'Error', text: 'El nombre no puede tener más de 30 caracteres.', icon: 'error', confirmButtonColor: '#B30000' });
                return;
            }
            if (tieneLetraRepetida(nombre)) {
                e.preventDefault();
                Swal.fire({ title: 'Nombre inválido', text: 'El nombre contiene una letra repetida 4 o más veces seguidas.', icon: 'error', confirmButtonColor: '#B30000' });
                return;
            }
        });
    </script>
</body>
</html>
