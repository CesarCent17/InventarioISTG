<?php
    require('mysqli_conexion.php');
    require('utils_query.php');
    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_usuario = $_POST['id_usuario'];
            $estado = $_POST['nuevo_estado'];
            actualizarEstadoUsuario($conexion, $id_usuario, $estado);
            header('Location: ../views/usuarios.php'); // redirige al usuario a la página original
            exit;
        }
        header('Location: ../views/usuarios.php'); // redirige al usuario a la página original
            exit;
        }
   
?>