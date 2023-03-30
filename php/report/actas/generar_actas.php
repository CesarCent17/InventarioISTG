<?php
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Cargar el archivo
$archivo = "propuesta actas.xlsx";
$documento = IOFactory::load($archivo);

// Seleccionar la hoja "ACTA"
$hoja = $documento->getSheetByName('ACTA');

// Escribir valores en las celdas
$hoja->setCellValue('C15', 'Valor C15');
$hoja->setCellValue('D15', 'Valor D15');
$hoja->setCellValue('E15', 'Valor E15');
$hoja->setCellValue('F15', 'Valor F15');
$hoja->setCellValue('G15', 'Valor G15');
$hoja->setCellValue('H15', 'Valor H15');
$hoja->setCellValue('I15', 'Valor I15');

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
