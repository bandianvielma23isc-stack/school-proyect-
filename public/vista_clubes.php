<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include '../config/conexion.php';

if (!isset($_SESSION['admin_auth'])) {
    if (isset($_SESSION['alumno_matricula'])) session_destroy();
    header("Location: login.php");
    exit();
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

$res_clubes = mysqli_query($conn, "SELECT c.id, c.nombre_club, COUNT(a.id) as inscritos 
                                    FROM clubes c 
                                    LEFT JOIN alumnos a ON c.id = a.club_id 
                                    GROUP BY c.id");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vista de Clubes - Administrador</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/vista_clubes.css">
</head>
<body>
    <script>
    window.history.pushState(null, null, window.location.href);
    window.addEventListener('popstate', function() {
        window.history.pushState(null, null, window.location.href);
    });
</script>

    <?php $activePage = 'clubes'; include '../templates/sidebar.php'; ?>

    <div class="main-content">
        <h1>Clubes TEC</h1>
        <div class="club-grid">
            <?php while ($c = mysqli_fetch_array($res_clubes)):
                $id_club = $c['id'];
                $nom_raw = strtoupper($c['nombre_club']);
                $maestro = $maestros[$c['nombre_club']] ?? 'Por asignar';
                $al_q = mysqli_query($conn, "SELECT nombre, apellidos, matricula 
                                             FROM alumnos WHERE club_id = '$id_club'");
            ?>
                <div class="card-club" onclick="this.querySelector('.student-list').classList.toggle('show')">
                    <div class="card-header-red">
                        <div>
                            <h2 class="club-name"><?= $nom_raw ?></h2>
                            <small class="maestro-nombre"> <?= $maestro ?></small>
                        </div>
                        <span><?= $c['inscritos'] ?> INSCRITOS</span>
                    </div>
                    <div class="card-body">
                        <small>▼ Ver alumnos inscritos</small>
                    </div>
                    <div class="student-list">
                        <?php if (mysqli_num_rows($al_q) === 0): ?>
                            <div class="student-row" style="color:#555; font-style:italic;">
                                Sin alumnos inscritos
                            </div>
                        <?php else: ?>
                            <?php while ($al = mysqli_fetch_array($al_q)): ?>
                                <div class="student-row">
                                    <span class="col-mat"><?= $al['matricula'] ?></span>
                                    <span style="flex:1"><?= $al['nombre'] ?> <?= $al['apellidos'] ?></span>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <script>
    window.addEventListener('pageshow', function(e) {
        if (e.persisted) {
            window.location.reload();
        }
    });
</script>

</body>
</html>