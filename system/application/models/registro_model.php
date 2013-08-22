<?php
	class Registro_model extends Model {

    function loko()
    {
        parent::Model();
    }
    
    function Busca_ean($t_id)
    {
        $sql_busca_ean="SELECT d.ean, grupo FROM d join cat c on d.ean=c.ean where d.t_id = ? group by d.ean;";
        return $this->db->query($sql_busca_ean, array($t_id));
    }

    function Busca_cliente_productos($ean, $cliente)
    {
        $sql_busca_cliente_productos="SELECT d.id FROM t
join d on t.id=d.t_id
where cliente_id = ? and ean = ? and estatus=0 order by d.id;";
        return $this->db->query($sql_busca_cliente_productos, array($cliente, $ean));
    }
    
    function historico($suc)
    {
        $sql = "SELECT id, ticket, updated_at FROM t where suc = $suc order by id desc;";
        return $this->db->query($sql);
    }

    function Act_estatus($id)
    {
        $sql_act_estatus="update d set estatus=1, updated_at=now() where id = ?;";
        $this->db->query($sql_act_estatus, array($id));
    }

    function Act_gratis($id)
    {
        $sql_act_gratis="update d set gratis=1, updated_at=now() where id = ?;";
        $this->db->query($sql_act_gratis, array($id));
    }

    function Busca_id($id)
    {
        $sql_busca_id="SELECT d.id, d.ean, c.descripcion, c.eanalt, c.descripcionalt, piezas, precio, estatus, gratis, d.created_at FROM t join d on t.id=d.t_id join cat c on d.ean=c.ean where t.id = ?;";
        return $this->db->query($sql_busca_id, array($id));
    }

    function Info_cupon($id)
    {
        $sql_info_cupon="SELECT t.id, t.ticket, t.created_at, c.nombre, c.apaterno, c.amaterno, u.nombre as persona, cupon, llave FROM t
join clientes c on t.cliente_id=c.id
join user u on t.user_id=u.id
where t.id = ?;";
        return $this->db->query($sql_info_cupon, array($id));
    }
    
    function gratis($id)
    {
        $sql_info_cupon="SELECT gratis FROM d where t_id = ? and gratis=1;";
        $res = $this->db->query($sql_info_cupon, array($id));
        return $res->num_rows();
        
    }

    function reclama($id)
    {
        $sql_reclama="SELECT a.ean, descripcion, c.eanalt, descripcionalt, grupo, (select count(*) as cuenta from d as b where b.ean=a.ean and b.estatus=0) as pendientes  FROM d as a, cat c where a.ean=c.ean and t_id = ? and activo = 1 group by a.ean;";
        $res = $this->db->query($sql_reclama, array($id));
        $tabla = null;
        foreach ($res->result() as $row)
        {
            if($row->grupo == $row->pendientes){
                $tabla.="
                <table width=\"300\">
                <tr>
                <td>$row->eanalt</td>
                <td>$row->descripcionalt</td>
                <td>Tienes derecho a una pieza</td>
                <tr>
                </table>";
            }
        }
        return $tabla;
        
    }

    function trae_id_cliente($tarjeta)
    {
        $sql = "select id from clientes where tarjeta = ?";
        $id_cliente = $this->db->query($sql, $tarjeta);
        $row = $id_cliente->row();
        return $row->id;
    }
    
}