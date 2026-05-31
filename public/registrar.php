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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Alumno - TEC San Pedro</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/registrar.css">
</head>
<body>
    <div class="form-card">
        <img src="assets/img/logo_tec.png" class="logo-tec" alt="TEC San Pedro"
             onclick="window.location.href='index.php'" style="cursor:pointer;">
        <h2>Registro de Alumno</h2>

        <form action="../src/guardar.php" method="POST" id="formRegistro">
            <div class="input-group">
                <label>Nombre(s):</label>
                <input
                    type="text"
                    name="nombre"
                    id="nombre"
                    placeholder="Ej: Juan Carlos"
                    maxlength="30"
                    title="Solo letras, máximo 30 caracteres, sin letras repetidas 4 veces o más"
                    oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '')"
                    required>
            </div>
            
            <div class="input-group">
                <label>Apellidos:</label>
                <input
                    type="text"
                    name="apellidos"
                    id="apellidos"
                    placeholder="Ej: García López"
                    maxlength="30"
                    title="Solo letras, máximo 30 caracteres, sin letras repetidas 4 veces o más"
                    oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '')"
                    required>
            </div>
            
            <div class="input-group">
                <label>Matrícula:</label>
                <input
                    type="text"
                    name="matricula"
                    placeholder="Ej: 2210001500"
                    pattern="[0-9]{10}"
                    title="La matrícula debe tener exactamente 10 dígitos numéricos"
                    maxlength="10"
                    minlength="10"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10)"
                    required>
                <small class="field-hint">Exactamente 10 dígitos</small>
            </div>
            
            <div class="input-group">
                <label>Carrera:</label>
                <select name="carrera" required>
                    <option value="" disabled selected>Selecciona una carrera</option>
                    <option value="Sistemas Computacionales">Sistemas Computacionales</option>
                    <option value="Industrial">Industrial</option>
                    <option value="Logística">Logística</option>
                    <option value="Gestión Empresarial">Gestión Empresarial</option>
                </select>
            </div>
            
            <div class="input-group">
                <label>¿A qué club quieres pertenecer?</label>
                <select name="club_id" required>
                    <option value="" disabled selected>Selecciona un club</option>
                    <?php 
                    if ($res_clubes) {
                        while ($c = mysqli_fetch_array($res_clubes)) {
                            $nombre_formateado = mb_convert_case($c['nombre_club'], MB_CASE_TITLE, "UTF-8");
                            echo '<option value="'.htmlspecialchars($c['id']).'">'.htmlspecialchars($nombre_formateado).'</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            
            <button type="submit" class="btn-enviar">Enviar Registro</button>
        </form>

        <?php if (isset($_SESSION['admin_auth'])): ?>
            <a href="admin.php" class="back-link">← Volver al Dashboard</a>
        <?php else: ?>
            <a href="opciones_alumno.php" class="back-link">← Volver a opciones</a>
        <?php endif; ?>
    </div>

    <script>
        function tieneLetraRepetida(valor) {
            return /([a-záéíóúñ])\1{3,}/i.test(valor);
        }

        document.getElementById('formRegistro').addEventListener('submit', function(e) {
            const nombre    = document.getElementById('nombre').value.trim();
            const apellidos = document.getElementById('apellidos').value.trim();

            if (nombre.length > 30) {
                e.preventDefault();
                Swal.fire({ title: 'Error', text: 'El nombre no puede tener más de 30 caracteres.', icon: 'error', confirmButtonColor: '#B30000' });
                return;
            }
            if (apellidos.length > 30) {
                e.preventDefault();
                Swal.fire({ title: 'Error', text: 'Los apellidos no pueden tener más de 30 caracteres.', icon: 'error', confirmButtonColor: '#B30000' });
                return;
            }
            if (tieneLetraRepetida(nombre)) {
                e.preventDefault();
                Swal.fire({ title: 'Nombre inválido', text: 'El nombre contiene una letra repetida 4 o más veces.', icon: 'error', confirmButtonColor: '#B30000' });
                return;
            }
            if (tieneLetraRepetida(apellidos)) {
                e.preventDefault();
                Swal.fire({ title: 'Apellidos inválidos', text: 'Los apellidos contienen una letra repetida 4 o más veces.', icon: 'error', confirmButtonColor: '#B30000' });
                return;
            }
        });

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