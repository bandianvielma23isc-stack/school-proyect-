<?php
session_start();
include '../config/conexion.php';

// Solo admin puede entrar, si es alumno lo manda a su login
if (!isset($_SESSION['admin_auth'])) {
    // Si hay sesión de alumno, destruirla antes de pedir login de admin
    if (isset($_SESSION['alumno_matricula'])) {
        session_destroy();
    }
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
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>

    <?php $activePage = 'admin'; include '../templates/sidebar.php'; ?>

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
                                <a href="../src/eliminar_alumno.php?id=<?= $row['id'] ?>" class="btn-delete"
                                    onclick="return confirm('¿Eliminar este alumno?')">ELIMINAR</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>