<?php
    require('mysqli_conexion.php');
    require('querys_docente.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Requeridos
            $id_campus = $_POST['id_campus'];
            $nombre = $_POST['nombre'];
            $direccion = $_POST['direccion'];
            update_docente($conexion, $nombre, $direccion, $id_campus); 
        }
    }

?>