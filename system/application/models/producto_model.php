<?php
	class Producto_model extends Model {

    function loko()
    {
        parent::Model();
    }
    
    function Catalogo()
    {
        $sql="SELECT id, ean, descripcion, grupo, modificada, alta,
CASE
            WHEN activo = 1 THEN 'SI'
            WHEN activo = 0 THEN 'NO'
        END AS activo
FROM cat c order by id;";
        return $var['query']=$this->db->query($sql);
    }
    
    function Busca($producto)
    {
        $sql="SELECT * FROM cat c where ean=? and activo=1;";
        return $this->db->query($sql, array($producto));
    }

    function Busca_id($id)
    {
        $sql="SELECT * FROM cat c where id=? and activo=1;";
        return $this->db->query($sql, array($id));
    }
    
    function Busca_id2($id)
    {
        $sql="SELECT * FROM cat c where id=?;";
        return $this->db->query($sql, array($id));
    }
}