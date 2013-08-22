					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo;?></a></h2>
						<p class="meta"><span class="date">
                            <label>Selecciona el a&ntilde;o: </label>
                            <select size="1" name="anio" id="anio">
                        	<option value="2010">2010</option>
                            <option value="2011">2011</option>
                            <option value="2012">2012</option>
                            <option value="2012">2013</option>
                            </select>
                            <label> Mes: </label>
                            <select size="1" name="mes" id="mes">
                        	<option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                            </select>
                        </span><span class="posted" id="boton_busca_socio"><a href="#" id="reporte" class="awesome">Click Aqui para Buscar Info.</a></span></p>
						<div class="entry" id="contenido">
                        <span id="validando"></span>
						</div>
						<p class="links">
                        </p>
					</div>
                    <script language="javascript" type="text/javascript">
                    $(window).load(function () {
  $("#anio").focus();
});

$(document).ready(function(){
    
    var d = new Date();
    
    var mes_actual = d.getMonth();
    
    
    $('#mes').val(mes_actual + 1);

    $('#reporte').click(function(){
    var anio = parseInt($('#anio').attr("value"));
    var mes = $('#mes').attr("value");
    		sendReporte(anio, mes);
        });

  });  
   
    
function sendReporte(anio, mes){
    $.ajax({type: "POST",
        url: "<?php echo site_url();?>/reporte/traereporte/", data: ({ anio: anio, mes: mes }),
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