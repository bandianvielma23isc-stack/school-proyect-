<?php
session_start();
include '../backend/conexion.php';

if (!isset($_SESSION['alumno_matricula'])) {
    header("Location: login_alumno.php");
    exit();
}

$matricula = $_SESSION['alumno_matricula'];

// Consulta de datos del alumno y su club
$query = "SELECT a.*, c.nombre_club FROM alumnos a 
          JOIN clubes c ON a.club_id = c.id 
          WHERE a.matricula = '$matricula'";
$res = mysqli_query($conn, $query);
$datos = mysqli_fetch_array($res);

// Obtener iniciales para el círculo rojo (ej. Luis Alejandro -> LA)
$nombres = explode(" ", $datos['nombre']);
$iniciales = strtoupper(substr($nombres[0], 0, 1) . (isset($nombres[1]) ? substr($nombres[1], 0, 1) : ""));

$club_id = $datos['club_id'];
$nombre_club = $datos['nombre_club'];

// Compañeros del mismo club (excluyendo al alumno actual)
$res_comp = mysqli_query($conn, "SELECT nombre, apellidos, carrera FROM alumnos WHERE club_id = '$club_id' AND matricula != '$matricula'");

// Instructor
$maestros = [
    'Norteño' => 'Lic. Javier Solís',
    'Tiro con Arco' => 'Prof. Roberto Sierra',
    'Ajedrez' => 'Ing. Alicia Méndez',
    'Fútbol' => 'Coach Fernando Hierro',
    'Rondalla' => 'Profa. Elena Ríos',
    'Danza' => 'Lic. Carmen Vega'
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Alumno - Club Manager</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .dashboard-container {
            display: grid;
            grid-template-columns: 320px 1fr;
            grid-template-rows: auto 1fr;
            gap: 25px;
            max-width: 1100px;
            width: 100%;
        }

        /* Tarjeta de Perfil (Izquierda) */
        .profile-card {
            grid-row: span 2;
            background: white;
            border-radius: 20px;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #B30000;
        }

        .avatar-circle {
            width: 100px;
            height: 100px;
            background-color: #B30000;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            font-weight: bold;
            margin: 0 auto 20px;
        }

        .profile-card h2 {
            margin: 10px 0;
            font-size: 22px;
            color: #1a1a1a;
        }

        .profile-card p {
            margin: 5px 0;
            color: #666;
            font-size: 14px;
        }

        .profile-card .divider {
            border-top: 1px solid #eee;
            margin: 20px 0;
        }

        .logout-link {
            color: #B30000;
            text-decoration: none;
            font-weight: bold;
            font-size: 15px;
        }

        /* Banner del Club (Derecha Superior) */
        .club-banner {
            background-color: #B30000;
            color: white;
            border-radius: 20px;
            padding: 30px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            box-shadow: 0 10px 20px rgba(179, 0, 0, 0.2);
        }

        .club-banner h1 {
            margin: 0;
            font-size: 32px;
        }

        .club-banner p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 16px;
        }

        /* Tarjeta de Compañeros (Derecha Inferior) */
        .team-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #B30000;
        }

        .team-card h3 {
            margin-top: 0;
            margin-bottom: 25px;
            color: #1a1a1a;
        }

        .team-table {
            width: 100%;
            border-collapse: collapse;
        }

        .team-table th {
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #f0f0f0;
            color: #333;
            font-size: 14px;
        }

        .team-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #f8f8f8;
            color: #555;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="dashboard-container">
        <div class="profile-card">
            <div class="avatar-circle"><?= $iniciales ?></div>
            <h2><?= $datos['nombre'] ?></h2>
            <p><strong>Matrícula:</strong> <?= $datos['matricula'] ?></p>
            <p><strong>Carrera:</strong> <?= $datos['carrera'] ?></p>
            <div class="divider"></div>
            <a href="../backend/logout.php" class="logout-link">Cerrar Sesión</a>
        </div>

        <div class="club-banner">
            <h1>Club: <?= $nombre_club ?></h1>
            <p>Maestro Encargado: <strong><?= $maestros[$nombre_club] ?? 'Por asignar' ?></strong></p>
        </div>

        <div class="team-card">
            <h3>Mis Compañeros</h3>
            <table class="team-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Carrera</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($res_comp) > 0):
                        while ($comp = mysqli_fetch_array($res_comp)): ?>
                            <tr>
                                <td><?= $comp['nombre'] ?> <?= $comp['apellidos'] ?></td>
                                <td><?= $comp['carrera'] ?></td>
                            </tr>
                        <?php endwhile;
                    else: ?>
                        <tr>
                            <td colspan="2" style="text-align: center; color: #999;">No hay compañeros registrados aún.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>