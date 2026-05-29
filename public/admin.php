<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include '../config/conexion.php';

if (!isset($_SESSION['admin_auth'])) {
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
    <style>
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .admin-header h1 {
            margin: 0;
        }
        .search-container input {
            background-color: #1a1a1a;
            color: #fff;
            border: 1px solid #B30000; /* Rojo TEC San Pedro */
            padding: 10px 15px;
            border-radius: 5px;
            width: 250px;
            outline: none;
            transition: all 0.3s ease;
        }
        .search-container input:focus {
            border-color: #fff;
            box-shadow: 0 0 5px rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <script>
    window.history.pushState(null, null, window.location.href);
    window.addEventListener('popstate', function() {
        window.history.pushState(null, null, window.location.href);
    });
    </script>

    <?php $activePage = 'admin'; include '../templates/sidebar.php'; ?>

    <div class="main-content">
        <div class="admin-header">
            <h1>Gestión de Clubes</h1>
            <div class="search-container">
                <input type="text" id="adminSearch" placeholder="Buscar alumno por nombre...">
            </div>
        </div>

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
                <tbody id="tablaAlumnos">
                    <?php while ($row = mysqli_fetch_array($res)): ?>
                        <tr>
                            <td class="m-text"><?= htmlspecialchars($row['matricula']) ?></td>
                            <td class="alumno-nombre"><?= htmlspecialchars($row['nombre']) ?></td>
                            <td><?= htmlspecialchars($row['carrera']) ?></td>
                            <td><?= htmlspecialchars($row['nombre_club']) ?></td>
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

    <script>
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            window.location.reload();
        }
    });

    document.getElementById('adminSearch').addEventListener('keyup', function() {
        let filtro = this.value.toLowerCase().trim();
        let filas = document.querySelectorAll('#tablaAlumnos tr');

        filas.forEach(function(fila) {
            let columnaNombre = fila.querySelector('.alumno-nombre');
            
            if (columnaNombre) {
                let nombreTexto = columnaNombre.textContent.toLowerCase();
                
                if (nombreTexto.includes(filtro)) {
                    fila.style.display = ''; 
                } else {
                    fila.style.display = 'none'; 
                }
            }
        });
    });
    </script>
</body>
</html>