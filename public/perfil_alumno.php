<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include '../config/conexion.php';

if (!isset($_SESSION['alumno_matricula'])) {
    if (isset($_SESSION['admin_auth'])) session_destroy();
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
    'Norteño'       => 'Lic. Javier Solís',
    'Ajedrez'       => 'Ing. Alicia Méndez',
    'Fútbol'        => 'Coach Fernando Hierro',
    'Danza'         => 'Lic. Carmen Vega',
    'Tiro con Arco' => 'Lic. Roberto Garza',
    'Rondalla'      => 'Mtro. Héctor Luna',
    'Basketball'    => 'Coach Daniela Reyes',
    'Voleiball'     => 'Lic. Patricia Morales'
];
$maestro = $maestros[$datos['nombre_club']] ?? 'Por asignar';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - TEC San Pedro</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/perfil_alumno.css">
</head>
<body>
    <script>
    // Evitar regreso con botón atrás después de cerrar sesión
    window.history.pushState(null, null, window.location.href);
    window.addEventListener('popstate', function() {
        window.history.pushState(null, null, window.location.href);
    });
</script>
    <div class="dashboard">
        <div class="card-user">
            <div class="circle-avatar" id="avatarBtn" style="cursor:pointer;" title="Volver al inicio">
                <?= $iniciales ?>
            </div>
            <h2><?= $datos['nombre'] ?> <?= $datos['apellidos'] ?></h2>
            <p><strong>Matrícula:</strong> <?= $datos['matricula'] ?></p>
            <p><strong>Carrera:</strong> <?= $datos['carrera'] ?></p>
            <a href="../src/logout.php" class="logout">Cerrar Sesión</a>
        </div>
        <div>
            <div class="club-banner">
                <h1>Club: <?= $datos['nombre_club'] ?></h1>
                <p>Maestro Encargado: <strong><?= $maestro ?></strong></p>
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

    <script>
        document.getElementById('avatarBtn').addEventListener('click', function() {
            Swal.fire({
                title: '¿Cerrar sesión?',
                text: 'Se cerrará tu sesión y volverás al inicio.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#B30000',
                cancelButtonColor: '#555',
                confirmButtonText: 'Sí, salir',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../src/logout.php';
                }
            });
        });
    </script>
    <script>
    // Si la página se carga desde caché sin sesión, redirigir
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            window.location.reload();
        }
    });
</script>
</body>
</html>