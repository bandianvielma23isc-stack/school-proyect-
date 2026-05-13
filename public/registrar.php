<?php
session_start();
include '../config/conexion.php';

$query_clubes = "SELECT id, nombre_club FROM clubes";
$res_clubes   = mysqli_query($conn, $query_clubes);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Alumno - TEC San Pedro</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/registrar.css">
</head>
<body>
    <div class="form-card">
        <img src="assets/img/logo_tec.png" class="logo-tec" alt="TEC San Pedro">
        <h2>Registro de Alumno</h2>

        <form action="../src/guardar.php" method="POST" id="formRegistro">
            <div class="input-group">
                <label>Nombre(s):</label>
                <input
                    type="text"
                    name="nombre"
                    placeholder="Ej: Juan Carlos"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"
                    title="Solo se permiten letras, sin números ni caracteres especiales"
                    oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '')"
                    required>
            </div>
            <div class="input-group">
                <label>Apellidos:</label>
                <input
                    type="text"
                    name="apellidos"
                    placeholder="Ej: García López"
                    pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"
                    title="Solo se permiten letras, sin números ni caracteres especiales"
                    oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '')"
                    required>
            </div>
            <div class="input-group">
                <label>Matrícula:</label>
                <input
                    type="text"
                    name="matricula"
                    placeholder="Ej: 221000150"
                    pattern="[0-9]+"
                    title="Solo se permiten números"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                    required>
            </div>
            <div class="input-group">
                <label>Carrera:</label>
                <select name="carrera" required>
                    <option value="Sistemas Computacionales">Sistemas Computacionales</option>
                    <option value="Industrial">Industrial</option>
                    <option value="Logística">Logística</option>
                    <option value="Gestión Empresarial">Gestión Empresarial</option>
                </select>
            </div>
            <div class="input-group">
                <label>¿A qué club quieres pertenecer?</label>
                <select name="club_id" required>
                    <?php while ($c = mysqli_fetch_array($res_clubes)): ?>
                        <option value="<?= $c['id'] ?>"><?= strtoupper($c['nombre_club']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn-enviar">Enviar Registro</button>
        </form>

        <!-- Link inteligente según quién esté usando el formulario -->
        <?php if (isset($_SESSION['admin_auth'])): ?>
            <a href="admin.php" class="back-link">← Volver al Dashboard</a>
        <?php else: ?>
            <a href="opciones_alumno.php" class="back-link">← Volver a opciones</a>
        <?php endif; ?>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status') === 'success') {
            Swal.fire({
                title: '¡Registro Exitoso!',
                text: 'Tus datos han sido guardados correctamente.',
                icon: 'success',
                confirmButtonColor: '#B30000',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) window.location.href = 'registrar.php';
            });
        }
        if (urlParams.get('status') === 'error') {
            Swal.fire({
                title: 'Error',
                text: 'No se pudo completar el registro. Intenta de nuevo.',
                icon: 'error',
                confirmButtonColor: '#B30000'
            });
        }
    </script>
</body>
</html>