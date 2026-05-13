<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login Alumnos - TEC San Pedro</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #d1d5db;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: white;
            width: 400px;
            padding: 50px 40px;
            border-radius: 30px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            overflow: hidden;
            border-bottom: 12px solid #B30000;
            /* El borde rojo que te gusta */
        }

        .logo-tec {
            width: 140px;
            margin-bottom: 25px;
        }

        h2 {
            font-size: 28px;
            font-weight: 800;
            color: #1f2937;
            margin: 0 0 10px 0;
        }

        p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }

        input {
            width: 100%;
            padding: 15px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            border-radius: 12px;
            font-size: 16px;
            margin-bottom: 15px;
            box-sizing: border-box;
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #B30000;
            background-color: white;
        }

        button {
            width: 100%;
            padding: 15px;
            background-color: #B30000;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
            transition: 0.3s;
        }

        button:hover {
            background-color: #8b0000;
            transform: translateY(-2px);
        }

        .back-link {
            display: block;
            margin-top: 25px;
            color: #9ca3af;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: #6b7280;
        }
    </style>
</head>

<body>

    <div class="card">
        <img src="logo_tec.png" alt="TEC San Pedro" class="logo-tec">

        <h2>Bienvenido</h2>
        <p>Ingresa tus datos para acceder a tu club</p>

        <form action="../backend/validar_alumno.php" method="POST">
            <input type="text" name="nombre" placeholder="Nombre completo" required>
            <input type="text" name="matricula" placeholder="Matrícula" required>

            <button type="submit">ENTRAR</button>
        </form>

        <a href="opciones_alumno.php" class="back-link">← Volver a opciones</a>
    </div>

</body>

</html>