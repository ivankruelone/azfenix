<?php
    if($numrows>0){	
?>
<p>
<?php
    $tmpl = array (
                    'table_open'          => '<table id="hor-minimalist-b">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th scope="col">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );

    $this->table->set_template($tmpl);
    $this->table->set_heading(array('Id. Socio', 'Nombre', 'A. Paterno', 'A. Materno', 'Edad', 'Sexo', 'C. P.', 'Suc. Alta', 'Alta'));
	echo $this->table->generate($query);
?>
    <br />
    <label>Ticket: </label>
    <input type="text" name="ticket" id="ticket" class="someClass" title="Ingresa el Folio del Ticket de Compra del cliente..." required/>
    <label>Codigo del producto: </label>
    <input type="text" name="codigo" id="codigo" class="someClass" title="Puedes pasar los productos por el Scanner y despues dar click en agregar..."/>
    <a href="#" id="busca_producto" class="awesome2">Agregar</a>
</p>
<span id="validando"></span>
<span id="carro"></span>
<script language="javascript" type="text/javascript">
	$(function(){
	$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10, activation : "focus"});
	});

    $('#busca_producto').click(function(){
    var producto=parseInt($('#codigo').attr("value"));
    var largo=$('#codigo').attr("value").length;
    if(largo > 0){
        sendProducto(producto);
        }	
    });

    $('#codigo').keyup(function(){
        var producto=parseInt($('#codigo').attr("value"));
        var largo=$('#codigo').attr("value").length;
        if(largo == 13){
            //sendProducto(producto);
            }	
        });

function sendProducto(producto){
    $.ajax({type: "POST",
        url: "<?php echo site_url();?>/registro/traecarro/", data: ({ producto: producto }),
            success: function(data){
               if(data==0){
                  $('#validando').html('');
                  $('#carro').html('No Hay Coincidencias.');
                  $('#codigo').val('').focus();
               }else{
                  $('#validando').html('');
                  $('#carro').html(data);
                  $('#codigo').val('').focus();
               }
        },
        beforeSend: function(data){
                  $('#validando').html('<b><font color="#F24B13">Buscando Producto...</font></b>');
        }
        });
}
</script>
<?php
	}else{
	   echo '0';
	}
?>