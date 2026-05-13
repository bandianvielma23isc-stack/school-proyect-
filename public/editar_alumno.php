<?php
session_start();
include '../config/conexion.php';

if (!isset($_SESSION['admin_auth']) || !isset($_GET['id'])) {
    if (isset($_SESSION['alumno_matricula'])) {
        session_destroy();
    }
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
    <title>Editar Alumno - TEC San Pedro</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/editar_alumno.css">
</head>
<body>
    <div class="card">
        <h2>Editar Alumno</h2>
        <form action="../src/actualizar_proceso.php" method="POST">
            <input type="hidden" name="id" value="<?= $al['id'] ?>">
            <input
                type="text"
                name="nombre"
                value="<?= $al['nombre'] ?>"
                placeholder="Ej: Juan Carlos"
                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"
                title="Solo se permiten letras"
                oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '')"
                required>
            <input
                type="text"
                name="apellidos"
                value="<?= $al['apellidos'] ?>"
                placeholder="Ej: García López"
                pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+"
                title="Solo se permiten letras"
                oninput="this.value = this.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '')"
                required>
            <input
                type="text"
                name="matricula"
                value="<?= $al['matricula'] ?>"
                placeholder="Ej: 221000150"
                pattern="[0-9]+"
                title="Solo se permiten números"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                required>
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
</body>
</html>