<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

require_once("../../class/class.php");
require_once("../../class/Informes.php");

$obj1 = new Informes();
$cantidadBanco = $obj1->cantidadPorBanco();

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Argentina/La_Rioja');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once '../../phpexel/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
// $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
// 							 ->setLastModifiedBy("Maarten Balliauw")
// 							 ->setTitle("Office 2007 XLSX Test Document")
// 							 ->setSubject("Office 2007 XLSX Test Document")
// 							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
// 							 ->setKeywords("office 2007 openxml php")
// 							 ->setCategory("Test result file");


// DATOS INGRESADOS
$tituloReporte = "CANTIDAD DE CUENTAS POR BANCO";
$titulosColumnas = array('BANCO', 'CANTIDAD');

// Se combinan las celdas A1 hasta D1, para colocar ahí el titulo del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->mergeCells('A1:B1');
 
// Se agregan los titulos del reporte
$objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A1',  $tituloReporte) // Titulo del reporte
    ->setCellValue('A3',  $titulosColumnas[0])  //Titulo de las columnas
    ->setCellValue('B3',  $titulosColumnas[1]);

$j=4;
for ($i=0; $i < sizeof($cantidadBanco); $i++) { 
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$j, $cantidadBanco[$i]["nombre"])
            ->setCellValue('B'.$j, $cantidadBanco[$i]["cantidad"]);
$j++;
}

//Estilo del Exel
$estiloTituloReporte = array(
			'font' => array(
			'name'      => 'Arial',
			'bold'      => true,
			'italic'    => false,
			'strike'    => false,
			'size' =>12,
			'color'     => array(
			'rgb' => 'FFFFFF'
        	       	)
            ),
	        'fill' => array(
				'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
				'color'	=> array('argb' => '0080C0')
			),
            'borders' => array(
               	'allborders' => array(
                	'style' => PHPExcel_Style_Border::BORDER_NONE                    
               	)
            ), 
            'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        			'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        			'rotation'   => 0,
        			'wrap'          => TRUE
    		)
        );

		$estiloTituloColumnas = array(
            'font' => array(
                'name'      => 'Arial',
                'size'		=> 10,                          
                'color'     => array(
                    'rgb' => 'FFFFFF'
                )
            ),
            'fill' 	=> array(
				'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
        		'color' => array(
            		'rgb' => '0080C0'
        		),
        		'endcolor'   => array(
            		'argb' => 'FFFFFF'
        		)
			),
         
			'alignment' =>  array(
        			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    		));
			
		$estiloInformacion = new PHPExcel_Style();
		$estiloInformacion->applyFromArray(
			array(
           		'font' => array(
               	'name'      => 'Arial',               
               	'color'     => array(
                   	'rgb' => '000000'
               	)
           	),
        ));
		 
		$objPHPExcel->getActiveSheet()->getStyle('A1:B1')->applyFromArray($estiloTituloReporte);
		$objPHPExcel->getActiveSheet()->getStyle('A3:B3')->applyFromArray($estiloTituloColumnas);		
		$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:B".($j-1));

//Ensancha de forma automatica las celda
for($i = 'A'; $i <= 'B'; $i++){
    $objPHPExcel->setActiveSheetIndex(0)->getColumnDimension($i)->setAutoSize(TRUE);
}


// Nombre de la Pestaña Exel
$objPHPExcel->getActiveSheet()->setTitle('Informe de Cuentas por Banco');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Informe de Cuentas por Banco.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
