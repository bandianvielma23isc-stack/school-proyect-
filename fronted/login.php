<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login Admin - TEC San Pedro</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #e0e0e0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #ffffff;
            padding: 40px;
            border-radius: 25px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-top: 8px solid #B30000;
            box-sizing: border-box;
        }

        .logo-tec {
            width: 150px;
            margin-bottom: 20px;
        }

        h2 {
            color: #1a1a1a;
            margin-bottom: 25px;
            font-size: 1.8rem;
        }

        input {
            width: 100%;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            box-sizing: border-box;
            outline: none;
        }

        input:focus {
            border-color: #B30000;
            background: #fff;
        }

        button {
            width: 100%;
            background: #B30000;
            color: white;
            border: none;
            padding: 15px;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #e60000;
        }

        .btn-regresar {
            display: block;
            margin-top: 20px;
            color: #888;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="card">
        <img src="logo_tec.png" class="logo-tec">
        <h2>Panel Admin</h2>
        <form action="../backend/validar_acceso.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">ENTRAR</button>
        </form>
        <a href="index.php" class="btn-regresar">← Volver</a>
    </div>
</body>

</html>