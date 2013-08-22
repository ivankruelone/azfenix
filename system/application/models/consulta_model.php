<?php
	class Consulta_model extends Model {

    function Consulta_model()
    {
        parent::Model();
    }
    
    function Consulta_pendientes($cliente)
    {
    	$tabla = "<p>";
        $sql_consulta_pendientes="SELECT ean FROM t
join d on t.id=d.t_id
where t.cliente_id = ? and d.estatus=0
group by ean
order by ean;";
        $query1 = $this->db->query($sql_consulta_pendientes, array($cliente));
        
        foreach ($query1->result() as $row1)
		{
		$sql_ean_cliente = "SELECT d.id, d.ean, c.descripcion, piezas, precio, estatus, gratis, d.created_at FROM t join d on t.id=d.t_id join cat c on d.ean=c.ean where t.cliente_id = ? and d.ean = ? and d.estatus= 0;";
		$query2 = $this->db->query($sql_ean_cliente, array($cliente, $row1->ean));

		$tabla.="<p>
<table id=\"hor-minimalist-b\">
<caption>
  <strong>Detalle de los productos registrados.</strong>
</caption>
<thead>
<tr>
<th scope=\"col\">Id.
<th scope=\"col\">EAN
<th scope=\"col\">Producto
<th scope=\"col\">Precio
<th scope=\"col\">Piezas
<th scope=\"col\">Status
<th scope=\"col\">Fecha y hora
<tbody>";
        $num=1;
        $t_piezas=0;
        $t_total=0;

    foreach($query2->result()  as $filas):	
        if($filas->estatus==0){
            $estatus="Pendiente";
        }else{
            $estatus="Descontada";
        }
        
        if($filas->gratis==0){
            $gratis="&nbsp;";
        }else{
            $estatus="<font color='#FF0000'>Gratuita</font>";
        }

$tabla.="
<tr>
<td class=\"tablatd\">$filas->id
<td class=\"tablatd\">$filas->ean
<td class=\"tablatd\">$filas->descripcion
<td class=\"tablatd\" align=\"right\">$filas->precio
<td class=\"tablatd\" align=\"right\">$filas->piezas
<td class=\"tablatd\">$estatus
<td class=\"tablatd\">$filas->created_at";
    $t_piezas=$t_piezas+$filas->piezas;
    $t_total=$t_total+($filas->piezas * $filas->precio);
    $num++;
	endforeach;
$tabla.="
    <tfoot>
    <tr>
    <td colspan=\"3\" align=\"right\">Totales
    <td align=\"right\">".number_format($t_total, 2)."
    <td align=\"right\">".number_format($t_piezas, 0)."
    </table>
</p>
		";
		}
$tabla .= "</p>";
	return $tabla;
    }

    
    function Consulta_detalle($cliente)
    {
    	$tabla = "<p>";
        $sql_consulta_pendientes="SELECT ean, count(*) as cuenta FROM t
left join d on t.id=d.t_id
where t.cliente_id = ?
group by ean
having count(*) > 0
order by ean;";
        $query1 = $this->db->query($sql_consulta_pendientes, array($cliente));
        
        foreach ($query1->result() as $row1)
		{
		$sql_ean_cliente = "SELECT d.id, d.ean, c.descripcion, piezas, precio, estatus, gratis, d.created_at FROM t join d on t.id=d.t_id join cat c on d.ean=c.ean where t.cliente_id = ? and d.ean = ? order by d.id;";
		$query2 = $this->db->query($sql_ean_cliente, array($cliente, $row1->ean));

		$tabla.="<p>
<table id=\"hor-minimalist-b\">
<caption>
  <strong>Detalle de los productos registrados.</strong>
</caption>
<thead>
<tr>
<th scope=\"col\">Id.
<th scope=\"col\">EAN
<th scope=\"col\">Producto
<th scope=\"col\">Precio
<th scope=\"col\">Piezas
<th scope=\"col\">Status
<th scope=\"col\">Fecha y hora
<tbody>";
        $num=1;
        $t_piezas=0;
        $t_total=0;

    foreach($query2->result()  as $filas):	
        if($filas->estatus==0){
            $estatus="Pendiente";
        }else{
            $estatus="Descontada";
        }
        
        if($filas->gratis==0){
            $gratis="&nbsp;";
        }else{
            $estatus="<font color='#FF0000'>Gratuita</font>";
        }

$tabla.="
<tr>
<td class=\"tablatd\">$filas->id
<td class=\"tablatd\">$filas->ean
<td class=\"tablatd\">$filas->descripcion
<td class=\"tablatd\" align=\"right\">$filas->precio
<td class=\"tablatd\" align=\"right\">$filas->piezas
<td class=\"tablatd\">$estatus
<td class=\"tablatd\">$filas->created_at";
    $t_piezas=$t_piezas+$filas->piezas;
    $t_total=$t_total+($filas->piezas * $filas->precio);
    $num++;
	endforeach;
$tabla.="
    <tfoot>
    <tr>
    <td colspan=\"3\" align=\"right\">Totales
    <td align=\"right\">".number_format($t_total, 2)."
    <td align=\"right\">".number_format($t_piezas, 0)."
    </table>
</p>
		";
		}
$tabla .= "</p>";
	return $tabla;
    }
    
}