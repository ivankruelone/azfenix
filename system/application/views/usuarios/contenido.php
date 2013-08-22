					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<p class="meta"><span class="posted"><?php echo anchor('usuarios/agregar', 'Nuevo Usuario');?></span></p>
						<div class="entry">
                            <p>
<table id="hor-minimalist-b">
<thead>
<tr>
<th scope="col">Id.
<th scope="col">Usuario
<th scope="col">Nombre del Usuario
<th scope="col" align="center">Nivel
<th scope="col" align="center">Id. Sucursal
<th scope="col" align="center">Sucursal
<th scope="col" align="center">Tipo
<th scope="col" align="center">Status
<th scope="col" align="center" colspan="2">Accion
<th scope="col" align="center">Alta
<tbody>
<?php
    foreach($query->result()  as $filas):	
?>
<tr>
<td class="tablatd"><?php echo $filas->id?>
<td class="tablatd"><?php echo $filas->username?>
<td class="tablatd"><?php echo $filas->nombre?>
<td class="tablatd" align="center	"><?php echo $filas->nivel?>
<td class="tablatd" align="center"><?php echo $filas->idsuc?>
<td class="tablatd" align="center"><?php echo $filas->sucursal?>
<td class="tablatd" align="center"><?php echo $filas->tipo2?>
<td class="tablatd" align="center"><?php echo $filas->activo?>
<td class="tablatd" align="center"><?php echo anchor('usuarios/modificar/'.$filas->id, '<img src="'.base_url().'images/Edit.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para Modificar Usuario, Nombre del Usuario y Sucursal!'))?>
<td class="tablatd" align="center"><?php echo anchor('usuarios/pw/'.$filas->id, '<img src="'.base_url().'images/login.png" border="0" width="20px" /></a>', array('title' => 'Haz Click aqui para Modificar el Password!'))?>
<td class="tablatd" align="center"><?php echo $filas->created_at?>
<?php
	endforeach;
?>
    </table>
</p>
						</div>
					</div>	