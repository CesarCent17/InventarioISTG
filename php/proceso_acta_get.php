<?php
    require('mysqli_conexion.php');
    require('querys_ver_detalle.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_prod = htmlspecialchars(trim($_POST['id_prod']));
            $prod = obtener_producto_por_id($conexion, $id_prod);
            echo $prod['nombre'];
            // header("Location: report/actas/generar_actas.php?id=".urlencode($id_prod));
        }
    }
?>