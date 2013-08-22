					<div class="post">
                        <?php
                        $atributos = array('id' => 'registro_form');
                         echo form_open('registro/submit', $atributos);
                        ?>
						<h2 class="title"><a href="#"><?php echo $titulo;?></a></h2>
						<p class="meta"><span class="date"># de Socio: <input type="text" name="socio" id="socio" class="someClass" title="Aqui tienes que pasar por el Scanner la Tarjeta del cliente..." required/></span><span class="posted" id="boton_busca_socio"><a href="#" id="busca_socio" class="awesome">Click Aqui para Buscar Socio</a></span></p>
						<div class="entry" id="contenido">
                        <span id="validando"></span>
						</div>
						<p class="links">
                        <?php echo anchor('registro/historico', 'Historico de Transacciones');?>
    					<input type="submit" id="cliente-submit" value="EVALUAR" />
                        <input type="hidden" value="0" name="cliente_oculto" id="cliente_oculto" />
                        <input type="hidden" value="0" name="items_carro" id="items_carro" />
                        <?php echo form_close(); ?>                        
                        </p>
					</div>
                    <script language="javascript" type="text/javascript">
                    $(window).load(function () {
  $("#socio").focus();
});

$(document).ready(function(){
	
	$(function(){
		$(".someClass").tipTip({maxWidth: "auto", edgeOffset: 10, activation : "focus"});
		});

    $('#busca_socio').click(function(){
    var socio=parseInt($('#socio').attr("value"));
    var largo=$('#socio').attr("value").length;
    if(largo > 0){
        sendSocio(socio);
        }	
    });

    $('#registro_form').submit(function() {

  if($('#items_carro').attr("value")>0){
    
    if(confirm("Seguro que deseas validar esta informacion ?")){
    return true;
    }else{
    return false;
    }
    
  }else{

    alert('No puedes validar una transaccion sin ningun producto');
    $('#codigo').focus();
    return false    

        }
  });  
   


    
});

function sendSocio(socio){
    $.ajax({type: "POST",
        url: "<?php echo site_url();?>/registro/traesocio/", data: ({ socio: socio }),
            success: function(data){
               if(data==0){
                  $('#validando').html('');
                  $('#contenido').html('No Hay Coincidencias.');
                  //alert("El socio " + socio + " no se encontro.")
                  $('#socio').focus();
               }else{
                  $('#validando').html('');
                  $('#contenido').html(data);
                  $('#ticket').focus();
                  $('#socio').attr('disabled', 'disabled');
                  $('#cliente_oculto').val(socio);
                  $('#boton_busca_socio').hide();
                  //alert($('#cliente_oculto').attr("value"));

               }
        },
        beforeSend: function(data){
                  $('#validando').html('<b><font color="#F24B13">Buscando Datos...</font></b>');
        }
        });
}
                    
                    </script>