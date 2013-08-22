<?php $row = $query->row();?>
					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<div class="entry">
                            <?php
                            $atributos = array('id' => 'modificar_form');
                            echo form_open('productos/submit_modificar', $atributos);
                            ?>
                            <p>
<table id="hor-minimalist-b">
<thead>
<tr>
<th scope="col">Campo
<th scope="col">Valor
<tbody>
<tr>
<td class="tablatd">Id.:
<td class="tablatd"><?php echo $row->id?>
<tr>
<td class="tablatd">EAN:
<td class="tablatd"><input name="ean" id="ean" type="number" value="<?php echo $row->ean?>" size="13" maxlength="13">  
<tr>
<td class="tablatd">Descripcion:
<td class="tablatd"><input name="descripcion" id="descripcion" type="text" value="<?php echo $row->descripcion?>" size="60" maxlength="100">
<tr>
<td class="tablatd">Agrupamiento:
<td class="tablatd"><input name="grupo" id="grupo" type="number" value="<?php echo $row->grupo?>" size="2" maxlength="1">
<tr>
<td class="tablatd">Activo:
<td class="tablatd"><select size="1" name="activo" id="activo">
                    <option value="0" <?php if($row->activo == 0){ echo "selected";} ?>>0 - Inactivo</option>
                    <option value="1" <?php if($row->activo == 1){ echo "selected";} ?>>1 - Activo</option>
                    </select>
<tr>
<td class="tablatd">EAN Regalo:
<td class="tablatd"><input name="eanalt" id="eanalt" type="number" value="<?php echo $row->eanalt?>" size="13" maxlength="13">  
<tr>
<td class="tablatd">Descripcion Regalo:
<td class="tablatd"><input name="descripcionalt" id="descripcionalt" type="text" value="<?php echo $row->descripcionalt?>" size="60" maxlength="100">

    </table>
</p>
							<br /><br /><p align="right"><input type="submit" id="modificar-submit" value="MODIFICAR" /></p>
							<input name="id_producto" id="id_producto" type="hidden" value="<?php echo $row->id?>"> 
                            <?php echo form_close(); ?>
						</div>
					</div>
                    <script language="javascript" type="text/javascript">
                    
                    $(window).load(function () {
  $("#ean").focus();
});

$(document).ready(function(){

    $('#modificar_form').submit(function() {

  if($('#ean').attr("value").length > 0 &&
   $('#descripcion').attr("value").length > 0 &&
   $('#grupo').attr("value").length > 0) {
    
    if(confirm("Seguro que deseas modificar esta informacion ?")){
    return true;
    }else{
    return false;
    }
    
  }else{

    alert('Error en la validacion');
    $('#ean').focus();
    return false    

        }
  });  
   


    
});
                    </script>