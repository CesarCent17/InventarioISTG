<?php
    require('querys_ver_detalle.php');
    require('mysqli_conexion.php');
    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_prod = $_POST['id_prod'];
            eliminar_prod($conexion, $id_prod);
            header("Location: ../views/inventario.php");
            exit;
        }
    }
?>