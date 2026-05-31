<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include '../config/conexion.php';

if (!isset($_SESSION['admin_auth']) || !isset($_GET['id'])) {
    if (isset($_SESSION['alumno_matricula'])) session_destroy();
    header("Location: login.php");
    exit();
}

$id     = mysqli_real_escape_string($conn, $_GET['id']);
$res    = mysqli_query($conn, "SELECT * FROM alumnos WHERE id = '$id'");
$al     = mysqli_fetch_array($res);
$clubes = mysqli_query($conn, "SELECT * FROM clubes");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumno - TEC San Pedro</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/editar_alumno.css">
</head>
<body>
</script>
    <div class="card">
        <h2>Editar Alumno</h2>
        <form action="../src/actualizar_proceso.php" method="POST" id="formEditar">
            <input type="hidden" name="id" value="<?= $al['id'] ?>">
            <input
                type="text"
                name="nombre"
                id="nombre"
                value="<?= $al['nombre'] ?>"
                placeholder="Ej: Juan Carlos"
                maxlength="30"
                title="Solo letras, máximo 30 caracteres, sin letras repetidas 4 veces o más"
                oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '')"
                required>
            <input
                type="text"
                name="apellidos"
                id="apellidos"
                value="<?= $al['apellidos'] ?>"
                placeholder="Ej: García López"
                maxlength="30"
                title="Solo letras, máximo 30 caracteres, sin letras repetidas 4 veces o más"
                oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '')"
                required>
            <input
                type="text"
                name="matricula"
                value="<?= $al['matricula'] ?>"
                placeholder="Ej: 2210001500"
                pattern="[0-9]{10}"
                title="Exactamente 10 dígitos numéricos"
                maxlength="10"
                minlength="10"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                required>
            <small class="field-hint">Matrícula: exactamente 10 dígitos</small>
            <select name="carrera" required>
                <option value="Sistemas Computacionales" <?= $al['carrera'] == 'Sistemas Computacionales' ? 'selected' : '' ?>>Sistemas Computacionales</option>
                <option value="Industrial"               <?= $al['carrera'] == 'Industrial'               ? 'selected' : '' ?>>Industrial</option>
                <option value="Gestion Empresarial"      <?= $al['carrera'] == 'Gestion Empresarial'      ? 'selected' : '' ?>>Gestión Empresarial</option>
                <option value="Logistica"                <?= $al['carrera'] == 'Logistica'                ? 'selected' : '' ?>>Logística</option>
            </select>
            <select name="club_id" required>
                <?php while ($c = mysqli_fetch_array($clubes)): ?>
                    <option value="<?= $c['id'] ?>" <?= $al['club_id'] == $c['id'] ? 'selected' : '' ?>>
                        <?= $c['nombre_club'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="btn-save">GUARDAR CAMBIOS</button>
            <a href="admin.php" class="cancel-link">← Cancelar y volver al Dashboard</a>
        </form>
    </div>

    <script>
        function tieneLetraRepetida(valor) {
            return /([a-záéíóúñ])\1{3,}/i.test(valor);
        }

        document.getElementById('formEditar').addEventListener('submit', function(e) {
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
    </script>
    <script>
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            window.location.reload();
        }
    });
</script>
</body>
</html>