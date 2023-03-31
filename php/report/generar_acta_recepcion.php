<?php 
    require ('./vendor/autoload.php');
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    require('../mysqli_conexion.php');
    require('querys_actas.php');
    require('../querys_inventario.php');
   

    $id_prod = htmlspecialchars(trim($_GET['id']));
    $prod = obtener_producto_por_id($conexion, $id_prod);
    // echo "<script> console.log(" . json_encode($prod) . "); </script>";

    $array_codigo_de_producto = obtener_array_codigo_de_producto($conexion, $id_prod);

    $nombre = $prod['nombre'];
    $descripcion = $prod['descripcion'];
    $observaciones = $prod['observaciones'];
    $campus = obtener_campus_por_id($conexion, $id_prod);
    $estado_fisico = obtener_estado_fisico($conexion, $id_prod);
    $area_de_ubicacion = obtener_ubicacion_por_id($conexion, $id_prod);
    $codigoISTG = $array_codigo_de_producto[0]['codigo'];

    $bien = array(
        'nombre' => $nombre,
        'descripcion' => $descripcion,
        'observaciones' => $observaciones,
        'campus' => $campus,
        'estado_fisico' => $estado_fisico,
        'area_de_ubicacion' => $area_de_ubicacion,
        'codigoISTG' => $codigoISTG
    );
    // echo "<script> console.log(" . json_encode($bien) . "); </script>";

// Cargar el archivo
$archivo = "plantilla_acta_recepcion.xlsx";
$documento = IOFactory::load($archivo);


// Seleccionar la hoja "ACTA ENTREGA"
 $hoja_acta_entrega = $documento->getSheetByName('ACTA ENTREGA');

// Escribir valores en las celdas
$hoja_acta_entrega->setCellValue('C15', $bien['codigoISTG']); // Codigo ISTG
$hoja_acta_entrega->setCellValue('D15', $bien['nombre']); // Nombre General
$hoja_acta_entrega->setCellValue('E15', $bien['descripcion']); // Descripcion
$hoja_acta_entrega->setCellValue('F15', $bien['estado_fisico']); // Estado Fisico
$hoja_acta_entrega->setCellValue('G15', $bien['campus']); // Campus
$hoja_acta_entrega->setCellValue('H15', $bien['area_de_ubicacion']); // Area de Ubicacion
$hoja_acta_entrega->setCellValue('I15', $bien['observaciones']); // Observaciones



date_default_timezone_set('America/Guayaquil');
setlocale(LC_TIME, 'es_ES.UTF-8');

$dia_actual = date('d');
$mes_actual = date('F');

$meses = [
    'January' => 'Enero',
    'February' => 'Febrero',
    'March' => 'Marzo',
    'April' => 'Abril',
    'May' => 'Mayo',
    'June' => 'Junio',
    'July' => 'Julio',
    'August' => 'Agosto',
    'September' => 'Septiembre',
    'October' => 'Octubre',
    'November' => 'Noviembre',
    'December' => 'Diciembre'
];

$mes_actual_espanol = $meses[$mes_actual];
$anio_actual = date('Y');

$ubicacion_oficina = "TEXTO";
$custodio_administrativo = "TEXTO";
$recibe = "TEXTO";
$cargo = "TEXTO";
$n_acta = "N° 00001-ISTG-EJEMPLO";
$nombre_entrega = "NOMBRE DE EJEMPLO";
$cedula_entrega = "0987654321";
$nombre_recibe = "NOMBRE DE EJEMPLO";
$cedula_recibe = "0987654321";

$string_A11_J11 = 'En la ciudad de Guayaquil, Provincia de Guayas a los '.$dia_actual.' días del mes de '.$mes_actual_espanol.' de '.$anio_actual.', en las oficinas del ISTG, ubicadas '.$ubicacion_oficina.' se reúnen por una parte '.$custodio_administrativo.', en calidad de Custodio Administrativo, y quien recibe '.$recibe.', quien labora físicamente en  el ISTG  con cargo de '.$cargo.' con el fin de realizar el acta de entrega recepción de los bienes que se detalla a continuación, conforme lo indica el reglamento general para la Administración, Utilización, Manejo y Control de los bienes e inventarios del sector público en su capítulo III, Art. 41.';
$hoja_acta_entrega->setCellValue('A11', $string_A11_J11);
$hoja_acta_entrega->mergeCells('A11:J11');
$hoja_acta_entrega->setCellValue('I9', $n_acta);
$hoja_acta_entrega->setCellValue('D35', $nombre_entrega);
$hoja_acta_entrega->setCellValue('D36', $cedula_entrega);

$hoja_acta_entrega->setCellValue('G35', $nombre_recibe);
$hoja_acta_entrega->mergeCells('G35:H35');
$hoja_acta_entrega->setCellValue('G36', $cedula_recibe);
$hoja_acta_entrega->mergeCells('G36:H36');




 $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($documento);
 ob_start(); // Iniciar el buffer de salida

 // Establecer las cabeceras HTTP para descargar el archivo
 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 header('Content-Disposition: attachment;filename="ACTA DE ENTREGA RECEPCIÓN DE BIENES.xlsx"');
 header('Cache-Control: max-age=0');
 $writer->save('php://output'); // Guardar el archivo en memoria

 // Imprimir el contenido del archivo
 echo ob_get_clean();


?>