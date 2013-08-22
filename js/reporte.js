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
        url: "http://201.151.238.53/azfenix/index.php/reporte/traereporte/", data: ({ anio: anio, mes: mes }),
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