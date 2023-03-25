<?php
require('mysqli_conexion.php');
require('querys_docente.php');
session_start();
// Verificamos que el usuario esté iniciado sesión
if(!isset($_SESSION['usuario'])) {
   // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
   header("Location: login.php");
} else {
   //Si el usuario tiene una sesion y esta utilizando el metodo POST
   if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    
    // Requeridos
    $cedula = htmlspecialchars(trim($_POST['cedula']));
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $apellido = htmlspecialchars(trim($_POST['apellido']));
    $nombre = strtoupper($nombre);
    $apellido = strtoupper($apellido);
    insert_docente($conexion, $cedula, $nombre, $apellido);
   }
}
?>