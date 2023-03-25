<?php
    require('querys_area_de_ubicacion.php');
    require('mysqli_conexion.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_area = htmlspecialchars(trim($_POST['id_area']));
            eliminar_area($conexion, $id_area);
            header("Location: ../views/area_de_ubicacion.php");
            exit;
        }
    }
?>