					<div class="post">
						<h2 class="title"><a href="#"><?php echo $titulo; ?></a></h2>
						<p class="meta"><span class="posted">Ingresa los datos del Cliente</span></p>
						<div class="entry">
							<p>
                            <?php
                            $atributos = array('id' => 'cliente_form');
                            echo form_open('cliente/submit', $atributos);
                            ?>
                            <b>* Campos Obligatorios.</b><br />
                            <label>Tarjeta: </label><br />
                            <input type="password" size="45" maxlength="20" name="tarjeta" id="tarjeta" required />*<br />
                            <label>Nombre: </label><br />
                            <input type="text" size="45" maxlength="60" name="nombre" id="nombre" required />*<br />
                            <label>Apellido Paterno: </label><br />
                            <input type="text" size="45" maxlength="60" name="apaterno" id="apaterno" requiered />*<br />
                            <label>Apellido Materno: </label><br />
                            <input type="text" size="45" maxlength="60" name="amaterno" id="amaterno" requiered />*<br />
                            <label>Fecha de Nacimiento: </label><br />
                            <select size="1" name="dia" id="dia">
                                <option value="0">Dia</option>
                                <?php
                                for ($i = 1; $i <= 31; $i++) {
                                ?>
                                <option value="<?php echo $i?>"><?php echo $i?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <select size="1" name="mes" id="mes">
                                <option value="0">Mes</option>
                                <?php
                                for ($i = 1; $i <= 12; $i++) {
                                ?>
                                <option value="<?php echo $i?>"><?php echo $i?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <select size="1" name="anio" id="anio">
                                <option value="0">A&ntilde;o</option>
                                <?php
                                for ($i = 2010; $i >= 1930; $i--) {
                                ?>
                                <option value="<?php echo $i?>"><?php echo $i?></option>
                                <?php
                                }
                                ?>
                            </select><br />
                            <label>Sexo: </label><br />
                            <select size="1" name="sexo" id="sexo">
                                <option value="0">Selecciona</option>
                                <option value="1">1 - Masculino</option>
                                <option value="2">2 - Femenino</option>
                            </select>*<br />
                            <label>C. P.: </label><br />
                            <input type="number" size="5" maxlength="5" name="cp" id="cp" requiered />*<br />
                            <label>Telefono: </label><br />
                            <input type="text" size="10" maxlength="10" name="tel" id="tel" /><br />
                            <label>E-mail: </label><br />
                            <input type="text" size="20" maxlength="50" name="email" id="email" /><br /><br />

                            <fieldset>
                            <legend>Datos de la Prescripci&oacute;n</legend>

                            <label>Cedula Profesional: </label><br />
                            <input type="text" size="20" maxlength="50" name="cedula" id="cedula" /><br />
                            <label>Dosis: </label><br />
                            <input type="text" size="70" maxlength="100" name="dosis" id="dosis" /><br />
                            <label>Tiempo de tratamiento: </label><br />
                            <input type="text" size="70" maxlength="100" name="tiempo" id="tiempo" /><br />

                            </fieldset>

							<br /><br /><p align="right"><input type="submit" id="cliente-submit" value="AGREGAR" /></p>
                            <?php echo form_close(); ?>
                            </p>
						</div>
						<p class="links"></p>
					</div>
                    <script language="javascript" type="text/javascript">
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
                    </script>