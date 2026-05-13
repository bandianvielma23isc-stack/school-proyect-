<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Bienvenido - TEC San Pedro</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #e0e0e0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .logo-tec {
            width: 220px;
            margin-bottom: 20px;
        }

        h1 {
            color: #1a1a1a;
            font-size: 2.2rem;
            margin-bottom: 40px;
            text-align: center;
        }

        .container {
            display: flex;
            gap: 30px;
        }

        .card {
            background: #ffffff;
            width: 220px;
            padding: 40px 20px;
            border-radius: 25px;
            text-align: center;
            text-decoration: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            border-bottom: 8px solid #B30000;
        }

        .card:hover {
            transform: translateY(-10px);
        }

        .icon {
            font-size: 50px;
            margin-bottom: 15px;
            display: block;
        }

        .card h2 {
            margin: 10px 0;
            color: #B30000;
            font-size: 1.5rem;
        }
    </style>
</head>

<body>
    <img src="logo_tec.png" class="logo-tec">
    <h1>Gestión de Clubes Escolares</h1>
    <div class="container">
        <a href="opciones_alumno.php" class="card">
            <span class="icon">🎓</span>
            <h2>Soy Alumno</h2>
            <p>Acceder al portal</p>
        </a>
        <a href="login.php" class="card">
            <span class="icon">👨‍🏫</span>
            <h2>Soy Admin</h2>
            <p>Gestionar registros</p>
        </a>
    </div>
</body>

</html>