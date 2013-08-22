					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<p class="meta"><span class="posted"></span></p>
						<div class="entry">
	<?php echo form_open('usuarios/submit_pw'); ?>

	<?php echo validation_errors('<p class="error">','</p>'); ?>

	<p align="center">
		<label for="password">Password: </label><br />
		<?php echo form_password('password'); ?>
	</p>
	<p align="center">
		<label for="passconf">Confirma Password: </label><br />
		<?php echo form_password('passconf'); ?>
	</p>
	<p>
		<?php echo form_hidden('id_user', $id);?>
		<?php echo form_submit('submit','Forzar Password'); ?>
	</p>
	<?php echo form_close(); ?>
						</div>
					</div>