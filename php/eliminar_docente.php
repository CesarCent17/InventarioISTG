<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cedula = isset($_POST['cedula']) ? htmlspecialchars($_POST['cedula']) : '';
        echo $cedula.' '.'Estamos en eliminar docente POST';
    } 
?>