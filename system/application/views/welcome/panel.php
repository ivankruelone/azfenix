					<div style="clear: both;">&nbsp;</div>
				</div>
				<!-- end #content -->
				<div id="sidebar">
					<ul>
						<li>
                        <?php
	if($this->session->userdata('user_id')){
	   

?>
							<div id="search" >
									<div>
										<label>Id: </label><strong><?php echo $this->session->userdata('user_id');?></strong><br />
										<label>Usuario: </label><strong><?php echo $this->session->userdata('username');?></strong><br />
										<label>Nombre: </label><strong><?php echo utf8_encode(Current_user::user()->nombre);?></strong><br />
										<label>Nivel: </label><strong><?php echo $this->session->userdata('nivel');?></strong><br />
										<label># Sucursal: </label><strong><?php echo $this->session->userdata('idsuc');?></strong><br />
										<label>Sucursal: </label><strong><?php echo $this->session->userdata('sucursal');?></strong><br />
										<label>Alta: </label><strong><?php echo $this->session->userdata('alta');?></strong><br /><br /><br />
                                        <p align="center"><?php echo anchor('utilerias/cambio_contrasena', 'Cambiar Contrase&ntilde;a', array('class' => 'awesome2'));?></p>
                                        <p align="center"><?php echo anchor('logout', 'Salir del sistema en forma segura', array('class' => 'awesome2'));?></p>
									</div>
							</div>
<?php
	}else{
?>
							<div id="search" >
									<?php echo form_open('welcome/submit'); ?>
									<?php echo validation_errors('<p class="error">','</p>'); ?>
									<div>
										<strong>Entrar al sistema:</strong>
										<br /><label>Usuario:</label><br />
										<input type="text" name="username" id="username" />
										<br /><label>Password:</label><br />
										<input type="password" name="password" id="password" />
										<input type="submit" id="search-submit" value="ENTRAR" />
									</div>
									<?php echo form_close(); ?>
							</div>
<?php	   
	}	
?>
							<div style="clear: both;">&nbsp;</div>
						</li>
					</ul>
				</div>
				<!-- end #sidebar -->
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div>
	<!-- end #page -->
</div>
