<?php
session_start();
include '../config/conexion.php';

if (!isset($_SESSION['alumno_id'])) {
    http_response_code(403);
    exit(json_encode(['error' => 'No autorizado']));
}

$alumno_id = $_SESSION['alumno_id'];

// --- ELIMINAR FOTO ---
if (isset($_POST['eliminar'])) {
    // Obtener foto actual
    $stmt = mysqli_prepare($conn, "SELECT foto FROM alumnos WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $alumno_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);

    if ($row['foto']) {
        $ruta = "../admin/assets/uploads/fotos/" . $row['foto'];
        if (file_exists($ruta)) unlink($ruta); // Borra el archivo
    }

    $stmt2 = mysqli_prepare($conn, "UPDATE alumnos SET foto = NULL WHERE id = ?");
    mysqli_stmt_bind_param($stmt2, "i", $alumno_id);
    mysqli_stmt_execute($stmt2);

    echo json_encode(['ok' => true]);
    exit();
}

// --- SUBIR FOTO ---
if (isset($_FILES['foto'])) {
    $archivo = $_FILES['foto'];

    // Validaciones
    $permitidos = ['image/jpeg', 'image/png', 'image/webp'];
    if (!in_array($archivo['type'], $permitidos)) {
        echo json_encode(['error' => 'Solo JPG, PNG o WEBP']);
        exit();
    }
    if ($archivo['size'] > 2 * 1024 * 1024) { // Máx 2MB
        echo json_encode(['error' => 'La imagen no debe superar 2MB']);
        exit();
    }

    // Nombre único para evitar conflictos
    $extension  = pathinfo($archivo['name'], PATHINFO_EXTENSION);
    $nombre     = 'alumno_' . $alumno_id . '_' . time() . '.' . $extension;
    $destino    = "../admin/assets/uploads/fotos/" . $nombre;

    // Borrar foto anterior si existe
    $stmt = mysqli_prepare($conn, "SELECT foto FROM alumnos WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $alumno_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    if ($row['foto']) {
        $vieja = "../admin/assets/uploads/fotos/" . $row['foto'];
        if (file_exists($vieja)) unlink($vieja);
    }

    if (move_uploaded_file($archivo['tmp_name'], $destino)) {
        $stmt2 = mysqli_prepare($conn, "UPDATE alumnos SET foto = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt2, "si", $nombre, $alumno_id);
        mysqli_stmt_execute($stmt2);

        echo json_encode(['ok' => true, 'foto' => $nombre]);
    } else {
        echo json_encode(['error' => 'No se pudo guardar la imagen']);
    }
    exit();
}
?>