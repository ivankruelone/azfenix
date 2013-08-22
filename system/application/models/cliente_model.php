<?php
	class Cliente_model extends Model {

    function loko()
    {
        parent::Model();
    }
    
    function Clientes_todos($idsuc)
    {
        $sql="SELECT id, nombre, apaterno, amaterno, floor(DATEDIFF(CURDATE(),nacio)/365) as edad, sexo, cp, idsuc, created_at as alta FROM clientes c where idsuc = ? order by id desc;";
        return $var['query']=$this->db->query($sql, array($idsuc));
    }

    function Clientes_nivel2($num = null, $offset = null, $busca = null)
    {
        if($busca == null){
        $sql='cli2';
        $query = $this->db->get($sql, $num, $offset);
        }else{
            
            if(is_numeric($busca)){
                $largo = strlen($busca);
                
                if($largo == 10 || $largo == 9){
                    
                    $sql="SELECT id, tarjeta, nombre, apaterno, amaterno, floor(DATEDIFF(CURDATE(),nacio)/365) as edad, CASE WHEN sexo=1 THEN 'M' WHEN sexo=2 THEN 'F' END as sexo, cp, idsuc, created_at as alta, (select count(*) from t where t.cliente_id=c.id) as tran FROM clientes c where tarjeta = ? order by id desc;";
                    $query = $this->db->query($sql, $busca);

                }else{
                    
                    $sql="SELECT id, tarjeta, nombre, apaterno, amaterno, floor(DATEDIFF(CURDATE(),nacio)/365) as edad, CASE WHEN sexo=1 THEN 'M' WHEN sexo=2 THEN 'F' END as sexo, cp, idsuc, created_at as alta, (select count(*) from t where t.cliente_id=c.id) as tran FROM clientes c where id = ? order by id desc;";
                    $query = $this->db->query($sql, $busca);

                } 
            }else{
                    
                $sql="SELECT id, tarjeta, nombre, apaterno, amaterno, floor(DATEDIFF(CURDATE(),nacio)/365) as edad, CASE WHEN sexo=1 THEN 'M' WHEN sexo=2 THEN 'F' END as sexo, cp, idsuc, created_at as alta, (select count(*) from t where t.cliente_id=c.id) as tran FROM clientes c where nombre = ? or apaterno = ? or amaterno = ? order by id desc;";
                $query = $this->db->query($sql, array($busca, $busca, $busca));

            }
        }
        $tabla = "
        <table id=\"hor-minimalist-b\">
        <thead>
        <tr>
        <th>Id.</th>
        <th>Tarjeta</th>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Sexo</th>
        <th>CP</th>
        <th>Sucursal</th>
        <th>Alta</th>
        <th>T</th>
        <th>Det.</th>
        <th>His.</th>
        </tr>
        </thead>
        <tbody>
        ";
        foreach($query->result() as $row)
        {
            $l1 = anchor('cliente/ver/'.$row->id, '<img src="'.base_url().'images/User.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver los datos completos!', 'onclick' => 'return hs.htmlExpand(this, { objectType: \'ajax\', width: 600} )'));
            $l2 = anchor('cliente/his/'.$row->tarjeta, '<img src="'.base_url().'images/Database3.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para ver el Historial!', 'onclick' => 'return hs.htmlExpand(this, { objectType: \'ajax\', width: 620} )'));
        $tabla.="
        <tr>
        <td>$row->id</td>
        <td>$row->tarjeta</td>
        <td>$row->nombre $row->apaterno $row->amaterno</td>
        <td>$row->edad</td>
        <td>$row->sexo</td>
        <td>".str_pad($row->cp, 5, "0", STR_PAD_LEFT)."</td>
        <td>$row->idsuc</td>
        <td>$row->alta</td>
        <td>$row->tran</td>
        <td>$l1</td>
        <td>$l2</td>
        </tr>
        ";
        }
        
    $tabla.="
    </tbody>
    </table>";
    
    return $tabla;
    }
    
    function Clientes_ver($id)
    {
        $sql="SELECT id, tarjeta, nombre, apaterno, amaterno, nacio, floor(DATEDIFF(CURDATE(),nacio)/365) as edad, CASE WHEN sexo=1 THEN 'MASCULINO' WHEN sexo=2 THEN 'FEMENINO' END as sexo, cp, telefono, mail, cedula, dosis, tiempo, idsuc, created_at as alta, CASE WHEN activo=0 THEN 'NO' WHEN activo=1 THEN 'SI' END as activo, updated_at FROM clientes c where id = ?;";
        $query = $this->db->query($sql, $id);
        $row = $query->row();
        
        $sql_suc = "select nombre from suc where suc = ?;";
        $query2 = $this->db->query($sql_suc, $row->idsuc);
        $row2 = $query2->row();
        
        $tabla = "
        <table>
        <caption>Datos del Cliente Id. $id</caption>
        <thead>
        <tr>
        <th>Campo</th>
        <th>Valor</th>
        </tr>
        </thead>
        <tbody>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Id.: </td>
        <td>$row->id</td>
        </tr>
        ";
        
        $tabla.="
        <tr>
        <td align=\"right\">Tarjeta: </td>
        <td>$row->tarjeta</td>
        </tr>
        ";
        
        $tabla.="
        <tr>
        <td align=\"right\">Nombre: </td>
        <td>$row->nombre $row->apaterno $row->amaterno</td>
        </tr>
        ";
        
        $tabla.="
        <tr>
        <td align=\"right\">Nacimiento: </td>
        <td>$row->nacio</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Edad: </td>
        <td>$row->edad</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Sexo: </td>
        <td>$row->sexo</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">CP: </td>
        <td>".str_pad($row->cp, 5, "0", STR_PAD_LEFT)."</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Telefono: </td>
        <td>$row->telefono</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Mail: </td>
        <td>$row->mail</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Cedula: </td>
        <td>$row->cedula</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Dosis: </td>
        <td>$row->dosis</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Tiempo: </td>
        <td>$row->tiempo</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Activo: </td>
        <td>$row->activo</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Alta: </td>
        <td>$row->alta</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Actualizado: </td>
        <td>$row->updated_at</td>
        </tr>
        ";

        $tabla.="
        <tr>
        <td align=\"right\">Sucursal: </td>
        <td>$row->idsuc - $row2->nombre</td>
        </tr>
        ";

        $tabla.="
        </tbody>
        </table>";
        
        $sql_cod="SELECT * FROM codigos where d_codigos = ?;";
        $query2 = $this->db->query($sql_cod, $row->cp);

        $tabla.= "
        <br />
        <table>
        <caption>Posibles Ubicaciones de acuerdo al CP</caption>
        <thead>
        <tr>
        <th>Colonia</th>
        <th>Municipio</th>
        <th>Estado</th>
        <th>Ciudad</th>
        <th>Tipo</th>
        </tr>
        </thead>
        <tbody>
        ";

        foreach ($query2->result() as $row2)
        {
            $tabla.="
            <tr>
            <td>$row2->d_tipo_asenta $row2->d_asenta</td>
            <td>$row2->d_mnpio</td>
            <td>$row2->d_estado</td>
            <td>$row2->d_ciudad</td>
            <td>$row2->d_zona</td>
            </tr>
            ";
        }
        
        $tabla.="
        </tbody>
        </table>";

        
        return $tabla;
    }

    function Clientes_uno($socio)
    {
        $sql="SELECT id, nombre, apaterno, amaterno, floor(DATEDIFF(CURDATE(),nacio)/365) as edad, sexo, cp, idsuc, created_at as alta FROM clientes c where tarjeta = ?;";
        return $var['query']=$this->db->query($sql, array($socio));
    }

}