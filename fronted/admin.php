<?php
session_start();
include '../backend/conexion.php';
// Verificamos sesión de admin
if (!isset($_SESSION['admin_auth'])) {
    header("Location: login.php");
    exit();
}

$res = mysqli_query($conn, "SELECT a.*, c.nombre_club FROM alumnos a JOIN clubes c ON a.club_id = c.id ORDER BY a.id DESC");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Clubes - Administrador</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #0c0c0c;
            color: #fff;
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background-color: #141414;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            border-right: 2px solid #222;
            flex-shrink: 0;
        }

        .logo-tec {
            width: 140px;
            margin-bottom: 40px;
            align-self: center;
        }

        .nav-link {
            color: #888;
            text-decoration: none;
            padding: 15px;
            margin-bottom: 5px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            display: block;
            border-left: 4px solid transparent;
            transition: 0.3s;
        }

        .active {
            background: #333 !important;
            color: white !important;
            border-left: 4px solid #B30000 !important;
        }

        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        h1 {
            font-size: 28px;
            border-left: 6px solid #B30000;
            padding-left: 20px;
            margin-bottom: 40px;
            text-transform: uppercase;
        }

        .table-container {
            background: #141414;
            border: 1px solid #222;
            border-radius: 4px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #B30000;
            color: #fff;
            padding: 15px;
            text-transform: uppercase;
            font-size: 12px;
            text-align: left;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #222;
            color: #ccc;
            font-size: 13px;
        }

        .m-text {
            color: #B30000;
            font-weight: bold;
            font-family: monospace;
        }

        .btn-edit {
            color: #3498db;
            text-decoration: none;
            border: 1px solid #3498db;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
            font-size: 11px;
        }

        .btn-delete {
            color: #e74c3c;
            text-decoration: none;
            border: 1px solid #e74c3c;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 11px;
        }

        .btn-logout {
            background: #B30000;
            color: white;
            padding: 15px;
            text-align: center;
            text-decoration: none;
            margin-top: auto;
            font-weight: bold;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <img src="logo_tec.png" class="logo-tec">
        <a href="admin.php" class="nav-link active">Dashboard</a>
        <a href="registrar.php" class="nav-link">Insertar Alumno</a>
        <a href="vista_clubes.php" class="nav-link">Vista de Clubes</a>
        <a href="../backend/logout.php" class="btn-logout">Cerrar Sesión</a>
    </div>
    <div class="main-content">
        <h1>Gestión de Clubes</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>MATRÍCULA</th>
                        <th>NOMBRE DEL ALUMNO</th>
                        <th>CARRERA</th>
                        <th>CLUB</th>
                        <th>ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($res)): ?>
                        <tr>
                            <td class="m-text"><?= $row['matricula'] ?></td>
                            <td><?= $row['nombre'] ?> <?= $row['apellidos'] ?></td>
                            <td><?= $row['carrera'] ?></td>
                            <td><?= $row['nombre_club'] ?></td>
                            <td>
                                <a href="editar_alumno.php?id=<?= $row['id'] ?>" class="btn-edit">EDITAR</a>
                                <a href="../backend/eliminar_alumno.php?id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('¿Eliminar?')">ELIMINAR</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>