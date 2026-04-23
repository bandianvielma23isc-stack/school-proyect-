<?php
session_start();
include 'conexion.php';

// Seguridad: Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Lógica de Búsqueda Flexible
$busqueda = isset($_GET['buscar']) ? mysqli_real_escape_string($conn, $_GET['buscar']) : "";

$query = "SELECT a.*, c.nombre_club FROM alumnos a 
          JOIN clubes c ON a.club_id = c.id";

if ($busqueda != "") {
    $query .= " WHERE a.nombre LIKE '%$busqueda%' 
                OR a.apellidos LIKE '%$busqueda%' 
                OR a.matricula LIKE '%$busqueda%' 
                OR c.nombre_club LIKE '%$busqueda%'";
}

$res = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - TEC San Pedro</title>
    <style>
        /* Paleta de Colores Oscura Para mejorar el aura del Dashboard */
        :root {
            --negro-fondo: #121212;
            --negro-panel: #1e1e1e;
            --rojo: #B30000;
            --rojo-hover: #e60000;
            --texto-gris: #b3b3b3;
            --blanco: #ffffff;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            display: flex;
            background: var(--negro-fondo);
            color: var(--blanco);
        }

        /* Sidebar Estilo Negro */
        .sidebar {
            width: 260px;
            background: var(--negro-panel);
            height: 100vh;
            position: fixed;
            border-right: 1px solid #333;
        }

        .logo-container {
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #333;
        }

        .logo-container img {
            width: 140px;
        }

        .sidebar-menu {
            padding-top: 20px;
        }

        .sidebar-menu a {
            display: block;
            color: var(--texto-gris);
            padding: 15px 30px;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .sidebar-menu a:hover {
            color: var(--blanco);
            background: #252525;
            border-left: 5px solid var(--rojo);
        }

        /* Botón Cerrar Sesión Especial */
        .logout-btn {
            background: var(--rojo);
            color: white !important;
            margin: 40px 20px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
        }

        .logout-btn:hover {
            background: var(--rojo-hover) !important;
            box-shadow: 0 0 15px rgba(179, 0, 0, 0.4);
        }

        /* Contenido */
        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 40px;
        }

        /* Buscador */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .search-container {
            background: var(--negro-panel);
            padding: 5px 20px;
            border-radius: 30px;
            display: flex;
            align-items: center;
            border: 1px solid #444;
        }

        .search-container input {
            background: transparent;
            border: none;
            color: white;
            padding: 10px;
            width: 300px;
            outline: none;
        }

        .search-container button {
            background: none;
            border: none;
            color: var(--rojo);
            cursor: pointer;
            font-weight: bold;
        }

        /* Tabla Estilo Dark */
        .table-card {
            background: var(--negro-panel);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #252525;
            color: var(--rojo);
            text-align: left;
            padding: 18px;
            font-size: 13px;
            text-transform: uppercase;
            border-bottom: 1px solid #333;
        }

        td {
            padding: 15px 18px;
            border-bottom: 1px solid #333;
            font-size: 14px;
            color: #e0e0e0;
        }

        tr:hover {
            background: #2a2a2a;
        }

        /* Acciones */
        .action-link {
            text-decoration: none;
            font-size: 12px;
            padding: 5px 10px;
            border-radius: 4px;
            margin-right: 5px;
            font-weight: bold;
        }

        .edit {
            color: #3498db;
            border: 1px solid #3498db;
        }

        .delete {
            color: #e74c3c;
            border: 1px solid #e74c3c;
        }

        .edit:hover {
            background: #3498db;
            color: white;
        }

        .delete:hover {
            background: #e74c3c;
            color: white;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            body {
                flex-direction: column;
            }

            .main {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <div class="logo-container">
            <img src="logo_tec.png" alt="Logo TEC">
        </div>
        <div class="sidebar-menu">
            <a href="admin.php">Dashboard</a>
            <a href="registrar.php">Insertar Alumno</a>
            <a href="vista_clubes.php">Vista de Clubes</a>
            <a href="logout.php" class="logout-btn">CERRAR SESION</a>
        </div>
    </div>

    <div class="main">
        <div class="header">
            <h1>Panel de Control Administrador</h1>
            <form action="admin.php" method="GET" class="search-container">
                <input type="text" name="buscar" placeholder="Buscar por nombre, matrícula o club..." value="<?= htmlspecialchars($busqueda) ?>">
                <button type="submit">BUSCAR</button>
            </form>
        </div>

        <div class="table-card">
            <table>
                <thead>
                    <tr>
                        <th>Matrícula</th>
                        <th>Nombre del Alumno</th>
                        <th>Carrera</th>
                        <th>Club</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($res) > 0): ?>
                        <?php while ($r = mysqli_fetch_array($res)): ?>
                            <tr>
                                <td style="color: var(--rojo); font-weight: bold;"><?= $r['matricula'] ?></td>
                                <td><?= $r['nombre'] . " " . $r['apellidos'] ?></td>
                                <td><?= $r['carrera'] ?></td>
                                <td><?= $r['nombre_club'] ?></td>
                                <td>
                                    <a href="editar_alumno.php?id=<?= $r['id'] ?>" class="action-link edit">EDITAR</a>
                                    <a href="eliminar_alumno.php?id=<?= $r['id'] ?>" class="action-link delete" onclick="return confirm('¿Seguro que deseas eliminar este registro?')">ELIMINAR</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 40px; color: #666;">No se encontraron registros en la búsqueda.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>