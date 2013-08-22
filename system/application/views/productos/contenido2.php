					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<p class="meta"><span class="posted"><?php echo anchor('productos/nuevo', 'Nuevo Producto');?></span></p>
						<div class="entry">
                            <p>
<table id="hor-minimalist-b">
<thead>
<tr>
<th scope="col">Id.
<th scope="col">EAN
<th scope="col">Producto
<th scope="col" align="center">Grupo
<th scope="col" align="center">Activo
<th scope="col" align="center">Modificar
<th scope="col" align="center">Ultima Modificacion
<th scope="col" align="center">Alta
<tbody>
<?php
    foreach($query->result()  as $filas):	
?>
<tr>
<td class="tablatd"><?php echo $filas->id?>
<td class="tablatd"><?php echo $filas->ean?>
<td class="tablatd"><?php echo $filas->descripcion?>
<td class="tablatd" align="center	"><?php echo $filas->grupo?>
<td class="tablatd" align="center"><?php echo $filas->activo?>
<td class="tablatd" align="center"><?php echo anchor('productos/modificar/'.$filas->id, '<img src="'.base_url().'images/Edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para Modificar!'))?>
<td class="tablatd" align="center"><?php echo $filas->modificada?>
<td class="tablatd" align="center"><?php echo $filas->alta?>
<?php
	endforeach;
?>
    </table>
</p>
						</div>
					</div>	