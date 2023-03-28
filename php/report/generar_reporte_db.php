<?php
require './vendor/autoload.php';
require('../mysqli_conexion.php');
require('../querys_inventario.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$array_bienes_registrados = obtener_bienes_registrados($conexion);
$array_campus = obtener_array_campus($conexion, $array_bienes_registrados);
$array_ubicacion = obtener_array_ubicacion($conexion, $array_bienes_registrados);
$array_resultado = obtener_codigos_prod($conexion, $array_bienes_registrados);




// Cargar la hoja de cálculo
$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();


// Combinar celdas de F1 a P1
$sheet->mergeCells('A1:Q1');

// Establecer el valor de la celda combinada
$sheet->setCellValue('A1', 'BIENES DEL INSTITUTO SUPERIOR TECNOLOGICO GUAYAQUIL');
$sheet->getStyle('A1')->applyFromArray([
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
    ],
]);

$sheet->mergeCells('A2:Q2');
$sheet->setCellValue('A2', 'CAMPUS CMI');
$sheet->getStyle('A2')->applyFromArray([
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
$sheet->getColumnDimension('D')->setWidth(35);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(50);
$sheet->getColumnDimension('G')->setWidth(50);
$sheet->getColumnDimension('H')->setWidth(25);
$sheet->getColumnDimension('I')->setWidth(35);
$sheet->getColumnDimension('J')->setWidth(35);
$sheet->getColumnDimension('K')->setWidth(40);
$sheet->getColumnDimension('L')->setWidth(50);
$sheet->getColumnDimension('M')->setWidth(20);
$sheet->getColumnDimension('N')->setWidth(15);
$sheet->getColumnDimension('O')->setWidth(15);
$sheet->getColumnDimension('P')->setWidth(25);
$sheet->getColumnDimension('Q')->setWidth(25);

// Obtener la fila 3
$row = 3;

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
    $sheet->getStyle('A'.strval($row_init).':Q'.strval($row_init))->applyFromArray($styleArray);


    $codigo_adicional = isset($array_resultado[$i][1]['codigo']) ? $array_resultado[$i][1]['codigo'] : '';

    $sheet->setCellValue('A'.$row_init, $No);
    $sheet->setCellValue('B'.$row_init, $array_campus[$i]);
    $sheet->setCellValue('C'.$row_init, $array_ubicacion[$i]);
    $sheet->setCellValue('D'.$row_init, $array_bienes_registrados[$i]['nombre']);
    $sheet->setCellValue('E'.$row_init, $array_resultado[$i][0]['codigo']);
    $sheet->setCellValue('F'.$row_init, $codigo_adicional);
    $sheet->setCellValue('G'.$row_init, $array_bienes_registrados[$i]['descripcion']);
    $sheet->setCellValue('H'.$row_init, 'DATO QUEMADO'); //ORIGEN DEL BIEN
    $sheet->setCellValue('I'.$row_init, 'DATO QUEMADO'); // ADMINISTRADOR
    $sheet->setCellValue('J'.$row_init, 'DATO QUEMADO'); // CUSTODIO
    $sheet->setCellValue('K'.$row_init, $array_bienes_registrados[$i]['proceso_de_adquisicion']);
    $sheet->setCellValue('L'.$row_init, $array_bienes_registrados[$i]['observaciones']); // OBSERVACIONES
    $sheet->setCellValue('M'.$row_init, 'DATO QUEMADO'); // TIPO DE ACTA
    $sheet->setCellValue('N'.$row_init, $array_bienes_registrados[$i]['#_acta']);
    $sheet->setCellValue('O'.$row_init, $array_bienes_registrados[$i]['año']);
    $sheet->setCellValue('P'.$row_init, 'DATO QUEMADO'); // ESTADO DE USO
    $sheet->setCellValue('Q'.$row_init, 'DATO QUEMADO'); // ESTADO FISICO
    $row_init++;
    $No++;
}


$writer = new Xlsx($spreadsheet);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');

?>