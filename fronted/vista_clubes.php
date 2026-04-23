<?php
session_start();
include 'conexion.php';

// Seguridad: Solo admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Descripciones de los clubes
$descripciones = [
    'Tiro con Arco' => 'Disciplina y precisión. Enfocado en la técnica de tiro olímpico y control mental.',
    'Ajedrez' => 'Estrategia y lógica. Espacio para desarrollar el pensamiento crítico y táctico.',
    'Norteño' => 'Preservación de música regional. Ensayo de instrumentos tradicionales y ensamble.',
    'Fútbol' => 'Trabajo en equipo y condición física. Entrenamientos tácticos y torneos internos.',
    'Rondalla' => 'Expresión romántica y armonía vocal. Especializado en cuerdas y coros.',
    'Danza' => 'Arte en movimiento. Práctica de baile folclórico y contemporáneo representativo.',
    'Basketball' => 'Agilidad y estrategia en la duela. Desarrollo de fundamentos y competencia.',
    'Voleiball' => 'Coordinación y dinamismo. Técnica de saque, boleo y juego en conjunto.'
];

// Maestros encargados en cada club
$maestros = [
    'Tiro con Arco' => 'Prof. Roberto Sierra',
    'Ajedrez' => 'Ing. Alicia Méndez',
    'Norteño' => 'Lic. Javier Solís',
    'Fútbol' => 'Coach Fernando Hierro',
    'Rondalla' => 'Profa. Elena Ríos',
    'Danza' => 'Lic. Carmen Vega',
    'Basketball' => 'Prof. Saúl Castro',
    'Voleiball' => 'Dra. Mónica Parga'
];

// Consulta principal
$query = "SELECT c.id, c.nombre_club, COUNT(a.id) as total_alumnos 
          FROM clubes c 
          LEFT JOIN alumnos a ON c.id = a.club_id 
          GROUP BY c.id";
$res = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estatus de Clubes - TEC San Pedro</title>
    <style>
        :root {
            --negro-fondo: #121212;
            --negro-panel: #1e1e1e;
            --rojo: #B30000;
            --blanco: #ffffff;
            --texto-gris: #b3b3b3;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            display: flex;
            background: var(--negro-fondo);
            color: var(--blanco);
            min-height: 100vh;
        }

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
            width: 130px;
        }

        .sidebar-menu a {
            display: block;
            color: var(--texto-gris);
            padding: 15px 30px;
            text-decoration: none;
            transition: 0.3s;
        }

        .sidebar-menu a:hover {
            color: white;
            background: #252525;
            border-left: 5px solid var(--rojo);
        }

        .logout-btn {
            background: var(--rojo);
            color: white !important;
            margin: 40px 20px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
        }

        .main {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 40px;
            box-sizing: border-box;
        }

        .club-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .club-card {
            background: var(--negro-panel);
            border-radius: 15px;
            padding: 20px;
            border-left: 6px solid var(--rojo);
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }

        .club-card:hover {
            background: #252525;
            transform: translateY(-5px);
        }

        .info-extra {
            display: none;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #333;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .count-badge {
            background: rgba(179, 0, 0, 0.2);
            color: var(--rojo);
            padding: 5px 12px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 13px;
            border: 1px solid var(--rojo);
        }

        .student-list {
            list-style: none;
            padding: 0;
            margin-top: 10px;
        }

        .student-list li {
            padding: 8px 0;
            border-bottom: 1px solid #2a2a2a;
            font-size: 14px;
            color: #ddd;
        }

        .carrera-text {
            color: #888;
            font-style: italic;
            font-size: 12px;
            margin-left: 5px;
        }

        .matricula-text {
            color: var(--rojo);
            font-weight: bold;
            font-size: 12px;
            margin-left: 10px;
            opacity: 0.8;
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
        <div class="logo-container"><img src="logo_tec.png" alt="Logo"></div>
        <div class="sidebar-menu">
            <a href="admin.php">Dashboard</a>
            <a href="registrar.php">Insertar Alumno</a>
            <a href="vista_clubes.php" style="color:white; background:#252525; border-left:5px solid var(--rojo);">Vista de Clubes</a>
            <a href="logout.php" class="logout-btn">CERRAR SESIÓN</a>
        </div>
    </div>

    <div class="main">
        <h1>Estatus de Clubes</h1>
        <div class="club-grid">
            <?php while ($c = mysqli_fetch_array($res)):
                $cid = $c['id'];
                $nom = $c['nombre_club'];
            ?>
                <div class="club-card" onclick="toggleClub(<?= $cid ?>)">
                    <div style="display:flex; justify-content:space-between; align-items:center;">
                        <h3 style="margin:0;"><?= $nom ?></h3>
                        <span class="count-badge"><?= $c['total_alumnos'] ?> Alumnos</span>
                    </div>
                    <p style="font-size:14px; color:var(--texto-gris); margin: 10px 0;">Encargado: <strong><?= $maestros[$nom] ?></strong></p>

                    <div id="extra-<?= $cid ?>" class="info-extra">
                        <p style="font-size:14px; color: #ccc; margin-bottom: 15px;"><i>"<?= $descripciones[$nom] ?>"</i></p>

                        <h4 style="color:var(--rojo); margin-bottom:10px;">Lista de Alumnos:</h4>
                        <ul class="student-list">
                            <?php
                            // Ahora pedimos nombre, apellidos, carrera y MATRICULA
                            $alum = mysqli_query($conn, "SELECT nombre, apellidos, carrera, matricula FROM alumnos WHERE club_id = '$cid'");
                            if (mysqli_num_rows($alum) > 0):
                                while ($a = mysqli_fetch_array($alum)): ?>
                                    <li>
                                        • <?= $a['nombre'] ?> <?= $a['apellidos'] ?>
                                        <span class="carrera-text">— <?= $a['carrera'] ?></span>
                                        <span class="matricula-text">[<?= $a['matricula'] ?>]</span>
                                    </li>
                                <?php endwhile;
                            else: ?>
                                <li style="color:#555;">Sin registros.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
        function toggleClub(id) {
            const extra = document.getElementById('extra-' + id);
            const isVisible = extra.style.display === 'block';
            document.querySelectorAll('.info-extra').forEach(el => el.style.display = 'none');
            extra.style.display = isVisible ? 'none' : 'block';
        }
    </script>
</body>

</html>