<?php
    require('mysqli_conexion.php');
    // require('querys_proceso_acta.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_prod = htmlspecialchars(trim($_POST['bien']));
            $n_acta = htmlspecialchars(trim($_POST['n_acta']));
            $custodio_administrativo = htmlspecialchars(trim($_POST['administrador']));
            $receptor = htmlspecialchars(trim($_POST['receptor']));
            $ubicacion_oficina = htmlspecialchars(trim($_POST['campus']));


            // echo $n_acta;
            // $prod = obtener_producto_por_id($conexion, $id_prod);
            // echo $prod['nombre'];
            // echo "ACTA RECEPCION";
            header("Location: report/generar_acta_recepcion.php?id=".urlencode($id_prod)."&n_acta=".$n_acta."&custodio_administrativo=".$custodio_administrativo."&receptor=".$receptor."&ubicacion_oficina=".$ubicacion_oficina);
        }
    }
?>