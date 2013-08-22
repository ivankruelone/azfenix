$(window).load(function () {
  $("#pw_actual").focus();
});

$(document).ready(function(){
   
    $('#form_cambia').submit(function() {
        
        var valor1 = $('#pw_actual').attr("value");
        var valor2 = $('#pw_nuevo1').attr("value");
        var valor3 = $('#pw_nuevo2').attr("value");
        
        var largo1 =$('#pw_actual').attr("value").length;
        var largo2 =$('#pw_nuevo1').attr("value").length;
        var largo3 =$('#pw_nuevo2').attr("value").length;

        if(largo1 > 4 & largo2 > 4 & largo3 >4){
            sendPw(valor1);
            
        return true;
        }else{
        alert('El largo minimo de la contaseña en 4');
        return false;

        }
    });  

});

function sendPw(valor1){
    $.ajax({type: "POST",
        url: "http://201.151.238.53/pueblareceta/index.php/current_user/comprueba_pw", data: ({ valor1: valor1 }),
            success: function(data){
               if(data==0){
                  alert("El folio " + folio + " esta duplicado")
                  $('#folio').focus();
                  $('#validando').html('');
               }else{
                  $('#validando').html('');
               }
        },
        beforeSend: function(data){
                  $('#validando').html('<b><font color="#F24B13">Validando...</font></b>');
        }
        });
}