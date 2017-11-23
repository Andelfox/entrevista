<?php

 class reporteExcel {
    
    var $objPHPExcel;
    
    function __construct($oExcel){
        $this->objPHPExcel=$oExcel;
    }

    function valorCeldas($array_celdas){
        foreach($array_celdas as $celda=>$valor){
            $this->objPHPExcel->getActiveSheet()->setCellValue($celda, $valor);
        }
    }
    
    function valorCeldasMultiple($array_celdas){
        foreach($array_celdas as $dataFila){
            foreach($dataFila as $celda=>$valor){
                $this->objPHPExcel->getActiveSheet()->setCellValue($celda, $valor);
            }
        }
    }
    
    function combinarCeldas($array_celdas_combinadas){
        foreach($array_celdas_combinadas as $rango){
            $this->objPHPExcel->getActiveSheet()->mergeCells($rango);
        }
    }
    
    function centrarCeldas($array_alinear_centro){
        foreach($array_alinear_centro as $rango){
            $this->objPHPExcel->getActiveSheet()
            ->getStyle($rango)
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
            ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        }
    }
    
    function izquierdaCeldas($array_alinear_centro){
        foreach($array_alinear_centro as $rango){
            $this->objPHPExcel->getActiveSheet()
            ->getStyle($rango)
            ->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        }
    }
    

    function anchoColumnas($array_ancho_columnas){
        foreach($array_ancho_columnas as $columna=>$ancho){
            $this->objPHPExcel->getActiveSheet()
                ->getColumnDimension($columna)
                ->setWidth(($ancho+0.71));
        }
    }
    
    function aplicarBorde($celdas, $tipo_borde){
        $estilo_borde_superior = array('borders' => array('top' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $estilo_borde_inferior = array('borders' => array('bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $estilo_borde_izquierda = array('borders' => array('left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $estilo_borde_derecha = array('borders' => array('right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $estilo_borde_todos = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        
        switch($tipo_borde){
            case 'superior':
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_borde_superior, false);
                }
            break;
            case 'inferior':
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_borde_inferior, false);
                }
            break;
            case 'derecha':
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_borde_derecha, false);
                }
            break;
            case 'izquierda':
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_borde_izquierda, false);
                }
            break;
            default:
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_borde_todos, false);
                }
            break;
        }
    }
    
    function aplicarFuente($celdas, $estilo_fuente){
        $estilo_fuente_titulo1 = array('font' => array('name' => 'Arial', 'size' => '10', 'bold'  => true));
        $estilo_fuente_titulo2 = array('font' => array('name' => 'Arial', 'size' => '6', 'bold'  => true));
        $estilo_fuente_negrilla = array('font' => array('name' => 'Arial', 'size' => '9', 'bold'  => true));
        $estilo_fuente_negrilla_sub = array('font' => array('name' => 'Arial', 'size' => '8', 'bold'=>true));                                        
        $estilo_fuente_negrilla_sub_7 = array('font' => array('name' => 'Arial', 'size' => '7', 'bold'=>true));
        $estilo_fuente_sub = array('font' => array('name' => 'Arial', 'size' => '8', 'bold'  => false));
                                
                        
        switch($estilo_fuente){
            case 'titulo1':
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_fuente_titulo1, false);
                }
            break;
            case 'titulo2':
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_fuente_titulo2, false);
                }
            break;
            case 'negrilla':
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_fuente_negrilla, false);
                }
            break;
            case 'sub':
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_fuente_negrilla_sub, false);
                }
            break;
            case 'sub_7':
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_fuente_negrilla_sub_7, false);
                }
            break;
            case 'text_sub':
                foreach($celdas as $rango){
                    $this->objPHPExcel->getActiveSheet()->getStyle($rango)->applyFromArray($estilo_fuente_sub, false);
                }
            break;
        }
    }
    
    function formatoCelda($tipo, $celda){
        switch($tipo){
            case 'moneda':
                $this->objPHPExcel->getActiveSheet()->getStyle($celda)->getNumberFormat()->setFormatCode('"$"#,##0.00_-');
            break;
        }
    }
    
    function altoFila($array_alto_filas){
        foreach($array_alto_filas as $fila=>$alto){
            $this->objPHPExcel->getActiveSheet()
                ->getRowDimension($fila)
                ->setRowHeight($alto);
        }
    }
}