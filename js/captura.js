$(window).load(function () {
  $("#folio").focus();
  $('#agrega_producto').hide();
});

$(document).ready(function(){
    
   		$("#agrega").autocomplete("../ajax/producto.php", {
		width: 600,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
    
    
    
        $('#folio').blur(function(){
        var folio_valor=parseInt($('#folio').attr("value"));
        var largo=$('#folio').attr("value").length;
        if(largo > 0){
        sendFolio($('#folio').val());
        }	
    });

        $('#sps').blur(function(){
        var sps_valor=$('#sps').attr("value");
        var largo=$('#sps').attr("value").length;
        if(largo > 0){
        sendSps($('#sps').attr("value"), $('#suc_alt').attr("value"));
        }	
    });

        $('#cedula').blur(function(){
        var cedula_valor=$('#cedula').attr("value");
        var largo=$('#cedula').attr("value").length;
        if(largo > 0){
        sendCedula($('#cedula').attr("value"), $('#suc_alt').attr("value"));
        }	
    });
    
   		$("#cie1").autocomplete("../ajax/cie.php", {
		width: 600,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

   		$("#cie2").autocomplete("../ajax/cie.php", {
		width: 600,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});

   		$("#cie3").autocomplete("../ajax/cie.php", {
		width: 600,
		matchContains: true,
		//mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
    
    

        $('#add_producto').click(function(){
        var producto=$('#agrega').attr("value");
        var largo=$('#agrega').attr("value").length;
        if(largo > 0){
        sendProductoadd($('#agrega').attr("value"));
        }	
    });    

        $('#carrito').click(function(){
        var producto=$('#producto_carro').attr("value");
        var largo=$('#producto_carro').attr("value").length;
        var canreq = $('#canreq').attr("value");
        var cansur = $('#cansur').attr("value");
        if(cansur > canreq){
            alert("La cantidad surtida no puede ser mayor a la cantidad requerida");
            $('#canreq').focus();
        }else{
            
        if(largo > 0){
        sendCarroadd($('#producto_carro').attr("value"), $('#canreq').attr("value"), $('#cansur').attr("value"));
            }	
        }

    });

        $('#fecha').blur(function(){
        var largo=$('#fecha').attr("value").length;
        if(largo>0){
            
        var fecha=$('#fecha').attr("value");
        var perini=$('#perini').attr("value");
        var perfin=$('#perfin').attr("value");

        var a = fecha.split("-");
        var b = perini.split("-");
        var c = perfin.split("-");

        if(a[0] == b[0] && a[0] == c[0]){
            if(a[1] == b[1] && a[1] == c[1]){
                if(a[2] >= b[2] && a[2] <= c[2]){
                    //comentario aki
                }else{
                alert("Fecha invalida, la fecha debe estar entre " + perini +" y " + perfin + "...");
                $('#fecha').focus();
                }
            }else{
                alert("Fecha invalida, la fecha debe estar entre " + perini +" y " + perfin + "...");
                $('#fecha').focus();
            }

        }else{
            alert("Fecha invalida, la fecha debe estar entre " + perini +" y " + perfin + "...");
            $('#fecha').focus();
        }
        
        
        }    
    });  

        $('#atencion').blur(function(){
        var att=$('#atencion').attr("value");
            if(att == 0){
                alert('Necesitas seleccionar una opcion en atencion.')
                $('#atencion').focus();
                return false;
            }
    });    

        $('#consulta').blur(function(){
        var consulta=$('#consulta').attr("value");
            if(consulta == 0){
                alert('Necesitas seleccionar una opcion en tipo de consulta.')
                $('#consulta').focus();
                return false;
            }
    });    

        $('#sexo').blur(function(){
        var sexo=$('#sexo').attr("value");
            if(sexo == 0){
                alert('Necesitas seleccionar el Genero del Paciente.')
                $('#sexo').focus();
                return false;
            }
    }); 
    
    $('#f_cap').submit(function() {

  if($('#cosas').attr("value")>0){
    
    return true;
    
  }else{

    alert('No puedes guardar una receta sin ningun producto');
    $('#agrega').focus();
    return false    

  }
});   
        
});


function sendFolio(folio){
    $.ajax({type: "POST",
        url: "../ajax/folio.php", data: ({ folio: folio }),
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


function sendSps(sps, idsuc){
    $.ajax({type: "POST",
        url: "../ajax/sps.php", data: ({ sps: sps, idsuc : idsuc }),
            success: function(data){
               if(data==0){
                  $('#fecha').val('').focus();
                  $('#validando').html('');
               }else{
                    var a;
                    a=data.split("/");
                  $('#validando').html('');
                  $('#nompac').val(a[0]);
                  $('#edad').val(a[1]);
                  $('#expediente').val(a[2]);
                  $('#sexo').val(a[3]);
                  $('#fecha').focus();
               }
        },
        beforeSend: function(data){
                  $('#validando').html('<b><font color="#F24B13">Validando...</font></b>');
        }
        });
}

function sendCedula(cedula, idsuc){
    $.ajax({type: "POST",
        url: "../ajax/cedula.php", data: ({ cedula: cedula, idsuc : idsuc }),
            success: function(data){
               if(data==0){
                  $('#nommed').val('').focus();
                  $('#validando').html('');
               }else{
                  $('#validando').html('');
                  $('#nommed').val(data);
               }
        },
        beforeSend: function(data){
                  $('#validando').html('<b><font color="#F24B13">Validando...</font></b>');
        }
        });
}


function sendProductoadd(clave){
    $.ajax({type: "POST",
        url: "http://201.151.238.53/pueblareceta/index.php/captura_receta/traeProducto", data: ({ clave: clave }),
            success: function(data){
               if(data==0){
                alert("La clave tecleda no existe");
                  $('#agrega').val('').focus();
                  $('#validando').html('');
               }else{
                  var a;
                  a=data.split("|");

                  $('#agrega_producto').show();
                  $('#validando').html('');
                  $('#agrega').val('');
                  $('#producto_carro').val(a[0]);
                  $('#clave').html(a[0]);
                  $('#corto').html(a[1]);
                  $('#unidad').html(a[2]);
                  $('#canreq').val('');
                  $('#cansur').val('');
                  $('#canreq').focus();

               }
        },
        beforeSend: function(data){
                  $('#validando').html('<b><font color="#F24B13">Validando...</font></b>');
        }
        });
}

function sendCarroadd(clave, canreq, cansur){
    $.ajax({type: "POST",
        url: "http://201.151.238.53/pueblareceta/index.php/captura_receta/traeCarro", data: ({ clave: clave, canreq : canreq, cansur : cansur }),
            success: function(data){
               if(data==0){
                alert("La clave tecleda no existe");
                  $('#agrega').val('').focus();
                  $('#validando').html('');
               }else{
                  $('#agrega_producto').hide();
                  $('#validando').html('');
                  $('#agrega').val('');
                  $('#carro').html(data);
                  $('#agrega').focus();
               }
        },
        beforeSend: function(data){
                  $('#validando').html('<b><font color="#F24B13">Validando...</font></b>');
        }
        });
}