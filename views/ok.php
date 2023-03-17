<?php
require('../php/mysqli_conexion.php');
require('../php/querys_ver_detalle.php');
echo "llegue afuera del if";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $numero_de_acta = $_POST['numero_de_acta'];
    $anio = $_POST['anio'];
    $area_de_ubicacion = $_POST['area_de_ubicacion'];
    $codigoISTG = $_POST['codigoISTG'];
    $codigoAdicional = $_POST['codigoAdicional'];
    $origen_del_bien = $_POST['origen_del_bien'];
    $custodio = $_POST['custodio'];
    $proceso_de_adquisicion = $_POST['proceso_de_adquisicion'];
    $estado_de_uso = $_POST['estado_de_uso'];
    $estado_fisico = $_POST['estado_fisico'];
    $acta_de_donacion = $_POST['acta_de_donacion'];
    $observaciones = $_POST['observaciones'];
	
    var_dump($nombre, $descripcion, $numero_de_acta, $anio, $area_de_ubicacion, $codigoISTG, $codigoAdicional, $origen_del_bien, $custodio, $proceso_de_adquisicion, $estado_de_uso, $estado_fisico, $acta_de_donacion, $observaciones);
}


?>