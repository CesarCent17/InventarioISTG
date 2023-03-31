<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Cargar el archivo
$archivo = "plantilla_actas.xlsx";
$documento = IOFactory::load($archivo);

$id_prod = htmlspecialchars(trim($_GET['id']));
// Consulta
// $prod = obtener_producto_por_id($conexion, $id_prod);
// var_dump($prod);

// Seleccionar la hoja "ACTA"
$hoja_acta_entrega = $documento->getSheetByName('ACTA ENTREGA');

// Escribir valores en las celdas
$hoja_acta_entrega->setCellValue('C15', 'Valor C15'); // Codigo ISTG
// $hoja_acta_entrega->setCellValue('D15', $prod['nombre']); // Nombre General
// $hoja_acta_entrega->setCellValue('E15', $prod['descripcion']); // Descripcion
$hoja_acta_entrega->setCellValue('F15', 'Valor F15'); // Estado Fisico
$hoja_acta_entrega->setCellValue('G15', 'Valor G15'); // Campus
$hoja_acta_entrega->setCellValue('H15', 'Valor H15'); // Area de Ubicacion
// $hoja_acta_entrega->setCellValue('I15', $prod['observaciones']); // Observaciones

$hoja_acta_donacion = $documento->getSheetByName('ACTA DONACION');
$hoja_acta_donacion->setCellValue('B13', 'DATO QUEMADO');
// $hoja_acta_donacion->setCellValue('C13', $prod['nombre']);
// $hoja_acta_donacion->setCellValue('D13', $prod['descripcion']);
$hoja_acta_donacion->setCellValue('E13', 'DATO QUEMADO');
$hoja_acta_donacion->setCellValue('F13', 'DATO QUEMADO');
$hoja_acta_donacion->setCellValue('G13', 'DATO QUEMADO');
// $hoja_acta_donacion->setCellValue('H13', $prod['observaciones']);


// Guardar el archivo modificado en memoria
$writer = IOFactory::createWriter($documento, 'Xlsx');
ob_start(); // Iniciar el buffer de salida
$writer->save('php://output'); // Guardar el archivo en memoria

// Establecer las cabeceras HTTP para descargar el archivo
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="actas.xlsx"');
header('Cache-Control: max-age=0');

// Imprimir el contenido del archivo
echo ob_get_clean();
?>