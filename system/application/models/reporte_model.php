<?php
	class Reporte_model extends Model {

    function Reporte_model()
    {
        parent::Model();
    }
    
    function Consulta($anio, $mes)
    {
        $sql="SELECT t.id as trans, t.suc, t.cliente_id, t.ticket, t.user_id, t.cupon, t.llave, t.created_at
, d.id as id_pro, a.eanalt as ean, d.piezas, d.precio, d.estatus, d.gratis
, concat(c.nombre, ' ', c.apaterno, ' ', c.amaterno) as cliente, floor(DATEDIFF(CURDATE(),c.nacio)/365) as edad, c.sexo, cp, telefono, mail, cedula, dosis, tiempo
, cia, s.nombre as sucursal, tipo2
, descripcionalt as descripcion, grupo
, username, u.nombre as empleado
FROM t
left join d on t.id=d.t_id
left join clientes c on t.cliente_id= c.id
left join suc s on t.suc=s.suc
left join cat a on d.ean=a.ean
left join user u on t.user_id=u.id
where extract(year from t.created_at) = ? and extract(month from t.created_at) = ?;";
        return $this->db->query($sql, array($anio, $mes));
    }

    function Consulta_previa($anio, $mes)
    {
        $sql="SELECT t.cliente_id, concat(c.nombre, ' ', c.apaterno, ' ', c.amaterno) as Cliente, a.eanalt as ean, descripcionalt as descripcion, t.created_at
FROM t
left join d on t.id=d.t_id
left join clientes c on t.cliente_id= c.id
left join suc s on t.suc=s.suc
left join cat a on d.ean=a.ean
left join user u on t.user_id=u.id
where extract(year from t.created_at) = ? and extract(month from t.created_at) = ?;";
        return $this->db->query($sql, array($anio, $mes));
    }

}