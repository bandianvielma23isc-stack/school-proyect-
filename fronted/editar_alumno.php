<?php
session_start();
include '../backend/conexion.php';

if (!isset($_SESSION['admin_auth']) || !isset($_GET['id'])) {
    header("Location: admin.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$res = mysqli_query($conn, "SELECT * FROM alumnos WHERE id = '$id'");
$al = mysqli_fetch_array($res);
$clubes = mysqli_query($conn, "SELECT * FROM clubes");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Alumno</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #121212;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #1a1a1a;
            padding: 40px;
            border-radius: 20px;
            width: 400px;
            border-top: 5px solid #B30000;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            background: #262626;
            border: 1px solid #333;
            color: white;
            border-radius: 8px;
            box-sizing: border-box;
        }

        .btn-save {
            width: 100%;
            padding: 15px;
            background: #B30000;
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="card">
        <h2 style="color: #B30000; text-align: center;">Editar Alumno</h2>
        <form action="../backend/actualizar_proceso.php" method="POST">
            <input type="hidden" name="id" value="<?= $al['id'] ?>">
            <input type="text" name="nombre" value="<?= $al['nombre'] ?>" required>
            <input type="text" name="apellidos" value="<?= $al['apellidos'] ?>" required>
            <input type="text" name="matricula" value="<?= $al['matricula'] ?>" required>
            <select name="carrera" required>
                <option value="Sistemas Computacionales" <?= $al['carrera'] == 'Sistemas Computacionales' ? 'selected' : '' ?>>Sistemas Computacionales</option>
                <option value="Industrial" <?= $al['carrera'] == 'Industrial' ? 'selected' : '' ?>>Industrial</option>
                <option value="Gestion Empresarial" <?= $al['carrera'] == 'Gestion Empresarial' ? 'selected' : '' ?>>Gestión Empresarial</option>
                <option value="Logistica" <?= $al['carrera'] == 'Logistica' ? 'selected' : '' ?>>Logística</option>
            </select>
            <select name="club_id" required>
                <?php while ($c = mysqli_fetch_array($clubes)): ?>
                    <option value="<?= $c['id'] ?>" <?= $al['club_id'] == $c['id'] ? 'selected' : '' ?>><?= $c['nombre_club'] ?></option>
                <?php endwhile; ?>
            </select>
            <button type="submit" class="btn-save">GUARDAR CAMBIOS</button>
            <a href="admin.php" style="display:block; text-align:center; margin-top:15px; color:#666; text-decoration:none;">Cancelar</a>
        </form>
    </div>
</body>

</html>