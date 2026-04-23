<?php
include 'conexion.php';
$clubes = mysqli_query($conn, "SELECT * FROM clubes");
?>
<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            width: 450px;
            border-top: 6px solid #B30000;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            background: #B30000;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="card">
        <center><img src="logo_tec.png" width="160">
            <h2>Registro de Alumno</h2>
        </center>
        <form action="guardar.php" method="POST">
            <label>Nombre(s):</label>
            <input type="text" name="nombre" pattern="[A-Za-zÁ-ÿ\s]+" title="Solo se permiten letras" required>

            <label>Apellidos:</label>
            <input type="text" name="apellidos" pattern="[A-Za-zÁ-ÿ\s]+" title="Solo se permiten letras" required>

            <label>Matrícula:</label>
            <input type="text" name="matricula" pattern="[0-9]+" title="Solo números" required>

            <label>Carrera:</label>
            <select name="carrera" required>
                <option value="">-- Selecciona tu Carrera --</option>
                <option value="Sistemas Computacionales">Sistemas Computacionales</option>
                <option value="Industrial">Industrial</option>
                <option value="Gestion Empresarial">Gestión Empresarial</option>
                <option value="Logistica">Logística</option>
            </select>

            <label>¿A qué club quieres pertenecer?</label>
            <select name="club_id" required>
                <option value="">-- Selecciona un Club --</option>
                <?php while ($c = mysqli_fetch_array($clubes)) { ?>
                    <option value="<?= $c['id']; ?>"><?= $c['nombre_club']; ?></option>
                <?php } ?>
            </select>

            <button type="submit">ENVIAR REGISTRO</button>
        </form>
    </div>
</body>

</html>