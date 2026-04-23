<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['alumno_matricula'])) {
    header("Location: login_alumno.php");
    exit();
}

$mi_matricula = $_SESSION['alumno_matricula'];

// Obtener mis datos y los de mi club
$sql = "SELECT a.*, c.nombre_club FROM alumnos a 
        JOIN clubes c ON a.club_id = c.id 
        WHERE a.matricula = '$mi_matricula'";
$res = mysqli_query($conn, $sql);
$yo = mysqli_fetch_assoc($res);

// Listado de maestros inventados
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
$mi_maestro = $maestros[$yo['nombre_club']] ?? 'Por asignar';

// Obtener compañeros
$mi_club = $yo['club_id'];
$compañeros = mysqli_query($conn, "SELECT * FROM alumnos WHERE club_id = '$mi_club' AND matricula != '$mi_matricula'");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Panel - TEC San Pedro</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 20px;
        }

        .grid {
            max-width: 1000px;
            margin: auto;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-top: 5px solid #B30000;
        }

        .profile-img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: #eee;
            border: 3px solid #B30000;
        }

        .club-header {
            background: #B30000;
            color: white;
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            text-align: left;
        }

        @media (max-width: 768px) {
            .grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <div class="grid">
        <div class="card" style="text-align: center;">
            <img src="https://ui-avatars.com/api/?name=<?php echo $yo['nombre']; ?>&background=B30000&color=fff" class="profile-img">
            <h2><?php echo $yo['nombre']; ?></h2>
            <p><strong>Matrícula:</strong> <?php echo $yo['matricula']; ?></p>
            <p><strong>Carrera:</strong> <?php echo $yo['carrera']; ?></p>
            <hr>
            <a href="logout.php" style="color: #B30000; font-weight: bold; text-decoration: none;">Cerrar Sesión</a>
        </div>

        <div>
            <div class="club-header">
                <h1>Club: <?php echo $yo['nombre_club']; ?></h1>
                <p>Maestro Encargado: <strong><?php echo $mi_maestro; ?></strong></p>
            </div>

            <div class="card">
                <h3>Mis Compañeros</h3>
                <table>
                    <tr>
                        <th>Nombre</th>
                        <th>Carrera</th>
                    </tr>
                    <?php while ($c = mysqli_fetch_array($compañeros)) { ?>
                        <tr>
                            <td><?php echo $c['nombre'] . " " . $c['apellidos']; ?></td>
                            <td><?php echo $c['carrera']; ?></td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

</body>

</html>