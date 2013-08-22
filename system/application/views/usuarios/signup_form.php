					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<p class="meta"><span class="posted"></span></p>
						<div class="entry">
	<?php echo form_open('usuarios/submit'); ?>

	<?php echo validation_errors('<p class="error">','</p>'); ?>

	<p align="center">
		<label for="username">Usuario: </label><br />
		<?php echo form_input('username',set_value('username')); ?>
	</p>
	<p align="center">
		<label for="password">Password: </label><br />
		<?php echo form_password('password'); ?>
	</p>
	<p align="center">
		<label for="passconf">Confirma Password: </label><br />
		<?php echo form_password('passconf'); ?>
	</p>
	<p align="center">
		<label for="nombre">Nombre: </label><br />
		<?php echo form_input('nombre',set_value('nombre')); ?>
	</p>
	<p align="center">
		<label for="nivel">Nivel: </label><br />
		<?php echo form_dropdown('nivel', $nivel, '1'); ?>
	</p>
	<p align="center">
		<label for="idsuc">Sucursal: </label><br />
        <select size="1" name="idsuc" id="idsuc">
	       <option value="">Seleciona una Opcion</option>
           <?php
	       foreach($query->result() as $row){
           ?>
           <option value="<?php echo $row->suc?>"><?php echo $row->suc." - ".$row->nombre?></option>
            <?php
	       }
            ?>
        </select>
	</p>
	<p>
		<?php echo form_submit('submit','Agregar Usuario'); ?>
	</p>
	<?php echo form_close(); ?>
						</div>
					</div>	