<?php $us = $usu->row();?>
					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<p class="meta"><span class="posted"></span></p>
						<div class="entry">
	<?php echo form_open('usuarios/submit_modificar'); ?>

	<?php echo validation_errors('<p class="error">','</p>'); ?>

	<p align="center">
		<label for="username">Usuario: </label><br />
		<?php echo form_input('username', $us->username); ?>
	</p>
	<p align="center">
		<label for="nombre">Nombre: </label><br />
		<?php echo form_input('nombre', $us->nombre); ?>
	</p>
	<p align="center">
		<label for="idsuc">Sucursal: </label><br />
        <select size="1" name="idsuc" id="idsuc">
	       <option value="">Seleciona una Opcion</option>
           <?php
	       foreach($query->result() as $row){
	       	if($row->suc == $us->idsuc){
	       		$set_selected="selected";
	       	}else{
	       		$set_selected="";
	       	}
           ?>
           <option value="<?php echo $row->suc?>" <?php echo $set_selected;?>><?php echo $row->suc." - ".$row->nombre?></option>
            <?php
	       }
            ?>
        </select>
	</p>
	<p>
	<p align="center">
		<label for="activo">Status: </label><br />
        <select size="1" name="activo" id="activo">
	       <option value="0" <?php if($us->activo == 0){echo "selected";} ?>>INACTIVO</option>
	       <option value="1" <?php if($us->activo == 1){echo "selected";} ?>>ACTIVO</option>
        </select>
	</p>
	<p>
		<?php echo form_hidden('id_user', $us->id);?>
		<?php echo form_submit('submit','Modificar Usuario'); ?>
	</p>
	<?php echo form_close(); ?>
						</div>
					</div>	