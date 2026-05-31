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
$foto_url = (!empty($datos['foto']))
    ? "assets/uploads/photos/" . htmlspecialchars($datos['foto'])
    : null;

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
    <style>
        .avatar-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        .circle-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background-color: #B30000;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: bold;
            color: #fff;
            overflow: hidden;
            cursor: pointer;
        }
        .circle-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .avatar-actions {
            display: flex;
            gap: 8px;
        }
        .btn-foto {
            background: #1a1a1a;
            border: 1px solid #B30000;
            color: #fff;
            padding: 5px 12px;
            border-radius: 5px;
            font-size: 0.8rem;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-foto:hover { background: #B30000; }
        .btn-quitar { border-color: #555; }
        .btn-quitar:hover { background: #333; }
    </style>
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

            <div class="avatar-wrapper">
                <div class="circle-avatar" id="avatarBtn" title="Cerrar Sesión">
                    <?php if ($foto_url): ?>
                        <img src="<?= $foto_url ?>" alt="Foto de perfil" id="fotoPreview">
                    <?php else: ?>
                        <span id="inicialesSpan"><?= htmlspecialchars($iniciales) ?></span>
                        <img src="" alt="" id="fotoPreview" style="display:none;">
                    <?php endif; ?>
                </div>

                <div class="avatar-actions">
                    <label for="inputFoto" class="btn-foto" title="Subir foto">📷 Cambiar</label>
                    <input type="file" id="inputFoto" accept="image/jpeg,image/png,image/webp" style="display:none;">

                    <?php if ($foto_url): ?>
                        <button class="btn-foto btn-quitar" id="btnQuitarFoto">🗑 Quitar</button>
                    <?php else: ?>
                        <button class="btn-foto btn-quitar" id="btnQuitarFoto" style="display:none;">🗑 Quitar</button>
                    <?php endif; ?>
                </div>
            </div>

            <h2><?= htmlspecialchars($datos['nombre']) ?></h2>
            <p><strong>Matrícula:</strong> <?= htmlspecialchars($_SESSION['alumno_matricula_limpia'] ?? '') ?></p>
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
                                <td colspan="2" style="text-align:center; color:#888;">
                                    No tienes compañeros asignados en este club todavía.
                                </td>
                            </tr>
                        <?php endif; ?>
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

        document.getElementById('inputFoto').addEventListener('change', function(e) {
            e.stopPropagation();
            const archivo = this.files[0];
            if (!archivo) return;

            const formData = new FormData();
            formData.append('foto', archivo);

            fetch('/school-proyect-/src/actualizar_foto.php', { method: 'POST', body: formData })
                .then(r => r.json())
                .then(data => {
                    if (data.ok) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('fotoPreview').src = e.target.result;
                            document.getElementById('fotoPreview').style.display = 'block';
                            const span = document.getElementById('inicialesSpan');
                            if (span) span.style.display = 'none';
                            document.getElementById('btnQuitarFoto').style.display = 'inline-block';
                        };
                        reader.readAsDataURL(archivo);
                    } else {
                        Swal.fire('Error', data.error || 'No se pudo subir la imagen', 'error');
                    }
                })
                .catch(err => {
                    Swal.fire('Error', 'No se pudo conectar con el servidor', 'error');
                    console.error(err);
                });
        });

        document.getElementById('btnQuitarFoto').addEventListener('click', function(e) {
            e.stopPropagation();
            Swal.fire({
                title: '¿Quitar foto?',
                text: 'Se eliminará tu foto de perfil.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#B30000',
                cancelButtonColor: '#555',
                confirmButtonText: 'Sí, quitar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('eliminar', '1');

                    fetch('/school-proyect-/src/actualizar_foto.php', { method: 'POST', body: formData })
                        .then(r => r.json())
                        .then(data => {
                            if (data.ok) {
                                document.getElementById('fotoPreview').style.display = 'none';
                                document.getElementById('fotoPreview').src = '';
                                const span = document.getElementById('inicialesSpan');
                                if (span) span.style.display = 'flex';
                                document.getElementById('btnQuitarFoto').style.display = 'none';
                            }
                        });
                }
            });
        });

        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                window.location.href = "../src/logout.php";
            }
        });
    </script>
</body>
</html>