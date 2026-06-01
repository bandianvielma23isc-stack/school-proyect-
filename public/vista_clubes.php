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

$columna_visible = mysqli_query($conn, "SHOW COLUMNS FROM alumnos LIKE 'matricula_visible'");
$campo_matricula_visible = ($columna_visible && mysqli_num_rows($columna_visible) > 0)
    ? "matricula_visible"
    : "NULL AS matricula_visible";

$res_clubes = mysqli_query($conn, "SELECT c.id, c.nombre_club, COUNT(a.id) as inscritos,
                                    (
                                        SELECT CONCAT(m.nombre, ' ', m.apellidos)
                                        FROM maestros m
                                        WHERE m.club_id = c.id
                                        ORDER BY m.id DESC
                                        LIMIT 1
                                    ) AS maestro
                                    FROM clubes c
                                    LEFT JOIN alumnos a ON c.id = a.club_id
                                    GROUP BY c.id, c.nombre_club");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vista de Clubes - Administrador</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link rel="stylesheet" href="assets/css/vista_clubes.css?v=2">
    
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
                $maestro = !empty($c['maestro']) ? $c['maestro'] : 'Por asignar';
                $al_q = mysqli_query($conn, "SELECT id, nombre, apellidos, matricula, $campo_matricula_visible
                                             FROM alumnos WHERE club_id = '$id_club'");
            ?>
                <div class="card-club">
                    <div class="card-header-red">
                        <div>
                            <h2 class="club-name"><?= $nom_raw ?></h2>
                            <small class="maestro-nombre"> <?= htmlspecialchars($maestro) ?></small>
                        </div>
                        <span><?= $c['inscritos'] ?> INSCRITOS</span>
                    </div>
                    <div class="card-body" onclick="this.nextElementSibling.classList.toggle('show')">
                        <small>&#9660; Ver alumnos inscritos</small>
                    </div>
                    <div class="student-list">
                        <?php if (mysqli_num_rows($al_q) === 0): ?>
                            <div class="student-row" style="color:#555; font-style:italic;">
                                Sin alumnos inscritos
                            </div>
                        <?php else: ?>
                            <?php while ($al = mysqli_fetch_array($al_q)): ?>
                                <?php
                                    $matricula = !empty($al['matricula_visible'])
                                        ? $al['matricula_visible']
                                        : ((strpos($al['matricula'], '$2y$') === 0)
                                            ? "221000" . str_pad($al['id'], 4, "0", STR_PAD_LEFT)
                                            : $al['matricula']);
                                    $nombre_alumno = trim($al['nombre'] . ' ' . $al['apellidos']);
                                ?>
                                <div class="student-row">
                                    <span class="col-mat"><?= htmlspecialchars($matricula) ?></span>
                                    <span style="flex:1"><?= htmlspecialchars($nombre_alumno) ?></span>
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
