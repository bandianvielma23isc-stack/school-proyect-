<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Opciones Alumno</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            display: flex;
            gap: 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 200px;
            text-decoration: none;
            color: #333;
            transition: 0.3s;
            border-top: 6px solid #B30000;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        h2 {
            color: #B30000;
        }
    </style>
</head>

<body>
    <img src="logo_tec.png" width="200" style="margin-bottom:20px;">
    <h1>¿Qué deseas hacer?</h1>
    <div class="container">
        <a href="login_alumno.php" class="card">
            <div style="font-size:40px;">🔑</div>
            <h2>Ya estoy inscrito</h2>
            <p>Ver mis datos</p>
        </a>
        <a href="registrar.php" class="card">
            <div style="font-size:40px;">📝</div>
            <h2>Soy nuevo</h2>
            <p>Registrar mis datos</p>
        </a>
    </div>
    <br><a href="index.php" style="color:#666; text-decoration:none;">← Volver al inicio</a>
</body>

</html>