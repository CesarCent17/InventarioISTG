<?php
    require('mysqli_conexion.php');
    require('querys_campus.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Requeridos
            if($_POST['campus'] === 'completo'){
                header("Location: report/generar_reporte_inventario_completo.php");
            } else{
                $id_campus = htmlspecialchars(trim($_POST['campus']));
                header("Location: report/generar_reporte_campus.php?id=".urlencode($id_campus));
            }
        }
    }
?>