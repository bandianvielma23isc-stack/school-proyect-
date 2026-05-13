<?php
session_start();
include '../config/conexion.php';

// Solo alumno logueado puede entrar
if (!isset($_SESSION['alumno_matricula'])) {
    // Si hay sesión de admin, destruirla antes de pedir login de alumno
    if (isset($_SESSION['admin_auth'])) {
        session_destroy();
    }
    header("Location: login_alumno.php");
    exit();
}

$matricula = $_SESSION['alumno_matricula'];
$query     = "SELECT a.*, c.nombre_club FROM alumnos a 
              JOIN clubes c ON a.club_id = c.id 
              WHERE a.matricula = '$matricula'";
$res       = mysqli_query($conn, $query);
$datos     = mysqli_fetch_array($res);

$nombres   = explode(" ", $datos['nombre']);
$iniciales = strtoupper(substr($nombres[0], 0, 1) . (isset($nombres[1]) ? substr($nombres[1], 0, 1) : ""));
$club_id   = $datos['club_id'];

$res_comp = mysqli_query($conn, "SELECT nombre, apellidos, carrera FROM alumnos 
                                 WHERE club_id = '$club_id' AND matricula != '$matricula'");

$maestros = [
    'Norteño' => 'Lic. Javier Solís',
    'Ajedrez' => 'Ing. Alicia Méndez',
    'Fútbol'  => 'Coach Fernando Hierro',
    'Danza'   => 'Lic. Carmen Vega'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil - TEC San Pedro</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/perfil_alumno.css">
</head>
<body>
    <div class="dashboard">
        <div class="card-user">
            <div class="circle-avatar"><?= $iniciales ?></div>
            <h2><?= $datos['nombre'] ?> <?= $datos['apellidos'] ?></h2>
            <p><strong>Matrícula:</strong> <?= $datos['matricula'] ?></p>
            <p><strong>Carrera:</strong> <?= $datos['carrera'] ?></p>
            <a href="../src/logout.php" class="logout">Cerrar Sesión</a>
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