<?php 
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'uZD7t0J66');
    define('DB_HOST', 'db:3310');
    define('DB_NAME', 'inventorioistg');

    $conexion = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    mysqli_set_charset($conexion, 'utf8');
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
      }
?>