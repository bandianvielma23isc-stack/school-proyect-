<?php
session_start();
include '../backend/conexion.php';
if (!isset($_SESSION['admin_auth'])) {
    header("Location: login.php");
    exit();
}
$res_clubes = mysqli_query($conn, "SELECT c.id, c.nombre_club, COUNT(a.id) as inscritos FROM clubes c LEFT JOIN alumnos a ON c.id = a.club_id GROUP BY c.id");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Vista de Clubes - Administrador</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #0c0c0c;
            color: #fff;
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            width: 250px;
            background-color: #141414;
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            border-right: 2px solid #222;
            flex-shrink: 0;
        }

        .logo-tec {
            width: 140px;
            margin-bottom: 40px;
            align-self: center;
        }

        .nav-link {
            color: #888;
            text-decoration: none;
            padding: 15px;
            margin-bottom: 5px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
            display: block;
            border-left: 4px solid transparent;
            transition: 0.3s;
        }

        .active {
            background: #333 !important;
            color: white !important;
            border-left: 4px solid #B30000 !important;
        }

        .btn-logout {
            background: #B30000;
            color: white;
            padding: 15px;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            margin-top: auto;
            font-weight: bold;
            text-transform: uppercase;
        }

        .main-content {
            flex: 1;
            padding: 40px;
            overflow-y: auto;
        }

        h1 {
            font-size: 28px;
            border-left: 6px solid #B30000;
            padding-left: 20px;
            margin-bottom: 40px;
            text-transform: uppercase;
        }

        .club-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 25px;
        }

        .card-club {
            background: #181818;
            border: 1px solid #222;
            cursor: pointer;
            transition: 0.3s;
        }

        .card-header-red {
            background: #B30000;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .club-name {
            margin: 0;
            font-size: 18px;
            color: #fff;
            font-weight: bold;
            text-transform: uppercase;
        }

        .card-body {
            padding: 25px;
        }

        .student-list {
            display: none;
            background: #111;
            border-top: 1px solid #222;
        }

        .show {
            display: block;
        }

        .student-row {
            display: flex;
            padding: 10px 25px;
            font-size: 13px;
            border-bottom: 1px solid #1a1a1a;
        }

        .col-mat {
            color: #B30000;
            font-weight: bold;
            width: 120px;
            font-family: monospace;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <img src="logo_tec.png" class="logo-tec">
        <a href="admin.php" class="nav-link">Dashboard</a>
        <a href="registrar.php" class="nav-link">Insertar Alumno</a>
        <a href="vista_clubes.php" class="nav-link active">Vista de Clubes</a>
        <a href="../backend/logout.php" class="btn-logout">Cerrar Sesión</a>
    </div>
    <div class="main-content">
        <h1>Clubes TEC</h1>
        <div class="club-grid">
            <?php while ($c = mysqli_fetch_array($res_clubes)):
                $id_club = $c['id'];
                $nom_raw = strtoupper($c['nombre_club']);
                $al_q = mysqli_query($conn, "SELECT nombre, apellidos, matricula, carrera FROM alumnos WHERE club_id = '$id_club'");
            ?>
                <div class="card-club" onclick="this.querySelector('.student-list').classList.toggle('show')">
                    <div class="card-header-red">
                        <h2 class="club-name"><?= $nom_raw ?></h2><span style="font-size:12px;"><?= $c['inscritos'] ?> INSCRITOS</span>
                    </div>
                    <div class="card-body">
                        <small style="color:#888; font-weight:bold;">Taller deportivo/cultural</small>
                    </div>
                    <div class="student-list">
                        <?php while ($al = mysqli_fetch_array($al_q)): ?>
                            <div class="student-row"><span class="col-mat"><?= $al['matricula'] ?></span><span style="flex:1;"><?= $al['nombre'] ?></span></div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>

</html>