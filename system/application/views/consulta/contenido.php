					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo;?></a></h2>
						<p class="meta"><span class="date"># de Socio: <input type="text" name="socio" id="socio" required/><input type="radio" value="1" name="g1" id="detalle" /> Det. <input type="radio" value="2" name="g1" id="pendientes" checked="checked"/> Pend.</span><span class="posted" id="boton_busca_socio"><a href="#" id="busca_socio" class="awesome">Click Aqui para Buscar Info.</a></span></p>
						<div class="entry" id="contenido">
                        <span id="validando"></span>
						</div>
						<p class="links">
                        </p>
					</div>
                    <script language="javascript" type="text/javascript">
                    $(window).load(function () {
  $("#socio").focus();
});

$(document).ready(function(){

    $('#busca_socio').click(function(){
    var socio = parseInt($('#socio').attr("value"));
    var largo = $('#socio').attr("value").length;
    var tipo = $('#detalle').attr("checked");
    if(largo > 0){
    	if(tipo == false){
    		sendSocio(socio);
    		}else{
       		sendSocio1(socio);
    		}
        }	
    });

  });  
   
    
function sendSocio(socio){
    $.ajax({type: "POST",
        url: "<?php echo site_url();?>/consulta/traesocio/", data: ({ socio: socio }),
            success: function(data){
               if(data==0){
                  $('#validando').html('');
                  $('#contenido').html('No Hay Coincidencias.');
                  //alert("El socio " + socio + " no se encontro.")
                  $('#socio').focus();
               }else{
                  $('#validando').html('');
                  $('#contenido').html(data);
               }
        },
        beforeSend: function(data){
                  $('#validando').html('<b><font color="#F24B13">Buscando Datos...</font></b>');
        }
        });
}

function sendSocio1(socio){
    $.ajax({type: "POST",
        url: "<?php echo site_url();?>/consulta/traesocio1/", data: ({ socio: socio }),
            success: function(data){
               if(data==0){
                  $('#validando').html('');
                  $('#contenido').html('No Hay Coincidencias.');
                  //alert("El socio " + socio + " no se encontro.")
                  $('#socio').focus();
               }else{
                  $('#validando').html('');
                  $('#contenido').html(data);
               }
        },
        beforeSend: function(data){
                  $('#validando').html('<b><font color="#F24B13">Buscando Datos...</font></b>');
        }
        });
}
                    </script>