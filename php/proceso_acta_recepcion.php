<?php
    require('mysqli_conexion.php');
    require('querys_actas.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_prod = htmlspecialchars(trim($_POST['bien']));
            $n_acta = htmlspecialchars(trim($_POST['n_acta']));
            $id_custodio_administrativo = htmlspecialchars(trim($_POST['administrador']));
            $id_receptor = htmlspecialchars(trim($_POST['receptor']));
            $ubicacion_oficina = htmlspecialchars(trim($_POST['campus']));
            $cargo_receptor = htmlspecialchars(trim($_POST['cargo_receptor']));
            $cargo_receptor = strtoupper($cargo_receptor);



            $fila_custodio_administrativo = obtener_custodio_administrativo_por_id($conexion, $id_custodio_administrativo);
            $nombre_custodio_administrativo = $fila_custodio_administrativo['nombres_completos'];
            $cedula_custodio_administrativo = $fila_custodio_administrativo['cedula'];

            $fila_receptor = obtener_receptor_por_id($conexion, $id_receptor);
            $nombre_receptor = $fila_receptor['nombres_completos'];
            $cedula_receptor = $fila_receptor['cedula'];
           


            echo 'el custodio_administrativo se llama: '.$nombre_custodio_administrativo.'y su cedula es: '.$cedula_custodio_administrativo.'<br>';
            echo 'el receptor se llama: '.$nombre_receptor.'y su cedula es: '.$cedula_receptor;

            header("Location: report/generar_acta_recepcion.php?id=".urlencode($id_prod)."&n_acta=".$n_acta.
            "&nombre_custodio_administrativo=".$nombre_custodio_administrativo.
            "&cedula_custodio_administrativo=".$cedula_custodio_administrativo.
            "&nombre_receptor=".$nombre_receptor.
            "&cedula_receptor=".$cedula_receptor.
            "&cargo_receptor=".$cargo_receptor.
            "&ubicacion_oficina=".$ubicacion_oficina);
        }
    }
?>