					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<p class="meta"><span class="posted"><?php echo anchor('cliente/cliente_captura', 'Nuevo cliente');?></span></p>
						<div class="entry">
							<p>
                            <?php echo $this->table->generate($query);?>
                            </p>
						</div>
						<p class="links"></p>
					</div>