<?php
    require('mysqli_conexion.php');
    require('querys_campus.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Requeridos
            $id_campus = htmlspecialchars(trim($_POST['id_campus']));
            $nombre = htmlspecialchars(trim($_POST['nombre']));
            $direccion = htmlspecialchars(trim($_POST['direccion']));
            $nombre = strtoupper($nombre);
            update_campus($conexion, $nombre, $direccion, $id_campus); 
        }
    }
?>


