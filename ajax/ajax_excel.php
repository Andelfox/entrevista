<?php

$aData = json_decode(file_get_contents('php://input'), true);

include '../libs/phpExcel/Classes/PHPExcel.php';
include '../class/reporteExcel.php';

$direccion = explode('ajax', getcwd());

$sFileName = 'files/informe_' . rand(111111, 999999) . '.xlsx';
$rutaFisica = $direccion[0] . $sFileName;
//chmod($rutaFisica, 0777);
//unlink($rutaFisica);

$objPHPExcel = new PHPExcel();
$oExcel = new reporteExcel($objPHPExcel);
$objPHPExcel->getActiveSheet()->setTitle('Informe');

$fila = 1;
 $array = array('B' . $fila . ':E' . $fila);
            $oExcel->aplicarBorde($array, "todos");
            $oExcel->aplicarFuente($array, "negrilla");
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $fila, "Titulo");
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $fila, "Link Pagina");
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $fila, "Pagina");
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $fila, "Descripcion");
    
            
$fila++;

foreach ($aData['datos']['items'] as $item) {
    
    $titulo = $item['title'];
    $linkPagina = $item['link'];
    $pagina = $item['displayLink'];
    $descripcion = $item['snippet'];

    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1, $fila, $titulo);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2, $fila, $linkPagina);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3, $fila, $pagina);
    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4, $fila, $descripcion);
 $array = array('B' . $fila . ':E' . $fila);
            $oExcel->aplicarBorde($array, "todos");
    $fila++;
}
 
 $arrayTamaño = array('B' => 40);
    $oExcel->anchoColumnas($arrayTamaño);
     $arrayTamaño = array('C' => 70);
    $oExcel->anchoColumnas($arrayTamaño);
     $arrayTamaño = array('D' => 40);
    $oExcel->anchoColumnas($arrayTamaño);
     $arrayTamaño = array('E' => 400);
    $oExcel->anchoColumnas($arrayTamaño);
    
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save("../" . $sFileName);

$ip = $_SERVER['SERVER_NAME'];
$puerto = $_SERVER["SERVER_PORT"];
if ($puerto != "")
    $ip .= ':' . $puerto;


$rutaCompleta = "http://".$ip ."/testApp/". $sFileName;
echo $rutaCompleta;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

