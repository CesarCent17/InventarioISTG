<?php
    require('mysqli_conexion.php');
    require('utils_query.php');
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_usuario = $_POST['id_usuario'];
        $estado = $_POST['nuevo_estado'];
        actualizarEstadoUsuario($conexion, $id_usuario, $estado);
        header('Location: ../views/usuarios.php'); // redirige al usuario a la página original
        exit;
    }
?>