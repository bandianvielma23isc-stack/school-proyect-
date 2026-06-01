<?php
// Iniciar sesión y buffer de salida
session_start();
ob_start();

// Configuración de errores
error_reporting(0);
ini_set('display_errors', 0);

// Función para enviar respuesta JSON
function enviarJSON($data, $codigo = 200) {
    ob_clean();
    http_response_code($codigo);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// Verificar sesión
if (!isset($_SESSION['alumno_id'])) {
    enviarJSON(['error' => 'Sesión no válida. Por favor inicia sesión nuevamente.'], 403);
}

$alumno_id = intval($_SESSION['alumno_id']);

// Conectar a la base de datos
$conn = @mysqli_connect("localhost", "root", "300605", "sistema_clubes");
if (!$conn) {
    enviarJSON(['error' => 'No se pudo conectar a la base de datos'], 500);
}
mysqli_set_charset($conn, "utf8mb4");

// ============================================
// ELIMINAR FOTO
// ============================================
if (isset($_POST['eliminar']) && $_POST['eliminar'] == '1') {
    // Obtener foto actual
    $stmt = mysqli_prepare($conn, "SELECT foto FROM alumnos WHERE id = ?");
    if (!$stmt) {
        enviarJSON(['error' => 'Error en la consulta: ' . mysqli_error($conn)], 500);
    }
    mysqli_stmt_bind_param($stmt, "i", $alumno_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $alumno = mysqli_fetch_assoc($resultado);
    
    // Eliminar archivo físico si existe
    if ($alumno && !empty($alumno['foto'])) {
        $rutaFoto = __DIR__ . "/../public/assets/uploads/photos/" . basename($alumno['foto']);
        if (file_exists($rutaFoto)) {
            @unlink($rutaFoto);
        }
    }
    
    // Actualizar base de datos
    $stmt2 = mysqli_prepare($conn, "UPDATE alumnos SET foto = NULL WHERE id = ?");
    if (!$stmt2) {
        enviarJSON(['error' => 'Error al preparar actualización: ' . mysqli_error($conn)], 500);
    }
    mysqli_stmt_bind_param($stmt2, "i", $alumno_id);
    
    if (mysqli_stmt_execute($stmt2)) {
        enviarJSON(['ok' => true, 'mensaje' => 'Foto eliminada correctamente']);
    } else {
        enviarJSON(['error' => 'No se pudo eliminar la foto de la base de datos'], 500);
    }
}

// ============================================
// SUBIR FOTO
// ============================================
if (isset($_FILES['foto']) && is_array($_FILES['foto'])) {
    $archivo = $_FILES['foto'];
    
    // Verificar si hubo error en la subida
    if (!isset($archivo['error']) || $archivo['error'] !== UPLOAD_ERR_OK) {
        $mensajesError = [
            UPLOAD_ERR_INI_SIZE => 'El archivo es demasiado grande (límite de PHP)',
            UPLOAD_ERR_FORM_SIZE => 'El archivo es demasiado grande (límite del formulario)',
            UPLOAD_ERR_PARTIAL => 'El archivo se subió parcialmente',
            UPLOAD_ERR_NO_FILE => 'No se seleccionó ningún archivo',
            UPLOAD_ERR_NO_TMP_DIR => 'Falta la carpeta temporal del servidor',
            UPLOAD_ERR_CANT_WRITE => 'No se pudo escribir el archivo en el disco',
            UPLOAD_ERR_EXTENSION => 'Una extensión de PHP bloqueó la subida'
        ];
        
        $error = $archivo['error'] ?? 'desconocido';
        $mensaje = $mensajesError[$error] ?? 'Error desconocido al subir el archivo';
        enviarJSON(['error' => $mensaje], 400);
    }
    
    // Verificar que el archivo temporal existe
    if (!isset($archivo['tmp_name']) || !is_uploaded_file($archivo['tmp_name'])) {
        enviarJSON(['error' => 'No se recibió el archivo correctamente'], 400);
    }
    
    // Validar que sea una imagen real
    $infoImagen = @getimagesize($archivo['tmp_name']);
    if ($infoImagen === false) {
        enviarJSON(['error' => 'El archivo no es una imagen válida'], 400);
    }
    
    // Validar tipo de imagen
    $tiposPermitidos = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP];
    if (!in_array($infoImagen[2], $tiposPermitidos)) {
        enviarJSON(['error' => 'Solo se permiten imágenes JPG, PNG o WEBP'], 400);
    }
    
    // Validar tamaño (máximo 10MB)
    if ($archivo['size'] > 10485760) {
        enviarJSON(['error' => 'La imagen es muy grande. Tamaño máximo: 10MB'], 400);
    }
    
    // Definir carpeta de destino
    $carpetaDestino = __DIR__ . "/../public/assets/uploads/photos/";
    
    // Crear carpeta si no existe
    if (!is_dir($carpetaDestino)) {
        if (!@mkdir($carpetaDestino, 0777, true)) {
            enviarJSON(['error' => 'No se pudo crear la carpeta de fotos'], 500);
        }
    }
    
    // Verificar permisos de escritura
    if (!is_writable($carpetaDestino)) {
        enviarJSON(['error' => 'La carpeta de fotos no tiene permisos de escritura'], 500);
    }
    
    // Obtener y eliminar foto anterior si existe
    $stmt = mysqli_prepare($conn, "SELECT foto FROM alumnos WHERE id = ?");
    if (!$stmt) {
        enviarJSON(['error' => 'Error en la consulta: ' . mysqli_error($conn)], 500);
    }
    mysqli_stmt_bind_param($stmt, "i", $alumno_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $alumno = mysqli_fetch_assoc($resultado);
    
    if ($alumno && !empty($alumno['foto'])) {
        $fotoAnterior = $carpetaDestino . basename($alumno['foto']);
        if (file_exists($fotoAnterior)) {
            @unlink($fotoAnterior);
        }
    }
    
    // Generar nombre único para el archivo
    $extension = '';
    switch ($infoImagen[2]) {
        case IMAGETYPE_JPEG:
            $extension = 'jpg';
            break;
        case IMAGETYPE_PNG:
            $extension = 'png';
            break;
        case IMAGETYPE_WEBP:
            $extension = 'webp';
            break;
    }
    
    $nombreArchivo = 'alumno_' . $alumno_id . '_' . time() . '.' . $extension;
    $rutaCompleta = $carpetaDestino . $nombreArchivo;
    
    // Mover archivo a la carpeta de destino
    if (!@move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
        enviarJSON(['error' => 'No se pudo guardar el archivo en el servidor'], 500);
    }
    
    // Actualizar base de datos
    $stmt2 = mysqli_prepare($conn, "UPDATE alumnos SET foto = ? WHERE id = ?");
    if (!$stmt2) {
        // Si falla la preparación, eliminar el archivo que acabamos de subir
        @unlink($rutaCompleta);
        enviarJSON(['error' => 'Error al preparar actualización: ' . mysqli_error($conn)], 500);
    }
    mysqli_stmt_bind_param($stmt2, "si", $nombreArchivo, $alumno_id);
    
    if (mysqli_stmt_execute($stmt2)) {
        enviarJSON([
            'ok' => true, 
            'foto' => $nombreArchivo,
            'mensaje' => 'Foto actualizada correctamente'
        ]);
    } else {
        // Si falla la BD, eliminar el archivo que acabamos de subir
        @unlink($rutaCompleta);
        enviarJSON(['error' => 'No se pudo actualizar la base de datos'], 500);
    }
}

// Si llegamos aquí, la petición no es válida
enviarJSON(['error' => 'Petición no válida'], 400);
?>
