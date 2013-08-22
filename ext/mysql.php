<?php
require_once("excel.php"); 
require_once("excel-ext.php"); 

$conEmp = mysql_connect("localhost", "root", "garigol");
mysql_select_db("azf", $conEmp);
$queEmp = "SELECT t.suc as nid, s.nombre as Sucursal, d.ean, c.descripcion, d.piezas, l.nombre, l.apaterno, l.amaterno, l.id, t.updated_at FROM t
left join d on t.id=d.t_id
left join suc s on t.suc=s.suc
left join cat c on d.ean=c.ean
left join clientes l on t.cliente_id=l.id
where d.gratis=1 and extract(year from t.updated_at) = 2010 and extract(month from t.updated_at)= 10;";
$resEmp = mysql_query($queEmp, $conEmp) or die(mysql_error());
$totEmp = mysql_num_rows($resEmp);

while($datatmp = mysql_fetch_assoc($resEmp)) { 
	$data[] = $datatmp; 
}  
createExcel("excel-mysql.xls", $data);
exit;
?>