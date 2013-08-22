<?php
	class Usuarios_model extends Model {

    function Usuarios_model()
    {
        parent::Model();
    }
    
    function Catalogo()
    {
        $sql="SELECT u.id, username, u.nombre,
CASE
            WHEN nivel = 1 THEN 'Sucursal'
            WHEN nivel = 2 THEN 'Admin'
        END AS nivel,
CASE
            WHEN activo = 0 THEN 'I'
            WHEN activo = 1 THEN 'A'
        END AS activo, idsuc, s.nombre as sucursal, tipo2, created_at
        FROM user u
left join catalogo.sucursal s on u.idsuc=s.suc
where u.nivel=1;";
        return $this->db->query($sql);
    }
    
    function Busca_id($id)
    {
        $sql="SELECT * FROM user c where id=?";
        return $this->db->query($sql, array($id));
    }
    
}