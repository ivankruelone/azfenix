					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<p class="meta"><span class="posted"></span></p>
						<div class="entry">
							<p>
                            <table id="hor-minimalist-b">
                            <thead>
                            <tr>
                            <td>Id.</td>
                            <td>Ticket</td>
                            <td>Fecha</td>
                            <td>Resultado</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($query->result() as $row){?>
                            <tr>
                            <td><?php echo $row->id;?></td>
                            <td><?php echo $row->ticket;?></td>
                            <td><?php echo $row->updated_at;?></td>
                            <td><?php echo anchor('registro/resultado/'.$row->id, 'Ver Resultado');?></td>
                            </tr>
                            <?php }?>
                            </tbody>
                            </table>
                            <?php
                            
                             //echo $this->table->generate($query);
                             
                             
                             
                             ?>
                            </p>
						</div>
						<p class="links"></p>
					</div>