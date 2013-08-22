<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2010 PHPExcel
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
 * @copyright  Copyright (c) 2006 - 2010 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.4, 2010-08-26
 */

/** Error reporting */
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once 'Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("IVAN ZUÑIGA PEREZ")
							 ->setLastModifiedBy("IVAN ZUÑIGA PEREZ")
							 ->setTitle("Concentrado AstraZeneca Fenix")
							 ->setSubject("Concentrado AstraZeneca Fenix")
							 ->setDescription("Concentrado AstraZeneca Fenix")
							 ->setKeywords("Concentrado AstraZeneca Fenix")
							 ->setCategory("Concentrado AstraZeneca Fenix");



$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Concentrado AstraZeneca Fenix')
            ->setCellValue('A2', utf8_encode('Año: 2010'))
            ;



$ini=4;
$i = 1;

$hasta = $ini + $registros;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($serie[$i++].$ini, 'Descripcion')
            ->setCellValue($serie[$i++].$ini, 'Nov. Reg.')
            ->setCellValue($serie[$i++].$ini, 'Nov. Gra.')
            ->setCellValue($serie[$i++].$ini, 'Dic. Reg.')
            ->setCellValue($serie[$i++].$ini, 'Dic. gra.')
            ->setCellValue($serie[$i++].$ini, 'Tot. Reg.')
            ->setCellValue($serie[$i++].$ini, 'Tot. Gra.')
            ;
            

$num = 5;
$num2 = 5;




foreach ($query->result() as $row)
{
$i = 1;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($serie[$i++].$num, $row->descripcion)
            ->setCellValue($serie[$i++].$num, $row->novr)
            ->setCellValue($serie[$i++].$num, $row->novg)
            ->setCellValue($serie[$i++].$num, $row->dicr)
            ->setCellValue($serie[$i++].$num, $row->dicg)
            ->setCellValue($serie[$i++].$num, $row->totr)
            ->setCellValue($serie[$i++].$num, $row->totg)
            ;
            
            $num++;

}
$i = 1;
$num3 = $num -1;

$serietot = $serie[$i++];

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($serietot.$num, 'Totales');

$serietot = $serie[$i++];
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($serietot.$num, '=SUM('.$serietot.$num2.':'.$serietot.$num3.')');

$serietot = $serie[$i++];
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($serietot.$num, '=SUM('.$serietot.$num2.':'.$serietot.$num3.')');

$serietot = $serie[$i++];
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($serietot.$num, '=SUM('.$serietot.$num2.':'.$serietot.$num3.')');

$serietot = $serie[$i++];
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($serietot.$num, '=SUM('.$serietot.$num2.':'.$serietot.$num3.')');

$serietot = $serie[$i++];
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($serietot.$num, '=SUM('.$serietot.$num2.':'.$serietot.$num3.')');

$serietot = $serie[$i++];
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue($serietot.$num, '=SUM('.$serietot.$num2.':'.$serietot.$num3.')')
            ;




for($k = 1; $k<= 7; $k++){
    $objPHPExcel->getActiveSheet()->getColumnDimension($serie[$k])->setAutoSize(true);
}

$objPHPExcel->getActiveSheet()->mergeCells('B3:C3');
$objPHPExcel->getActiveSheet()->mergeCells('D3:E3');
$objPHPExcel->getActiveSheet()->mergeCells('F3:G3');

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B3', 'NOVIEMBRE');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D3', 'DICIEMBRE');
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('F3', 'TOTALES');

// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Concentrado');

$cat = $this->astra_model->cat();

$hoja = 1;
foreach($cat->result() as $row2){
    
    $query_ean = $this->astra_model->mensual_consulta_codigo($row2->ean);
    $registros2 = $query_ean->num_rows();
    
$objWorksheet1 = $objPHPExcel->createSheet();    
$objWorksheet1->setTitle($row2->descripcion);
$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue('A1', 'Concentrado AstraZeneca Fenix, Clave: '.$row2->ean.' - '.$row2->des2)
            ->setCellValue('A2', utf8_encode('Año: 2010'))
            ;

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$ini2=4;
$i2 = 1;

$hasta2 = $ini2 + $registros2;

$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue($serie[$i2++].$ini2, '#Suc')
            ->setCellValue($serie[$i2++].$ini2, 'Sucursal')
            ->setCellValue($serie[$i2++].$ini2, 'Nov. Reg.')
            ->setCellValue($serie[$i2++].$ini2, 'Nov. Gra.')
            ->setCellValue($serie[$i2++].$ini2, 'Dic. Reg.')
            ->setCellValue($serie[$i2++].$ini2, 'Dic. gra.')
            ->setCellValue($serie[$i2++].$ini2, 'Tot. Reg.')
            ->setCellValue($serie[$i2++].$ini2, 'Tot. Gra.')
            ;
            

$num2 = 5;
$num3 = 5;




foreach ($query_ean->result() as $row3)
{
$i2 = 1;
$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue($serie[$i2++].$num2, $row3->suc)
            ->setCellValue($serie[$i2++].$num2, $row3->nombre)
            ->setCellValue($serie[$i2++].$num2, $row3->novr)
            ->setCellValue($serie[$i2++].$num2, $row3->novg)
            ->setCellValue($serie[$i2++].$num2, $row3->dicr)
            ->setCellValue($serie[$i2++].$num2, $row3->dicg)
            ->setCellValue($serie[$i2++].$num2, $row3->totr)
            ->setCellValue($serie[$i2++].$num2, $row3->totg)
            ;
            
            $num2++;

}

$i2 = 2;
$num4 = $num2 -1;

$serietot = $serie[$i2++];

$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue($serietot.$num2, 'Totales');

$serietot = $serie[$i2++];
$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue($serietot.$num2, '=SUM('.$serietot.$num3.':'.$serietot.$num4.')');

$serietot = $serie[$i2++];
$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue($serietot.$num2, '=SUM('.$serietot.$num3.':'.$serietot.$num4.')');

$serietot = $serie[$i2++];
$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue($serietot.$num2, '=SUM('.$serietot.$num3.':'.$serietot.$num4.')');

$serietot = $serie[$i2++];
$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue($serietot.$num2, '=SUM('.$serietot.$num3.':'.$serietot.$num4.')');

$serietot = $serie[$i2++];
$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue($serietot.$num2, '=SUM('.$serietot.$num3.':'.$serietot.$num4.')');

$serietot = $serie[$i2++];
$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue($serietot.$num2, '=SUM('.$serietot.$num3.':'.$serietot.$num4.')')
            ;



$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
$objPHPExcel->getActiveSheet()->mergeCells('C3:D3');
$objPHPExcel->getActiveSheet()->mergeCells('E3:F3');
$objPHPExcel->getActiveSheet()->mergeCells('G3:H3');

for($k2 = 1; $k2 <= 8; $k2++){
    $objPHPExcel->getActiveSheet()->getColumnDimension($serie[$k2])->setAutoSize(true);
}

$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue('C3', 'NOVIEMBRE');
$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue('E3', 'DICIEMBRE');
$objPHPExcel->setActiveSheetIndex($hoja)
            ->setCellValue('G3', 'TOTALES');










//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$hoja++;
}
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="vidAZ_'.date('YmdHis').'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;