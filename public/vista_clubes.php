<?php
session_start();
include '../config/conexion.php';

if (!isset($_SESSION['admin_auth'])) {
    if (isset($_SESSION['alumno_matricula'])) {
        session_destroy();
    }
    header("Location: login.php");
    exit();
}

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

    <?php $activePage = 'clubes'; include '../templates/sidebar.php'; ?>

    <div class="main-content">
        <h1>Clubes TEC</h1>
        <div class="club-grid">
            <?php while ($c = mysqli_fetch_array($res_clubes)):
                $id_club = $c['id'];
                $nom_raw = strtoupper($c['nombre_club']);
                $al_q = mysqli_query($conn, "SELECT nombre, apellidos, matricula 
                                             FROM alumnos WHERE club_id = '$id_club'");
            ?>
                <div class="card-club" onclick="this.querySelector('.student-list').classList.toggle('show')">
                    <div class="card-header-red">
                        <h2 class="club-name"><?= $nom_raw ?></h2>
                        <span><?= $c['inscritos'] ?> INSCRITOS</span>
                    </div>
                    <div class="card-body">
                        <small>Taller deportivo/cultural</small>
                    </div>
                    <div class="student-list">
                        <?php while ($al = mysqli_fetch_array($al_q)): ?>
                            <div class="student-row">
                                <span class="col-mat"><?= $al['matricula'] ?></span>
                                <span><?= $al['nombre'] ?> <?= $al['apellidos'] ?></span>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>
</html>