<?php
    require('mysqli_conexion.php');
    // require('querys_area_de_ubicacion.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cedula = trim($_POST['cedula']);
            $accion = trim($_POST['accion']);
            if ($accion === 'editar'){
                echo "<form id='form_redirect' action='../views/editar_docente.php' method='POST'>";
                echo "<input type='hidden' name='cedula' value='".htmlspecialchars($cedula)."'>";
                echo "</form>";
                echo "<script>document.getElementById('form_redirect').submit();</script>";
            

            } elseif($accion === 'eliminar'){
                echo "<form id='form_redirect' action='eliminar_docente.php' method='POST'>";
                echo "<input type='hidden' name='cedula' value='".htmlspecialchars($cedula)."'>";
                echo "</form>";
                echo "<script>document.getElementById('form_redirect').submit();</script>";
            }
        }
    }

?>