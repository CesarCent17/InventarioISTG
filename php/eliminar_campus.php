<?php
    require('querys_campus.php');
    require('mysqli_conexion.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_campus = $_POST['id_campus'];
            eliminar_campus($conexion, $id_campus);
            header("Location: ../views/campus.php");
            exit;
        }
    }
?>