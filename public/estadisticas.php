<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
include '../config/conexion.php';

if (!isset($_SESSION['admin_auth'])) {
    header("Location: login.php");
    exit();
}

// Consulta: contar alumnos agrupados por club
$res = mysqli_query($conn, "
    SELECT c.nombre_club, COUNT(a.id) AS total
    FROM clubes c
    LEFT JOIN alumnos a ON a.club_id = c.id
    GROUP BY c.id, c.nombre_club
    ORDER BY total DESC
");

$labels = [];
$datos  = [];

while ($row = mysqli_fetch_assoc($res)) {
    $labels[] = $row['nombre_club'];
    $datos[]  = (int) $row['total'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadísticas de Clubes</title>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        .stats-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            align-items: flex-start;
            margin-top: 10px;
        }
        .chart-box {
            background: #1a1a1a;
            border: 1px solid #B30000;
            border-radius: 10px;
            padding: 30px;
            flex: 1 1 400px;
            max-width: 500px;
        }
        .chart-box h2 {
            margin-top: 0;
            color: #fff;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .totales-box {
            background: #1a1a1a;
            border: 1px solid #B30000;
            border-radius: 10px;
            padding: 30px;
            flex: 1 1 260px;
        }
        .totales-box h2 {
            margin-top: 0;
            color: #fff;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .club-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #2a2a2a;
            color: #ccc;
            font-size: 0.95rem;
        }
        .club-item:last-child { border-bottom: none; }
        .club-item .badge {
            background: #B30000;
            color: #fff;
            border-radius: 20px;
            padding: 3px 12px;
            font-weight: bold;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <script>
    window.history.pushState(null, null, window.location.href);
    window.addEventListener('popstate', function() {
        window.history.pushState(null, null, window.location.href);
    });
    </script>

    <?php $activePage = 'estadisticas'; include '../templates/sidebar.php'; ?>

    <div class="main-content">
        <h1>Estadísticas de Clubes</h1>

        <div class="stats-wrapper">

            <!-- Gráfica de dona -->
            <div class="chart-box">
                <h2>Distribución por Club</h2>
                <canvas id="graficaClubes"></canvas>
            </div>

            <!-- Gráfica de barras -->
            <div class="chart-box">
                <h2>Alumnos por Club</h2>
                <canvas id="graficaBarras"></canvas>
            </div>

            <!-- Lista con totales -->
            <div class="totales-box">
                <h2>Totales</h2>
                <?php
                foreach ($labels as $i => $club):
                ?>
                <div class="club-item">
                    <span><?= htmlspecialchars($club) ?></span>
                    <span class="badge"><?= $datos[$i] ?></span>
                </div>
                <?php endforeach; ?>
                <div class="club-item" style="margin-top:10px; border-top: 1px solid #B30000; padding-top:12px;">
                    <strong style="color:#fff">TOTAL</strong>
                    <span class="badge" style="background:#fff; color:#B30000">
                        <?= array_sum($datos) ?>
                    </span>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js desde CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels = <?= json_encode($labels) ?>;
        const datos  = <?= json_encode($datos) ?>;

        const colores = [
            '#B30000','#e63939','#ff6b6b','#ff9999',
            '#cc0000','#990000','#ff4444','#ffaaaa',
            '#800000','#ff2222'
        ];

        // --- Dona ---
        new Chart(document.getElementById('graficaClubes'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: datos,
                    backgroundColor: colores,
                    borderColor: '#111',
                    borderWidth: 2
                }]
            },
            options: {
                plugins: {
                    legend: {
                        labels: { color: '#ccc', font: { size: 13 } }
                    }
                }
            }
        });

        // --- Barras ---
        new Chart(document.getElementById('graficaBarras'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Alumnos',
                    data: datos,
                    backgroundColor: colores,
                    borderRadius: 6
                }]
            },
            options: {
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        ticks: { color: '#ccc' },
                        grid:  { color: '#2a2a2a' }
                    },
                    y: {
                        ticks: { color: '#ccc', stepSize: 1 },
                        grid:  { color: '#2a2a2a' },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>