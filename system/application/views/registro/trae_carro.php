<?php
if($numrows==0 && $items==0){
echo "0";
}else{
?>
<table id="hor-minimalist-b">
<thead>
<tr>
  <th scope="col">Item</th>
  <th scope="col">Descripcion del Producto</th>
  <th scope="col" align="right">Precio</th>
  <th scope="col" align="right">Cantidad</th>
  <th scope="col" style="text-align:center">Eliminar</th>
</tr>
</thead>
<tbody>
<?php $i = 1; ?>

<?php $total = 0; ?>

<?php foreach($this->cart->contents() as $items): ?>

<?php if($items['qty'] == 9999){$items['qty']=0;}?>

	<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
	
	<tr>
	  <td style="text-align:right; font-weight: bold; font-size: larger;"><?php echo $items['id']?></td>
	  <td>
		<?php echo $items['name']; ?>
					
			<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
					
				<p>
					<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
						
						<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
										
					<?php endforeach; ?>
				</p>
				
			<?php endif; ?>
				
	  </td>
	  <td style="text-align:right; font-weight: bolder"><?php echo number_format($items['price'], 2)?></td>
	  <td style="text-align:right; font-weight: bolder"><?php echo $items['qty']?></td>
	  <td style="text-align:center"><input type="button" value="<?php echo $items['rowid']?>" name="borra_<?php echo $items['rowid']?>" id="borra_<?php echo $items['rowid']?>" class="buttonborra"/></td>
   </tr>
</tbody>
<?php $i++; ?>

<?php $total = $total + ($items['qty'] * $items['price']); ?>

<?php endforeach; ?>
<tfoot>
<tr>
  <td align="right" colspan="2"><strong>Total de Articulos</strong></td>
  <td align="right"><strong><?php echo number_format($total, 2); ?></strong></td>
  <td align="right"><strong><?php echo $this->cart->total_items(); ?></strong></td>
</tr>
</tfoot>
</table>
<script>
        $('#items_carro').val(<?php echo $this->cart->total_items();?>);
</script>
<?php 
}
?>