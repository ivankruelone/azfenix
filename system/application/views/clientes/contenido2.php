<script type="text/javascript">
hs.cacheAjax = false;
hs.graphicsDir = '<?php echo base_url();?>js/graphics/';
hs.outlineType = 'rounded-white';
hs.wrapperClassName = 'draggable-header';

$(window).load(function () {
                      $("#busca").focus();
                    });
</script>
                        <?php
                            $atributos = array('id' => 'busca_form');
                            echo form_open('cliente/submit_busca', $atributos);
                        ?>
                    <div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<p class="meta"><label>Busqueda: </label><input type="text" value="" name="busca" id="busca" /><input type="submit" id="cliente-submit" value="BUSCAR" />                     
                        <span class="posted"><?php if(Current_User::user()->nivel == "2"){echo anchor('cliente/cliente_captura', 'Nuevo cliente');}?></span></p><div class="entry" id="busqueda">
							<?php echo form_close(); ?>
                            <p>
                            <?php echo $tabla;?>
                            </p>
                            <?php if($lins == 1) echo $this->pagination->create_links();?>
						</div>
						<p class="links"></p>
					</div>