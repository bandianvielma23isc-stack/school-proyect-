<?php
session_start();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

include '../config/conexion.php';

if (!isset($_SESSION['alumno_id'])) {
    if (isset($_SESSION['admin_auth'])) {
        session_destroy();
    }
    header("Location: login_alumno.php");
    exit();
}

$alumno_id = $_SESSION['alumno_id'];

$query = "SELECT a.*, c.nombre_club FROM alumnos a 
          LEFT JOIN clubes c ON a.club_id = c.id 
          WHERE a.id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $alumno_id);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$datos = mysqli_fetch_array($res);

if (!$datos) {
    header("Location: login_alumno.php");
    exit();
}

$nombres   = explode(" ", trim($datos['nombre']));
$iniciales = strtoupper(substr($nombres[0], 0, 1) . (isset($nombres[1]) && !empty($nombres[1]) ? substr($nombres[1], 0, 1) : ""));
$club_id   = $datos['club_id'] ?? 0;
$nombre_club_actual = $datos['nombre_club'] ?? 'Ninguno';

$res_comp = false;
if ($club_id > 0) {
    $query_comp = "SELECT nombre, carrera FROM alumnos WHERE club_id = ? AND id != ?";
    $stmt_comp = mysqli_prepare($conn, $query_comp);
    mysqli_stmt_bind_param($stmt_comp, "ii", $club_id, $alumno_id);
    mysqli_stmt_execute($stmt_comp);
    $res_comp = mysqli_stmt_get_result($stmt_comp);
}

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
$maestro = $maestros[$nombre_club_actual] ?? 'Por asignar';
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
        window.history.pushState(null, null, window.location.href);
        window.addEventListener('popstate', function() {
            window.history.pushState(null, null, window.location.href);
        });
    </script>

    <div class="dashboard">
        <div class="card-user">
            <div class="circle-avatar" id="avatarBtn" style="cursor:pointer;" title="Cerrar Sesión">
                <?= htmlspecialchars($iniciales) ?>
            </div>
            <h2><?= htmlspecialchars($datos['nombre']) ?></h2>
            
            <p><strong>Matrícula:</strong> <?= htmlspecialchars($_SESSION['alumno_matricula_limpia'] ?? '2210002541') ?></p>
            
            <p><strong>Carrera:</strong> <?= htmlspecialchars($datos['carrera'] ?? 'No asignada') ?></p>
            <a href="../src/logout.php" class="logout">Cerrar Sesión</a>
        </div>
        <div>
            <div class="club-banner">
                <h1>Club: <?= htmlspecialchars($nombre_club_actual) ?></h1>
                <p>Maestro Encargado: <strong><?= htmlspecialchars($maestro) ?></strong></p>
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
                        <?php if ($res_comp && mysqli_num_rows($res_comp) > 0): ?>
                            <?php while ($c = mysqli_fetch_array($res_comp)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                                    <td><?= htmlspecialchars($c['carrera'] ?? 'Sistemas Computacionales') ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" style="text-align: center; color: #888;">No tienes compañeros asignados en este club todavía.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // SweetAlert para cerrar sesión
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

        window.addEventListener('pageshow', function (event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                window.location.href = "../src/logout.php";
            }
        });
    </script>
</body>
</html>