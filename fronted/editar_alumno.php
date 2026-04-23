<?php
session_start();
include 'conexion.php';

// Seguridad: Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Obtener el ID del alumno a editar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM alumnos WHERE id = '$id'");
    $alumno = mysqli_fetch_assoc($res);

    if (!$alumno) {
        die("Alumno no encontrado.");
    }
}

$clubes = mysqli_query($conn, "SELECT * FROM clubes");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Alumno - Admin</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #121212;
            color: white;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .card {
            background: #1e1e1e;
            padding: 30px;
            border-radius: 15px;
            width: 450px;
            border-top: 6px solid #B30000;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
            color: #b3b3b3;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #333;
            box-sizing: border-box;
            background: #252525;
            color: white;
        }

        button {
            background: #B30000;
            border: none;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background: #e60000;
        }

        .btn-cancel {
            display: block;
            text-align: center;
            color: #666;
            text-decoration: none;
            margin-top: 15px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="card">
        <center>
            <h2>Actualizar Datos</h2>
        </center>
        <form action="actualizar_proceso.php" method="POST">
            <input type="hidden" name="id" value="<?= $alumno['id'] ?>">

            <label>Nombre(s):</label>
            <input type="text" name="nombre" value="<?= $alumno['nombre'] ?>" pattern="[A-Za-zÁ-ÿ\s]+" required>

            <label>Apellidos:</label>
            <input type="text" name="apellidos" value="<?= $alumno['apellidos'] ?>" pattern="[A-Za-zÁ-ÿ\s]+" required>

            <label>Matrícula (No editable):</label>
            <input type="text" value="<?= $alumno['matricula'] ?>" disabled style="background:#121212; color:#666;">

            <label>Carrera:</label>
            <select name="carrera" required>
                <option value="Sistemas Computacionales" <?= ($alumno['carrera'] == 'Sistemas Computacionales') ? 'selected' : '' ?>>Sistemas Computacionales</option>
                <option value="Industrial" <?= ($alumno['carrera'] == 'Industrial') ? 'selected' : '' ?>>Industrial</option>
                <option value="Gestion Empresarial" <?= ($alumno['carrera'] == 'Gestion Empresarial') ? 'selected' : '' ?>>Gestión Empresarial</option>
                <option value="Logistica" <?= ($alumno['carrera'] == 'Logistica') ? 'selected' : '' ?>>Logística</option>
            </select>

            <label>Club:</label>
            <select name="club_id" required>
                <?php while ($c = mysqli_fetch_array($clubes)) { ?>
                    <option value="<?= $c['id']; ?>" <?= ($alumno['club_id'] == $c['id']) ? 'selected' : '' ?>>
                        <?= $c['nombre_club']; ?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit">GUARDAR CAMBIOS</button>
            <a href="admin.php" class="btn-cancel">Cancelar</a>
        </form>
    </div>
</body>

</html>