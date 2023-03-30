<?php
    require('mysqli_conexion.php');

    session_start();
    if(!isset($_SESSION['usuario'])) {
        // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
        header("Location: ../views/login.php");
    } else {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_prod = htmlspecialchars(trim($_POST['id_prod']));
            header("Location: report/actas/generar_actas.php?id=".urlencode($id_prod));
        }
    }
?>