<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bienvenido - TEC San Pedro</title>
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

        .logo {
            max-width: 250px;
            margin-bottom: 20px;
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
            width: 220px;
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
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <img src="logo_tec.png" class="logo">
    <h1>Gestión de Clubes Escolares</h1>
    <div class="container">
        <a href="opciones_alumno.php" class="card">
            <div style="font-size:50px;">🎓</div>
            <h2>Soy Alumno</h2>
            <p>Ingresar o Registrarme</p>
        </a>
        <a href="login.php" class="card">
            <div style="font-size:50px;">👨‍🏫</div>
            <h2>Soy Admin</h2>
            <p>Gestionar registros</p>
        </a>
    </div>
</body>

</html>