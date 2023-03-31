<?php 
    require ('./vendor/autoload.php');
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    require('../mysqli_conexion.php');
    // require('../querys_ver_detalle.php');
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
$archivo = "actas/plantilla_actas.xlsx";
$documento = IOFactory::load($archivo);


//  // Seleccionar la hoja "ACTA"
 $hoja_acta_entrega = $documento->getSheetByName('ACTA ENTREGA');

//  // Escribir valores en las celdas
 $hoja_acta_entrega->setCellValue('C15', $bien['codigoISTG']); // Codigo ISTG
$hoja_acta_entrega->setCellValue('D15', $bien['nombre']); // Nombre General
$hoja_acta_entrega->setCellValue('E15', $bien['descripcion']); // Descripcion
$hoja_acta_entrega->setCellValue('F15', $bien['estado_fisico']); // Estado Fisico
$hoja_acta_entrega->setCellValue('G15', $bien['campus']); // Campus
$hoja_acta_entrega->setCellValue('H15', $bien['area_de_ubicacion']); // Area de Ubicacion
$hoja_acta_entrega->setCellValue('I15', $bien['observaciones']); // Observaciones


 // Seleccionar la hoja "ACTA DONACION"
//  $hoja_acta_donacion = $documento->getSheetByName('ACTA DONACION');

 // Escribir valores en las celdas
//  $hoja_acta_donacion->setCellValue('B13', 'DATO QUEMADO');
 
//  $hoja_acta_donacion->setCellValue('E13', 'DATO QUEMADO');
//  $hoja_acta_donacion->setCellValue('F13', 'DATO QUEMADO');
//  $hoja_acta_donacion->setCellValue('G13', 'DATO QUEMADO');

//  $writer = IOFactory::createWriter($documento, 'Xlsx');
 $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($documento);
 ob_start(); // Iniciar el buffer de salida

 // Establecer las cabeceras HTTP para descargar el archivo
 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 header('Content-Disposition: attachment;filename="actas.xlsx"');
 header('Cache-Control: max-age=0');
 $writer->save('php://output'); // Guardar el archivo en memoria

 // Imprimir el contenido del archivo
 echo ob_get_clean();


?>