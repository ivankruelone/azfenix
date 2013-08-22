$(window).load(function () {
  $("#tarjeta").focus();
});

$(document).ready(function(){

    $('#cliente_form').submit(function() {

  if($('#nombre').attr("value").length > 0 &&
   $('#apaterno').attr("value").length > 0 &&
   $('#amaterno').attr("value").length > 0 &&
   $('#sexo').attr("value") > 0 &&
   $('#cp').attr("value").length >= 4) {
    
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