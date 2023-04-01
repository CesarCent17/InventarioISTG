<?php
    require('mysqli_conexion.php');
    require('querys_ver_detalle.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_prod = htmlspecialchars(trim($_POST['bien']));
            $n_acta = htmlspecialchars(trim($_POST['n_acta']));
            $nombre_donante = htmlspecialchars(trim($_POST['nombre_donante']));
            $cedula_donante = htmlspecialchars(trim($_POST['cedula_donante']));
            $cargo_donante = htmlspecialchars(trim($_POST['cargo_donante']));

            header("Location: report/generar_acta_donacion.php?id=".urlencode($id_prod)."&n_acta=".$n_acta.
            "&nombre_donante=".$nombre_donante."&cedula_donante=".$cedula_donante."&cargo_donante=".$cargo_donante);

        }
    }
?>