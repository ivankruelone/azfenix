<?php
	class Astra_model extends Model {

    function Astra_model()
    {
        parent::Model();
    }
    
    function Consulta_gratis($anio, $mes)
    {
        $sql="SELECT t.id, t.cliente_id, c.eanalt as ean, c.descripcionalt as descripcion, d.piezas, d.gratis, t.created_at, t.suc, s.nombre FROM t
left join d on t.id=d.t_id
left join cat c on d.ean=c.ean
left join suc s on t.suc=s.suc
where extract(year from t.updated_at) = ? and extract(month from t.updated_at)= ?
order by t.id, d.id;";
        return $this->db->query($sql, array($anio, $mes));
    }
    
    
    function concentrado()
    {
        
        $sql = "SELECT descripcion,
ifnull((select sum(piezas) from d where extract(year from created_at)=2010 and extract(month from created_at)=11 and d.ean=c.ean), 0) as nov10r,
ifnull((select sum(piezas) from d where extract(year from created_at)=2010 and extract(month from created_at)=11 and d.ean=c.ean and gratis=1), 0) as nov10g,
ifnull((select sum(piezas) from d where extract(year from created_at)=2010 and extract(month from created_at)=12 and d.ean=c.ean), 0) as dic10r,
ifnull((select sum(piezas) from d where extract(year from created_at)=2010 and extract(month from created_at)=12 and d.ean=c.ean and gratis=1), 0) as dic10g
FROM cat c order by descripcion;";

    $query = $this->db->query($sql);
    
    $tabla = "
        <table id=\"hor-minimalist-b\">
        <thead>
        <tr>
        <th>Producto</th>
        <th align=\"right\">Nov. E.</th>
        <th align=\"right\">Nov. G.</th>
        <th align=\"right\">Dic. E.</th>
        <th align=\"right\">Dic. G.</th>
        <th align=\"right\">Tot. E.</th>
        <th align=\"right\">Tot. G</th>
        </tr>
        </thead>
        <tbody>
        ";
        
        $novr = 0;
        $novg = 0;
        $dicr = 0;
        $dicg = 0;
        $totr = 0;
        $totg = 0;
        
        foreach($query->result() as $row)
        {
            //$l1 = anchor('cliente/ver/'.$row->id, '<img src="'.base_url().'images/User.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver los datos completos!', 'onclick' => 'return hs.htmlExpand(this, { objectType: \'ajax\', width: 600} )'));
            //$l2 = anchor('cliente/his/'.$row->tarjeta, '<img src="'.base_url().'images/Database3.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver el Historial!', 'onclick' => 'return hs.htmlExpand(this, { objectType: \'ajax\', width: 620} )'));
        
        $subr = $row->nov10r + $row->dic10r;
        $subg = $row->nov10g + $row->dic10g;
        
        $tabla.="
        <tr>
        <td>$row->descripcion</td>
        <td align=\"right\">$row->nov10r</td>
        <td align=\"right\">$row->nov10g</td>
        <td align=\"right\">$row->dic10r</td>
        <td align=\"right\">$row->dic10g</td>
        <td align=\"right\">".number_format($subr, 0)."</td>
        <td align=\"right\">".number_format($subg, 0)."</td>
        </tr>
        ";
        
        
        $novr = $novr + $row->nov10r;
        $novg = $novg + $row->nov10g;
        $dicr = $dicr + $row->dic10r;
        $dicg = $dicg + $row->dic10g;
        
        $totr = $totr + $subr;
        $totg = $totg + $subg;
        }
        
    $tabla.= "
    <tfoot>
    <tr>
    <td align=\"right\">Totales</td>
    <td align=\"right\">".number_format($novr, 0)."</td>
    <td align=\"right\">".number_format($novg, 0)."</td>
    <td align=\"right\">".number_format($dicr, 0)."</td>
    <td align=\"right\">".number_format($dicg, 0)."</td>
    <td align=\"right\">".number_format($totr, 0)."</td>
    <td align=\"right\">".number_format($totg, 0)."</td>
    <tr>
    </tfoot>";
        
        
    $tabla.="
    </tbody>
    </table>";
    
    $tabla.="
    <br />
    <p align=\"center\">
    ".anchor('consulta_astra/excel_mensual', 'Concentrado en Excel. Nota: Puede tardar algunos minutos...')."
    </p>";
    
    return $tabla;

    }
    
    function serie(){
        
        $sql1 = "SELECT * FROM l ;";
        $sql2 = "SELECT concat(b.l, a.l) as serie FROM l a, l b;";
        
        $a = $this->db->query($sql1);
        $b = $this->db->query($sql2);
        
        $i = 1;
        
        foreach ($a->result() as $rowa)
            {
                $serie[$i] = $rowa->l;
                $i++;
            }
        foreach ($b->result() as $rowb)
            {
                $serie[$i] = $rowb->serie;
                $i++;
            }
            
        return $serie;

        
        
    }
    
    function mensual_consulta()
    {
        $sql = "SELECT descripcion,
ifnull((select sum(piezas) from d where extract(year from created_at)=2010 and extract(month from created_at)=11 and d.ean=c.ean), 0) as novr,
ifnull((select sum(piezas) from d where extract(year from created_at)=2010 and extract(month from created_at)=11 and d.ean=c.ean and gratis=1), 0) as novg,
ifnull((select sum(piezas) from d where extract(year from created_at)=2010 and extract(month from created_at)=12 and d.ean=c.ean), 0) as dicr,
ifnull((select sum(piezas) from d where extract(year from created_at)=2010 and extract(month from created_at)=12 and d.ean=c.ean and gratis=1), 0) as dicg,
ifnull((select sum(piezas) from d where extract(year from created_at)=2010 and d.ean=c.ean), 0) as totr,
ifnull((select sum(piezas) from d where extract(year from created_at)=2010 and d.ean=c.ean and gratis=1), 0) as totg
FROM cat c order by descripcion;";

        return $this->db->query($sql);

    }
    
    function mensual_consulta_codigo($ean)
    {
        $sql = "SELECT cia, suc, nombre,
ifnull((select sum(piezas) as piezas from t, d where t.id=d.t_id and extract(year from d.created_at)=2010 and extract(month from d.created_at)=11 and t.suc=s.suc and ean = ?), 0) as novr,
ifnull((select sum(gratis) as piezas from t, d where t.id=d.t_id and extract(year from d.created_at)=2010 and extract(month from d.created_at)=11 and t.suc=s.suc and ean = ?), 0) as novg,
ifnull((select sum(piezas) as piezas from t, d where t.id=d.t_id and extract(year from d.created_at)=2010 and extract(month from d.created_at)=12 and t.suc=s.suc and ean = ?), 0) as dicr,
ifnull((select sum(gratis) as piezas from t, d where t.id=d.t_id and extract(year from d.created_at)=2010 and extract(month from d.created_at)=12 and t.suc=s.suc and ean = ?), 0) as dicg,
ifnull((select sum(piezas) as piezas from t, d where t.id=d.t_id and extract(year from d.created_at)=2010 and t.suc=s.suc and ean = ?), 0) as totr,
ifnull((select sum(gratis) as piezas from t, d where t.id=d.t_id and extract(year from d.created_at)=2010 and t.suc=s.suc and ean = ?), 0) as totg
FROM suc s where tipo2 = 'F';";

        return $this->db->query($sql, array($ean, $ean, $ean, $ean, $ean, $ean));

    }
    
    function cat()
    {
        $sql = "SELECT ean, SUBSTRING(descripcion, 1, 14) as descripcion, descripcion as des2 FROM cat c order by descripcion;";
        
        return $this->db->query($sql);
    }

}