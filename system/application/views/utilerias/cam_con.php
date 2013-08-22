<div id="login_form">

	<p class="heading">Cambiar la contrase&ntilde;a</p>

	<?php echo form_open('utilerias/submit', 'id="form_cambia"'); ?>
  	<?php echo validation_errors('<p class="error">','</p>'); ?>

	<p>
		<label for="password">Password Actual: </label>
		<?php echo form_password('pw_actual', '', 'id="pw_actual"'); ?>
	</p>
	<p>
		<label for="password">Password Nuevo: </label>
		<?php echo form_password('pw_nuevo1', '', 'id="pw_nuevo1"'); ?>
	</p>
	<p>
		<label for="password">Password Nuevo: </label>
		<?php echo form_password('pw_nuevo2', '', 'id="pw_nuevo2"'); ?>
	</p>
	<p>
		<?php echo form_submit('submit','Cambiar', 'id="cambia"'); ?>
	</p>
    <input type="hidden" value="<?php echo Current_User::user()->password;?>" name="pws" id="pws" />
	<?php echo form_close(); ?>

</div>
<script language="javascript" type="text/javascript">
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
        url: "<?php echo site_url();?>/current_user/comprueba_pw", data: ({ valor1: valor1 }),
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
</script>