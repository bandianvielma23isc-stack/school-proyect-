<?php
// 1. Iniciamos la sesión
session_start();

// 2. Le asignamos un rol automáticamente (sin pedir credenciales)
$_SESSION['usuario'] = "Admin_Temporal";
$_SESSION['rol'] = "admin";

// 3. Lo mandamos directo al formulario principal
header("Location: index.php");
exit();
