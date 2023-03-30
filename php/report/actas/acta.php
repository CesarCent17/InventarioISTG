<?php
    require '../vendor/autoload.php';
 use PhpOffice\PhpSpreadsheet\IOFactory;
 use PhpOffice\PhpSpreadsheet\Spreadsheet;

session_start();
if(!isset($_SESSION['usuario'])) {
    // Si el usuario no está iniciado sesión, lo redirigimos a la página de inicio de sesión
    header("Location: ../views/login.php");
    exit();
} else {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['bien'])) {
            $bien = unserialize($_POST['bien']);
            $nombre = $bien['nombre'];
            $descripcion = $bien['descripcion'];
            $observaciones = $bien['observaciones'];
            $campus = $bien['campus'];
            $estado_fisico = $bien['estado_fisico'];
            $area_de_ubicacion = $bien['area_de_ubicacion'];
            $codigoISTG = $bien['codigoISTG'];
            
            // Cargar el archivo
            $archivo = "plantilla_actas.xlsx";
            $documento = IOFactory::load($archivo);

            // Seleccionar la hoja "ACTA"
            $hoja_acta_entrega = $documento->getSheetByName('ACTA ENTREGA');

            // Escribir valores en las celdas
            $hoja_acta_entrega->setCellValue('C15', $codigoISTG); // Codigo ISTG
            $hoja_acta_entrega->setCellValue('D15', $nombre); // Nombre General
            $hoja_acta_entrega->setCellValue('E15', $descripcion); // Descripcion
            $hoja_acta_entrega->setCellValue('F15', $estado_fisico); // Estado Fisico
            $hoja_acta_entrega->setCellValue('G15', $campus); // Campus
            $hoja_acta_entrega->setCellValue('H15', $area_de_ubicacion); // Area de Ubicacion
            $hoja_acta_entrega->setCellValue('I15', $observaciones); // Observaciones

            $hoja_acta_donacion = $documento->getSheetByName('ACTA DONACION');
            $hoja_acta_donacion->setCellValue('B13', $codigoISTG);
            $hoja_acta_donacion->setCellValue('C13', $nombre);
            $hoja_acta_donacion->setCellValue('D13', $descripcion);
            $hoja_acta_donacion->setCellValue('E13', $estado_fisico);
            $hoja_acta_donacion->setCellValue('F13', $campus);
            $hoja_acta_donacion->setCellValue('G13', $area_de_ubicacion);
            $hoja_acta_donacion->setCellValue('H13', $observaciones);

            // Definir el tipo de archivo a descargar
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            // Definir el nombre del archivo a descargar
            header('Content-Disposition: attachment;filename="plantilla_actas.xlsx"');
            // Enviar el archivo al navegador
            $writer = IOFactory::createWriter($documento, 'Xlsx');
            $writer->save('php://output');
        }
        
    }
}
?>
