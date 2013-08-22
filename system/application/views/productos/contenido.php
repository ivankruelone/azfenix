					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<div class="entry">
							<p>
                            <?php echo $this->table->generate($query);?>
                            </p>
						</div>
					</div>