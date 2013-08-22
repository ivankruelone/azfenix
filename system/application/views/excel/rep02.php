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
							 ->setTitle("Reporte para AstraZeneca")
							 ->setSubject("Reporte para AstraZeneca")
							 ->setDescription("Reporte de alta de productos de AstraZeneca")
							 ->setKeywords("Astra Zeneca")
							 ->setCategory("Astra Zeneca");



$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Reporte de Registro de Productos Farmacias El Fenix - AstraZeneca')
            ->setCellValue('A2', 'Año: ')
            ->setCellValue('B2', $anio)
            ->setCellValue('C2', 'Mes: ')
            ->setCellValue('D2', $mes)
            ;



$ini=4;

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$ini, 'Transaccion')
            ->setCellValue('B'.$ini, '# Suc')
            ->setCellValue('C'.$ini, 'Sucursal')
            ->setCellValue('D'.$ini, 'Id. Cliente')
            ->setCellValue('E'.$ini, 'EAN')
            ->setCellValue('F'.$ini, 'Descripcion')
            ->setCellValue('G'.$ini, 'Piezas')
            ->setCellValue('H'.$ini, 'Gratis')
            ->setCellValue('I'.$ini, 'Fecha y Hora');            

$num = 5;

//trans, suc, cliente_id, ticket, user_id, cupon, llave, created_at, id_pro, ean, piezas, precio, estatus, gratis, nombre_cliente,
// paterno_cliente, materno_cliente, nacio, sexo, cp, telefono, mail, cedula, dosis, tiempo, cia, sucursal, tipo2, descripcion, 
//grupo, username, empleado

foreach ($query->result() as $row)
{
//t.id, t.cliente_id, d.ean, c.descripcion, d.piezas, d.gratis, t.created_at
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->id)
            ->setCellValue('B'.$num, $row->suc)
            ->setCellValue('C'.$num, $row->nombre)
            ->setCellValue('D'.$num, $row->cliente_id)
            ->setCellValue('E'.$num, '"'.$row->ean.'"')
            ->setCellValue('F'.$num, $row->descripcion)
            ->setCellValue('G'.$num, $row->piezas)
            ->setCellValue('H'.$num, $row->gratis)
            ->setCellValue('I'.$num, $row->created_at);            
            $num++;

}


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
//die();

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="rep02.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;