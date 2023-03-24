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
            $nombre = trim($_POST['nombre']);
            $apellido = trim($_POST['apellido']);
            $id_docente = trim($_POST['id_docente']);
            $cedula = trim($_POST['cedula']);
            $nombre = strtoupper($nombre);
            $apellido = strtoupper($apellido);
            update_docente($conexion, $nombre, $apellido, $id_docente, $cedula); 
        }
    }

?>