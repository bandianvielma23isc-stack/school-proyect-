<?php
/**
 * Cargar variables desde .env
 * Busca el archivo .env en la carpeta raíz del proyecto
 */

// Obtener la ruta del proyecto (carpeta raíz)
$project_root = dirname(dirname(__FILE__));
$env_file = $project_root . '/.env';

// Si existe el archivo .env, cargarlo
if (file_exists($env_file)) {
    $lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignorar comentarios
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        
        // Buscar líneas con =
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Definir como constante y variable de entorno
            if (!defined($key)) {
                define($key, $value);
            }
            putenv($key . '=' . $value);
        }
    }
}
?>
