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
    $archivo = "plantilla_acta_donacion.xlsx";
    $documento = IOFactory::load($archivo);


    $hoja_acta_donacion = $documento->getSheetByName('ACTA DONACION');
    $hoja_acta_donacion->setCellValue('B13', $bien['codigoISTG']);
    $hoja_acta_donacion->setCellValue('C13', $bien['nombre']);
    $hoja_acta_donacion->setCellValue('D13', $bien['descripcion']);
    $hoja_acta_donacion->setCellValue('E13', $bien['estado_fisico']);
    $hoja_acta_donacion->setCellValue('F13', $bien['campus']);
    $hoja_acta_donacion->setCellValue('G13', $bien['area_de_ubicacion']);
    $hoja_acta_donacion->setCellValue('H13', $bien['observaciones']);


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
    $rectora = "TEXTO";
    $donante = "TEXTO";
    $n_acta = "N° 00001-ISTG-EJEMPLO";
    $nombre_entrega = "NOMBRE DE EJEMPLO";
    $cedula_entrega = "0987654321";
    $nombre_recibe = "NOMBRE DE EJEMPLO";
    $cedula_recibe = "0987654321";

    $string_AJ8 = 'En la ciudad de Guayaquil, Provincia de Guayas a los '.$dia_actual.' días del mes de '.$mes_actual_espanol.' de '.$anio_actual.', en las oficinas del ISTG, ubicadas '.$ubicacion_oficina.' se reúnen por una parte '.$rectora.', en calidad de Rectora, y  por otra parte '.$donante.' en calidad de donante . ';
    $string_AJ10 = $donante.' realizará la donación de bienes muebles al Instituto Superior Tecnológico Guayaquil, los mismos que se detallan a continuación.  ';

    $hoja_acta_donacion->setCellValue('A8', $string_AJ8);
    $hoja_acta_donacion->mergeCells('A8:J8');

    $hoja_acta_donacion->setCellValue('A10', $string_AJ10);
    $hoja_acta_donacion->mergeCells('A10:J10');
    $hoja_acta_donacion->setCellValue('H7', $n_acta);
    $hoja_acta_donacion->setCellValue('B29', $nombre_entrega);
    $hoja_acta_donacion->setCellValue('B30', $cedula_entrega);
    $hoja_acta_donacion->setCellValue('G29', $nombre_recibe);
    $hoja_acta_donacion->setCellValue('G30', $cedula_recibe);



    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($documento);
    ob_start(); // Iniciar el buffer de salida

    // Establecer las cabeceras HTTP para descargar el archivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ACTA DE DONACION.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output'); // Guardar el archivo en memoria

    // Imprimir el contenido del archivo
    echo ob_get_clean();


?>