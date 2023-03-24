<?php
    require('querys_docente.php');
    require('mysqli_conexion.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cedula = isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : '';
            eliminar_docente($conexion, $cedula);
            exit;
        }
    }
?>