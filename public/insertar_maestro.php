<?php
session_start();
include '../config/conexion.php';

if (!isset($_SESSION['admin_auth'])) {
    header("Location: login.php");
    exit();
}

$query_clubes = "SELECT id, nombre_club FROM clubes ORDER BY nombre_club ASC";
$res_clubes   = mysqli_query($conn, $query_clubes);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Insertar Profesor - Administrador</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        .form-container {
            max-width: 500px;
            background-color: #111;
            border: 1px solid #222;
            padding: 30px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .input-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }
        .input-group label {
            color: #fff;
            margin-bottom: 8px;
            font-size: 0.9em;
            text-transform: uppercase;
        }
        .input-group input, .input-group select {
            background-color: #1a1a1a;
            color: #fff;
            border: 1px solid #B30000; /* Rojo TEC */
            padding: 10px 15px;
            border-radius: 5px;
            outline: none;
            font-size: 1em;
        }
        .input-group input:focus, .input-group select:focus {
            border-color: #fff;
        }
        .btn-guardar {
            background-color: #B30000;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            text-transform: uppercase;
            transition: background 0.3s;
        }
        .btn-guardar:hover {
            background-color: #e60000;
        }
    </style>
</head>
<body>

    <?php $activePage = 'insertar_maestro'; include '../templates/sidebar.php'; ?>

    <div class="main-content">
        <h1>Registrar Nuevo Profesor</h1>
        
        <div class="form-container">
            <form action="../src/guardar_maestro.php" method="POST" id="formMaestro">
                
                <div class="input-group">
                    <label>Nombre(s):</label>
                    <input type="text" name="nombre" placeholder="Ej: Javier" maxlength="25" pattern="[\p{L} ]{1,25}" title="Solo letras, maximo 25 caracteres" required>
                </div>

                <div class="input-group">
                    <label>Apellidos:</label>
                    <input type="text" name="apellidos" placeholder="Ej: Solis Garza" maxlength="30" pattern="[\p{L} ]{1,30}" title="Solo letras, maximo 30 caracteres" required>
                </div>

                <div class="input-group">
                    <label>Club Asignado:</label>
                    <select name="club_id" required>
                        <option value="" disabled selected>-- Selecciona un club --</option>
                        <?php 
                        if ($res_clubes && mysqli_num_rows($res_clubes) > 0) {
                            while ($c = mysqli_fetch_array($res_clubes)) {
                                echo '<option value="'.$c['id'].'">'.htmlspecialchars($c['nombre_club']).'</option>';
                            }
                        } else {
                            echo '<option value="" disabled>No hay clubes registrados</option>';
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn-guardar">Guardar / Actualizar Profesor</button>
            </form>
        </div>
    </div>

    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('status') === 'success') {
            Swal.fire({
                title: '¡Profesor Registrado!',
                text: 'El maestro y su club asignado se guardaron correctamente.',
                icon: 'success',
                confirmButtonColor: '#B30000'
            }).then(() => { window.location.href = 'insertar_maestro.php'; });
        }
        if (urlParams.get('status') === 'error') {
            Swal.fire({
                title: 'Error',
                text: 'No se pudo registrar al profesor. Verifica los datos.',
                icon: 'error',
                confirmButtonColor: '#B30000'
            });
        }

        document.querySelectorAll('input[name="nombre"], input[name="apellidos"]').forEach((input) => {
            input.addEventListener('input', () => {
                input.value = input.value.replace(/[^\p{L} ]/gu, '');
            });
        });
    </script>
</body>
</html>
