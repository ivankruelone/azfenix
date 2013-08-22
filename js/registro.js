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
        url: "http://201.151.238.53/azfenix/index.php/registro/traesocio/", data: ({ socio: socio }),
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