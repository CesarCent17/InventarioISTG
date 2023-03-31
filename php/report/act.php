<?php 
 require ('./vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

// Cargar el archivo
$archivo = "actas/plantilla_actas.xlsx";
$documento = IOFactory::load($archivo);


 // Seleccionar la hoja "ACTA"
 $hoja_acta_entrega = $documento->getSheetByName('ACTA ENTREGA');

 // Escribir valores en las celdas
 $hoja_acta_entrega->setCellValue('C15', 'Valor C15'); // Codigo ISTG
 
 $hoja_acta_entrega->setCellValue('F15', 'Valor F15'); // Estado Fisico
 $hoja_acta_entrega->setCellValue('G15', 'Valor G15'); // Campus
 $hoja_acta_entrega->setCellValue('H15', 'Valor H15'); // Area de Ubicacion


 // Seleccionar la hoja "ACTA DONACION"
 $hoja_acta_donacion = $documento->getSheetByName('ACTA DONACION');

 // Escribir valores en las celdas
 $hoja_acta_donacion->setCellValue('B13', 'DATO QUEMADO');
 
 $hoja_acta_donacion->setCellValue('E13', 'DATO QUEMADO');
 $hoja_acta_donacion->setCellValue('F13', 'DATO QUEMADO');
 $hoja_acta_donacion->setCellValue('G13', 'DATO QUEMADO');

 $writer = IOFactory::createWriter($documento, 'Xlsx');
 ob_start(); // Iniciar el buffer de salida

 // Establecer las cabeceras HTTP para descargar el archivo
 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 header('Content-Disposition: attachment;filename="actas.xlsx"');
 header('Cache-Control: max-age=0');
 $writer->save('php://output'); // Guardar el archivo en memoria

 // Imprimir el contenido del archivo
 echo ob_get_clean();

?>