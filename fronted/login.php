<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['usuario'] === "admin" && $_POST['password'] === "TECSP") {
        $_SESSION['rol'] = 'admin';
        header("Location: admin.php");
    } else {
        $error = "Credenciales incorrectas";
    }
}
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
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            border-top: 5px solid #B30000;
            text-align: center;
            width: 300px;
        }

        input,
        button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        button {
            background: #B30000;
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="box">
        <img src="logo_tec.png" width="150">
        <h2>Admin Login</h2>
        <form method="POST">
            <input type="text" name="usuario" placeholder="Usuario" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">INGRESAR</button>
        </form>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </div>
</body>

</html>