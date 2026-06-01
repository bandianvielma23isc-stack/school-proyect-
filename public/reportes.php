<?php
session_start();
include '../config/conexion.php';

if (!isset($_SESSION['admin_auth'])) {
    header("Location: login.php");
    exit();
}

$club_filtro = isset($_GET['club_id']) ? intval($_GET['club_id']) : 0;

$query_clubes = "SELECT id, nombre_club FROM clubes ORDER BY nombre_club ASC";
$res_clubes = mysqli_query($conn, $query_clubes);

$sql = "SELECT a.*, c.nombre_club FROM alumnos a 
        JOIN clubes c ON a.club_id = c.id";
if ($club_filtro > 0) {
    $sql .= " WHERE a.club_id = $club_filtro";
}
$sql .= " ORDER BY c.nombre_club ASC, a.nombre ASC";
$res_reporte = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes de Alumnos - TEC San Pedro</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        .report-actions {
            display: flex;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
            background: #111;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #222;
        }
        .report-actions select {
            background-color: #1a1a1a;
            color: #fff;
            border: 1px solid #B30000;
            padding: 10px;
            border-radius: 5px;
            outline: none;
        }
        .btn-pdf {
            background-color: #B30000;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
        }
        .btn-pdf:hover {
            background-color: #e60000;
        }

        #area-reporte {
            background: #111;
            padding: 20px;
            border-radius: 5px;
        }
        
        /* Reglas de sobreescritura para el modo de exportación PDF */
        .pdf-mode {
            background: #ffffff !important;
            color: #000000 !important;
            padding: 30px !important;
        }
        .pdf-mode table {
            width: 100% !important;
            border-collapse: collapse !important;
            background-color: #ffffff !important;
        }
        .pdf-mode tr {
            background-color: #ffffff !important;
            background: #ffffff !important;
        }
        .pdf-mode th {
            background-color: #B30000 !important;
            color: #ffffff !important;
            padding: 10px !important;
            border: 1px solid #ddd !important;
        }
        .pdf-mode td {
            color: #000000 !important;
            padding: 10px !important;
            border: 1px solid #ddd !important;
            background-color: #ffffff !important;
            background: #ffffff !important;
        }
        .pdf-mode h2 {
            color: #B30000 !important;
            margin-bottom: 20px !important;
        }
    </style>
</head>
<body>

    <?php $activePage = 'reportes'; include '../templates/sidebar.php'; ?>

    <div class="main-content">
        <h1>Reportes del Sistema</h1>

        <div class="report-actions">
            <form method="GET" action="" style="display:flex; gap:10px; align-items:center;">
                <label style="color:#fff;">Filtrar por Club:</label>
                <select name="club_id" onchange="this.form.submit()">
                    <option value="0">-- Todos los Clubes --</option>
                    <?php while ($c = mysqli_fetch_array($res_clubes)): ?>
                        <option value="<?= $c['id'] ?>" <?= ($club_filtro == $c['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nombre_club']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </form>

            <button onclick="descargarPDF();" class="btn-pdf">Descargar PDF Directo</button>
        </div>

        <div id="area-reporte">
            <h2 id="titulo-reporte" style="color: #fff; margin-bottom: 15px;">Lista Oficial de Alumnos</h2>
            <table class="table-container">
                <thead>
                    <tr>
                        <th>MATRÍCULA</th>
                        <th>NOMBRE DEL ALUMNO</th>
                        <th>CARRERA</th>
                        <th>CLUB ASIGNADO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($res_reporte) > 0): ?>
                        <?php while ($row = mysqli_fetch_array($res_reporte)): ?>
                            <tr>
                                <td class="m-text">
                                    <?php 
                                    $matricula = !empty($row['matricula_visible'])
                                        ? $row['matricula_visible']
                                        : ((strpos($row['matricula'], '$2y$') === 0)
                                            ? "221000" . str_pad($row['id'], 4, "0", STR_PAD_LEFT)
                                            : $row['matricula']);
                                    echo htmlspecialchars($matricula);
                                    ?>
                                </td>
                                <td><?= htmlspecialchars($row['nombre']) ?></td>
                                <td><?= htmlspecialchars($row['carrera']) ?></td>
                                <td><?= htmlspecialchars($row['nombre_club']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center; color:#fff;">No hay alumnos registrados en este club.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    function descargarPDF() {
        const elemento = document.getElementById('area-reporte');
        
        elemento.classList.add('pdf-mode');

        const opciones = {
            margin:       0.5,
            filename:     'Reporte_Alumnos_TEC.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true },
            jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().set(opciones).from(elemento).save().then(() => {
            elemento.classList.remove('pdf-mode');
        });
    }
    </script>
</body>
</html>
