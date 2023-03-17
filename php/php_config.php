<?php
// Desactivar la visualización de errores en el navegador
ini_set('display_errors', 'Off');

// Establecer el nivel de informe de errores para registrar todos los errores excepto los avisos y las advertencias
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING);

// Habilitar el registro de errores de PHP en el archivo de registro de errores
ini_set('log_errors', 'On');

// Establecer la ubicación del archivo de registro de errores
ini_set('error_log', '/var/log/php_errors.log');
?>
