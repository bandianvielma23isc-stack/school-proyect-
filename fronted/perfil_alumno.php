<?php
session_start();
include '../backend/conexion.php';

if (!isset($_SESSION['alumno_matricula'])) {
    header("Location: login_alumno.php");
    exit();
}

$matricula = $_SESSION['alumno_matricula'];

// Consulta usando los nombres exactos de tu tabla
$query = "SELECT a.*, c.nombre_club FROM alumnos a 
          JOIN clubes c ON a.club_id = c.id 
          WHERE a.matricula = '$matricula'";
$res = mysqli_query($conn, $query);
$datos = mysqli_fetch_array($res);

// Generar Iniciales LA
$nombres = explode(" ", $datos['nombre']);
$iniciales = strtoupper(substr($nombres[0], 0, 1) . (isset($nombres[1]) ? substr($nombres[1], 0, 1) : ""));

$club_id = $datos['club_id'];

// Compañeros del mismo club
$res_comp = mysqli_query($conn, "SELECT nombre, apellidos, carrera FROM alumnos 
                                 WHERE club_id = '$club_id' AND matricula != '$matricula'");

$maestros = ['Norteño' => 'Lic. Javier Solís', 'Ajedrez' => 'Ing. Alicia Méndez', 'Fútbol' => 'Coach Fernando Hierro', 'Danza' => 'Lic. Carmen Vega'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Perfil - TEC San Pedro</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .dashboard {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 25px;
            max-width: 1100px;
            width: 100%;
        }

        .card-user {
            background: white;
            border-radius: 20px;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #B30000;
        }

        .circle-avatar {
            width: 100px;
            height: 100px;
            background: #B30000;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            font-weight: bold;
            margin: 0 auto 20px;
        }

        .club-banner {
            background: #B30000;
            color: white;
            border-radius: 20px;
            padding: 30px 40px;
            margin-bottom: 25px;
            box-shadow: 0 10px 20px rgba(179, 0, 0, 0.2);
        }

        .team-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border-top: 5px solid #B30000;
        }

        .team-table {
            width: 100%;
            border-collapse: collapse;
        }

        .team-table th {
            text-align: left;
            padding: 12px;
            border-bottom: 2px solid #f0f0f0;
        }

        .team-table td {
            padding: 15px 12px;
            border-bottom: 1px solid #f8f8f8;
            color: #555;
        }

        .logout {
            color: #B30000;
            text-decoration: none;
            font-weight: bold;
            display: block;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
    </style>
</head>

<body>
    <div class="dashboard">
        <div class="card-user">
            <div class="circle-avatar"><?= $iniciales ?></div>
            <h2><?= $datos['nombre'] ?></h2>
            <p><strong>Matrícula:</strong> <?= $datos['matricula'] ?></p>
            <p><strong>Carrera:</strong> <?= $datos['carrera'] ?></p>
            <a href="../backend/logout.php" class="logout">Cerrar Sesión</a>
        </div>
        <div>
            <div class="club-banner">
                <h1>Club: <?= $datos['nombre_club'] ?></h1>
                <p>Maestro Encargado: <strong><?= $maestros[$datos['nombre_club']] ?? 'Por asignar' ?></strong></p>
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
                        <?php while ($c = mysqli_fetch_array($res_comp)): ?>
                            <tr>
                                <td><?= $c['nombre'] ?> <?= $c['apellidos'] ?></td>
                                <td><?= $c['carrera'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>