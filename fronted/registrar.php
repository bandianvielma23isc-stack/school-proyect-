<?php
include '../backend/conexion.php';

$query_clubes = "SELECT id, nombre_club FROM clubes";
$res_clubes = mysqli_query($conn, $query_clubes);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Alumno - TEC San Pedro</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #e9e9e9;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-card {
            background-color: white;
            width: 420px;
            padding: 35px;
            border-radius: 10px;
            border-top: 8px solid #B30000;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo-tec {
            width: 100px;
            margin-bottom: 15px;
        }

        h2 {
            color: #333;
            margin-bottom: 25px;
            font-size: 22px;
            font-weight: bold;
        }

        .input-group {
            text-align: left;
            margin-bottom: 18px;
        }

        .input-group label {
            display: block;
            font-weight: bold;
            font-size: 13px;
            color: #555;
            margin-bottom: 6px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #B30000;
        }

        .btn-enviar {
            width: 100%;
            padding: 14px;
            background-color: #B30000;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn-enviar:hover {
            background-color: #800000;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            color: #888;
            text-decoration: none;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <div class="form-card">
        <img src="logo_tec.png" class="logo-tec">
        <h2>Registro de Alumno</h2>

        <form action="../backend/guardar.php" method="POST" id="formRegistro">
            <div class="input-group">
                <label>Nombre(s):</label>
                <input type="text" name="nombre" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" required>
            </div>

            <div class="input-group">
                <label>Apellidos:</label>
                <input type="text" name="apellidos" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" required>
            </div>

            <div class="input-group">
                <label>Matrícula:</label>
                <input type="text" name="matricula" pattern="[0-9]+" title="Solo se permiten números" required>
            </div>

            <div class="input-group">
                <label>Carrera:</label>
                <select name="carrera" required>
                    <option value="Sistemas Computacionales">Sistemas Computacionales</option>
                    <option value="Industrial">Industrial</option>
                    <option value="Logística">Logística</option>
                    <option value="Gestión Empresarial">Gestión Empresarial</option>
                </select>
            </div>

            <div class="input-group">
                <label>¿A qué club quieres pertenecer?</label>
                <select name="club_id" required>
                    <?php while ($c = mysqli_fetch_array($res_clubes)): ?>
                        <option value="<?= $c['id'] ?>"><?= strtoupper($c['nombre_club']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <button type="submit" class="btn-enviar">Enviar Registro</button>
        </form>

        <a href="index.php" class="back-link">← Volver al inicio</a>
    </div>

    <script>
        // Escuchamos cuando se envía el formulario
        const urlParams = new URLSearchParams(window.location.search);

        // Si el backend nos regresa con ?status=success
        if (urlParams.get('status') === 'success') {
            Swal.fire({
                title: '¡Registro Exitoso!',
                text: 'Tus datos han sido guardados correctamente.',
                icon: 'success',
                confirmButtonColor: '#B30000',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Limpiamos la URL para que no salga el mensaje otra vez al recargar
                    window.location.href = 'registrar.php';
                }
            });
        }

        // Si el backend nos regresa con ?status=error
        if (urlParams.get('status') === 'error') {
            Swal.fire({
                title: 'Error',
                text: 'No se pudo completar el registro. Intenta de nuevo.',
                icon: 'error',
                confirmButtonColor: '#B30000'
            });
        }
    </script>

</body>

</html>