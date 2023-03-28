<?php
require './vendor/autoload.php';
require('../mysqli_conexion.php');
require('../querys_inventario.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$id_campus = htmlspecialchars(trim($_GET['id']));
$array_bienes_registrados = obtener_bienes_registrados_campus($conexion, $id_campus);
$array_campus = obtener_array_campus($conexion, $array_bienes_registrados);
$array_ubicacion = obtener_array_ubicacion($conexion, $array_bienes_registrados);
$array_resultado = obtener_codigos_prod($conexion, $array_bienes_registrados);
$array_origen = obtener_array_origen($conexion, $array_bienes_registrados);

$array_administrador = obtener_array_administrador($conexion, $array_bienes_registrados);
$array_custodio = obtener_array_custodio($conexion, $array_bienes_registrados);
$array_tipo_acta = obtener_array_tipo_acta($conexion, $array_bienes_registrados);
$array_estado_de_uso = obtener_array_estado_uso($conexion, $array_bienes_registrados);
$array_estado_fisico = obtener_array_estado_fisico($conexion, $array_bienes_registrados);

$campus = $array_campus[0];

// Cargar la hoja de cálculo
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Agregar imagen como icono
$icono = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$icono->setPath('../../assets/icons/logoISTG.ico');
$icono->setWidth(60); // Establecer el ancho de la imagen
$icono->setHeight(60); // Establecer el alto de la imagen
$icono->setCoordinates('G1'); // Establecer la celda donde se insertará la imagen
$icono->setWorksheet($sheet);
$icono->setOffsetX(250);

// Combinar celdas de F1 a P1
$sheet->mergeCells('B1:Q1');

// Establecer el valor de la celda combinada
$sheet->setCellValue('B1', 'BIENES DEL INSTITUTO SUPERIOR TECNOLOGICO GUAYAQUIL');
$sheet->getStyle('B1')->applyFromArray([
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
]);
$sheet->getRowDimension(1)->setRowHeight(40);

$sheet->mergeCells('B2:Q2');
$sheet->setCellValue('B2', $campus);
$sheet->getStyle('B2')->applyFromArray([
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
]);

$sheet->getColumnDimension('A')->setWidth(10);
$sheet->getColumnDimension('B')->setWidth(35);
$sheet->getColumnDimension('C')->setWidth(35);
$sheet->getColumnDimension('D')->setWidth(45);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(50);
$sheet->getColumnDimension('G')->setWidth(60);
$sheet->getColumnDimension('H')->setWidth(25);
$sheet->getColumnDimension('I')->setWidth(40);
$sheet->getColumnDimension('J')->setWidth(40);
$sheet->getColumnDimension('K')->setWidth(40);
$sheet->getColumnDimension('L')->setWidth(50);
$sheet->getColumnDimension('M')->setWidth(20);
$sheet->getColumnDimension('N')->setWidth(15);
$sheet->getColumnDimension('O')->setWidth(15);
$sheet->getColumnDimension('P')->setWidth(25);
$sheet->getColumnDimension('Q')->setWidth(25);

// Obtener la fila 3
$row = 4;

// Establecer los valores de las celdas
$sheet->setCellValue('A'.$row, 'No');
$sheet->setCellValue('B'.$row, 'CAMPUS');
$sheet->setCellValue('C'.$row, 'AREA DE UBICACIÓN');
$sheet->setCellValue('D'.$row, 'NOMBRE  GENERAL');
$sheet->setCellValue('E'.$row, 'CODIGO  ITENS ISTG');
$sheet->setCellValue('F'.$row, 'CODIGO SENESCYT/SECAP/COLEGIO');
$sheet->setCellValue('G'.$row, 'DESCRIPCION');
$sheet->setCellValue('H'.$row, 'ORIGEN DEL BIEN');
$sheet->setCellValue('I'.$row, 'ADMINISTRADOR');
$sheet->setCellValue('J'.$row, 'CUSTODIO');
$sheet->setCellValue('K'.$row, 'PROCESO DE AQUISICIÓN');
$sheet->setCellValue('L'.$row, 'OBSERVACIONES');
$sheet->setCellValue('M'.$row, 'TIPO DE ACTA');
$sheet->setCellValue('N'.$row, '# ACTA');
$sheet->setCellValue('O'.$row, 'AÑO');
$sheet->setCellValue('P'.$row, 'ESTADO DE USO');
$sheet->setCellValue('Q'.$row, 'ESTADO FÍSICO');


$styleArray = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
];
$sheet->getStyle('A3:Q3')->applyFromArray($styleArray);

$No = 1;
$row_init = 4;
for ($i = 0; $i < count($array_bienes_registrados); $i++){

    // Estilo para las filas 4 en adelante
    $styleArray = [
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ],
    ];
    // $styleArray['wrapText'] = true;
    $sheet->getStyle('A'.strval($row_init).':Q'.strval($row_init))->applyFromArray($styleArray);


    $codigo_adicional = isset($array_resultado[$i][1]['codigo']) ? $array_resultado[$i][1]['codigo'] : '';

    $sheet->setCellValue('A'.$row_init, $No);
    $sheet->setCellValue('B'.$row_init, $array_campus[$i]);
    $sheet->setCellValue('C'.$row_init, $array_ubicacion[$i]);
    $sheet->setCellValue('D'.$row_init, $array_bienes_registrados[$i]['nombre']);
    $sheet->setCellValue('E'.$row_init, $array_resultado[$i][0]['codigo']);
    $sheet->setCellValue('F'.$row_init, $codigo_adicional);
    $sheet->setCellValue('G'.$row_init, $array_bienes_registrados[$i]['descripcion']);
    $cell = $sheet->getCell('G'.$row_init);
    $cell->getStyle()->getAlignment()->setWrapText(true);
    $sheet->setCellValue('H'.$row_init, $array_origen[$i]); //ORIGEN DEL BIEN
    $sheet->setCellValue('I'.$row_init, $array_administrador[$i]); // ADMINISTRADOR
    $sheet->setCellValue('J'.$row_init, $array_custodio[$i]); // CUSTODIO
    $sheet->setCellValue('K'.$row_init, $array_bienes_registrados[$i]['proceso_de_adquisicion']);
    $sheet->setCellValue('L'.$row_init, $array_bienes_registrados[$i]['observaciones']); // OBSERVACIONES
    $cell = $sheet->getCell('L'.$row_init);
    $cell->getStyle()->getAlignment()->setWrapText(true);
    $sheet->setCellValue('M'.$row_init, $array_tipo_acta[$i]); // TIPO DE ACTA
    $sheet->setCellValue('N'.$row_init, $array_bienes_registrados[$i]['#_acta']);
    $sheet->setCellValue('O'.$row_init, $array_bienes_registrados[$i]['año']);
    $sheet->setCellValue('P'.$row_init, $array_estado_de_uso[$i]); // ESTADO DE USO
    $sheet->setCellValue('Q'.$row_init, $array_estado_fisico[$i]); // ESTADO FISICO
    $row_init++;
    $No++;
}


$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');

?>