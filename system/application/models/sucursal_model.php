<?php
	class Sucursal_model extends Model {

    function Sucur()
    {
        parent::Model();
    }
    
    function Catalogo()
    {
        $sql="SELECT suc, nombre FROM suc s;";
        return $this->db->query($sql);
    }
    
    function Busca_suc($suc)
    {
        $sql="SELECT * FROM suc s where suc = ?;";
        return $this->db->query($sql, array($suc));
    }
    
}