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
        url: "http://201.151.238.53/azfenix/index.php/consulta/traesocio/", data: ({ socio: socio }),
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
        url: "http://201.151.238.53/azfenix/index.php/consulta/traesocio1/", data: ({ socio: socio }),
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