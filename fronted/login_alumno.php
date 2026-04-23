<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Alumnos - TEC San Pedro</title>
    <style>
        body {
            font-family: sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            border-top: 5px solid #B30000;
            text-align: center;
            width: 320px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        input,
        button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            background: #B30000;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #800000;
        }

        .logo {
            width: 160px;
            margin-bottom: 10px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: #666;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="box">
        <img src="logo_tec.png" class="logo">
        <h2>Ingreso de Alumnos</h2>
        <p style="font-size: 13px; color: #666;">Ingresa tus datos registrados</p>

        <form action="validar_alumno.php" method="POST">
            <input type="text" name="nombre" placeholder="Tu Nombre(s)" pattern="[A-Za-zÁ-ÿ\s]+" required>
            <input type="text" name="matricula" placeholder="Tu Matrícula" pattern="[0-9]+" required>
            <button type="submit">ACCEDER A MI CLUB</button>
        </form>

        <?php
        if (isset($_GET['error'])) {
            echo "<p style='color:red; font-size:13px;'>Los datos no coinciden con nuestro registro.</p>";
        }
        ?>
        <br>
        <a href="opciones_alumno.php">← Volver</a>
    </div>
</body>

</html>