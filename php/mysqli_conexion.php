<?php 
    define('DB_USER', 'CesarCenturion');
    define('DB_PASSWORD', 'vU-.mCRg]dFMf!!Y');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'inventorioistg');

    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
      }
?>