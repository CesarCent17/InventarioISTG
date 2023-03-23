<?php
    require('mysqli_conexion.php');
    session_start();
    session_destroy();
    mysqli_close($conexion);
    header("Location: ../views/login.php");
    exit;
?>