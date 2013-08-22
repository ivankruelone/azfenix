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
ini_set('memory_limit','512M');
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** PHPExcel */
require_once 'Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("IVAN ZUÑIGA PEREZ")
							 ->setLastModifiedBy("IVAN ZUÑIGA PEREZ")
							 ->setTitle("Reporte para Mireey")
							 ->setSubject("Reporte para Mireey")
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
            ->setCellValue('B'.$ini, 'Nid')
            ->setCellValue('C'.$ini, 'Sucursal')
            ->setCellValue('D'.$ini, 'Id Cliente')
            ->setCellValue('E'.$ini, 'Cliente')
            ->setCellValue('F'.$ini, 'Edad')
            ->setCellValue('G'.$ini, 'Sexo')
            ->setCellValue('H'.$ini, 'CP')
            ->setCellValue('I'.$ini, 'Telefono')
            ->setCellValue('J'.$ini, 'E-mail')
            ->setCellValue('K'.$ini, 'Cedula')
            ->setCellValue('L'.$ini, 'Dosis')
            ->setCellValue('M'.$ini, 'Tiempo')
            ->setCellValue('N'.$ini, 'EAN')
            ->setCellValue('O'.$ini, 'Descripcion')
            ->setCellValue('P'.$ini, 'Precio')
            ->setCellValue('Q'.$ini, 'Piezas')
            ->setCellValue('R'.$ini, 'Grupo')
            ->setCellValue('S'.$ini, 'Gratis')
            ->setCellValue('T'.$ini, 'Fecha y Hora')
            ->setCellValue('U'.$ini, 'Cupon')
            ->setCellValue('V'.$ini, 'Ticket')
            ->setCellValue('W'.$ini, 'Id. Usuario')
            ->setCellValue('X'.$ini, 'Nombre de usuario')
            ->setCellValue('Y'.$ini, 'Empleado');
            

$num = 5;

//trans, suc, cliente_id, ticket, user_id, cupon, llave, created_at, id_pro, ean, piezas, precio, estatus, gratis, nombre_cliente,
// paterno_cliente, materno_cliente, nacio, sexo, cp, telefono, mail, cedula, dosis, tiempo, cia, sucursal, tipo2, descripcion, 
//grupo, username, empleado

foreach ($query->result() as $row)
{

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$num, $row->trans)
            ->setCellValue('B'.$num, $row->suc)
            ->setCellValue('C'.$num, $row->sucursal)
            ->setCellValue('D'.$num, $row->cliente_id)
            ->setCellValue('E'.$num, $row->cliente)
            ->setCellValue('F'.$num, $row->edad)
            ->setCellValue('G'.$num, $row->sexo)
            ->setCellValue('H'.$num, $row->cp)
            ->setCellValue('I'.$num, $row->telefono)
            ->setCellValue('J'.$num, $row->mail)
            ->setCellValue('K'.$num, $row->cedula)
            ->setCellValue('L'.$num, $row->dosis)
            ->setCellValue('M'.$num, $row->tiempo)
            ->setCellValue('N'.$num, '"'.$row->ean.'"')
            ->setCellValue('O'.$num, $row->descripcion)
            ->setCellValue('P'.$num, $row->precio)
            ->setCellValue('Q'.$num, $row->piezas)
            ->setCellValue('R'.$num, $row->grupo)
            ->setCellValue('S'.$num, $row->gratis)
            ->setCellValue('T'.$num, $row->created_at)
            ->setCellValue('U'.$num, $row->cupon)
            ->setCellValue('V'.$num, '"'.$row->ticket.'"')
            ->setCellValue('W'.$num, $row->user_id)
            ->setCellValue('X'.$num, $row->username)
            ->setCellValue('Y'.$num, $row->empleado);
            
            $num++;

}


// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="rep01.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;