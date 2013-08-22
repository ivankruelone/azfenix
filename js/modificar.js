$(window).load(function () {
  $("#ean").focus();
});

$(document).ready(function(){

    $('#modificar_form').submit(function() {

  if($('#ean').attr("value").length > 0 &&
   $('#descripcion').attr("value").length > 0 &&
   $('#grupo').attr("value").length > 0) {
    
    if(confirm("Seguro que deseas modificar esta informacion ?")){
    return true;
    }else{
    return false;
    }
    
  }else{

    alert('Error en la validacion');
    $('#ean').focus();
    return false    

        }
  });  
   


    
});