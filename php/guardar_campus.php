<?php
require('mysqli_conexion.php');
require('querys_campus.php');
session_start();
// Verificamos que el usuario esté iniciado sesión
if(!isset($_SESSION['usuario'])) {
   // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
   header("Location: login.php");
} else {
   //Si el usuario tiene una sesion y esta utilizando el metodo POST
   if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    
    // Requeridos
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['direccion'];
    insert_campus($conexion, $nombre, $descripcion);
   }
}


?>