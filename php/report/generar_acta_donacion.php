<?php 
    require ('./vendor/autoload.php');
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    require('../mysqli_conexion.php');
    require('querys_actas.php');
    require('../querys_inventario.php');
   

    $id_prod = htmlspecialchars(trim($_GET['id']));
    $prod = obtener_producto_por_id($conexion, $id_prod);
    $n_acta = htmlspecialchars(trim($_GET['n_acta']));
    $nombre_donante = htmlspecialchars(trim($_GET['nombre_donante']));
    $cedula_donante = htmlspecialchars(trim($_GET['cedula_donante']));
    $cargo_donante = htmlspecialchars(trim($_GET['cargo_donante']));

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

    // Cargar el archivo
    $archivo = "plantilla_acta_donacion_istg.xlsx";
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


    $nombre_rectora = "Alma Rosa Zeballos Proaño";
    $nombre_rectora = "Alma Rosa Zeballos ProaÑo";
    $nombre_rectora = strtoupper($nombre_rectora);
    $cedula_rectora = "0909173247";

    $string_AJ9 = 'En la ciudad de Guayaquil, a los '.$dia_actual.' días del mes de '.$mes_actual_espanol.' del '.$anio_actual.', se reúnen para celebrar un acto de donación de bienes, por una parte la Mgs. '.$nombre_rectora.', en calidad de rectora del Instituto Superior Tecnológico Guayaquil y por otra parte '.$nombre_donante.', en calidad de '.$cargo_donante.' a quien se le denomina donador. 

El Sr/Sra '.$nombre_donante.' realizará la donación de bienes muebles al Instituto Superior Tecnológico Guayaquil, los mismos que detallan a continuación.  ';

    $string_AJ16 = 'El donador de manera voluntaria, decide hacer la donación del bien para uso exclusivo del Instituto Superior Tecnológico Guayaquil. 
Para constancia de lo actuado y en fe de conformidad y aceptación suscriben la presente acta en 3 ejemplares de igual tenor y efecto la Mgs. '.$nombre_rectora.' en calidad de rectora del Instituto Tecnológico Superior Guayaquil y el Sr/Sra. '.$nombre_donante.' a quien se le denomina donador';

    $hoja_acta_donacion->setCellValue('H8', 'N° '.$n_acta);
    $hoja_acta_donacion->setCellValue('A9', $string_AJ9);
    $hoja_acta_donacion->mergeCells('A9:J9');

    $hoja_acta_donacion->setCellValue('A16', $string_AJ16);
    $hoja_acta_donacion->mergeCells('A16:J16');

    $hoja_acta_donacion->setCellValue('G27', $nombre_rectora);
    $hoja_acta_donacion->mergeCells('G27:H27');
    $hoja_acta_donacion->setCellValue('G28', $cedula_rectora);
    $hoja_acta_donacion->mergeCells('G28:H28');

    $hoja_acta_donacion->setCellValue('B27', $nombre_donante);
    $hoja_acta_donacion->setCellValue('B28', $cedula_donante);

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