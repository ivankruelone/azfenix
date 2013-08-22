					<div class="post">
							<p>
                            <?php
                            if(isset($mensaje)){
                                echo "<h1>$mensaje</h1>";
                            }else{
                                $row_cupon = $query_cupon->row();
                                //id, ticket, created_at, nombre, apaterno, amaterno, persona
                            ?>
                            <div id="myPrintArea">
                            <p>
                            <table id="hor-minimalist-c" width="200">
                            <caption>
                            <strong>Datos Principales.</strong>
                            </caption>
                            <tbody>
                            <tr>
                            <td scope="col"># Sucursal.
                            <td colspan="2"><font color="#FF0000"><?php echo $this->session->userdata('idsuc');?></font>
                            <tr>
                            <td scope="col">Sucursal
                            <td colspan="2"><font color="#FF0000"><?php echo $this->session->userdata('sucursal');?></font>
                            <tr>
                            <td scope="col">Id.
                            <td><font color="#FF0000"><?php echo $row_cupon->id?></font>
                            <tr>
                            <td scope="col">Ticket
                            <td><font color="#FF0000"><?php echo $row_cupon->ticket?></font>
                            <tr>
                            <td scope="col">Creado
                            <td><font color="#FF0000"><?php echo $row_cupon->created_at?></font>
                            <tr>
                            <td scope="col">Cliente
                            <td colspan="5"><font color="#FF0000"><?php echo $row_cupon->nombre." ".$row_cupon->apaterno." ".$row_cupon->amaterno?></font>
                            <tr>
                            <td scope="col">Atendio
                            <td colspan="5"><font color="#FF0000"><?php echo $row_cupon->persona?></font>
                            <tr>
                            <td scope="col">Clave de Cupon
                            <td colspan="5"><font color="#FF0000" size="+1"><?php if($gratis > 0) echo $row_cupon->cupon?></font>
                            </table>
                            </p>
                            <p>
<table id="hor-minimalist-c" width="200">
<caption>
  <strong>Detalle de los productos registrados.</strong>
</caption>
<thead>
<tr>
<th scope="col">Id.
<th scope="col">EAN
<th scope="col">Producto
<th scope="col">Piezas
<th scope="col">Status
<tbody>
<?php
//id, ean, descripcion, piezas, precio, estatus, gratis, created_at
        $num=1;
        $t_piezas=0;
        $t_total=0;

    foreach($query_id->result()  as $filas):	
        if($filas->estatus==0){
            $estatus="Pendiente";
        }else{
            $estatus="Descontada";
        }
        
        if($filas->gratis==0){
            $gratis="&nbsp;";
        }else{
            $estatus="<font color='#FF0000'>Gratuita</font>";
        }
?>
<tr>
<td class="tablatd"><?php echo $filas->id?>
<td class="tablatd"><?php echo $filas->eanalt?>
<td class="tablatd"><?php echo $filas->descripcionalt?>
<td class="tablatd" align="right"><?php echo $filas->piezas?>
<td class="tablatd"><?php echo $estatus?>
<?php
    $t_piezas=$t_piezas+$filas->piezas;
    $t_total=$t_total+($filas->piezas * $filas->precio);
    $num++;
	endforeach;
?>
    <tfoot>
    <tr>
    <td colspan="3" align="right">Totales
    <td align="right"><?php echo number_format($t_piezas, 0)?>
    </table>
</p>
<font color="#FF0000">
<p>
<?php
	if($gratis == 0){
        echo "Nota: Esta es solo una comprobacion del registro<br />de sus productos en el sistema...<br />Gracias.";
        }else{
        echo "Cupon Valido para Pieza(s) Gratuita(s)...<br />";
        }
    if(isset($reclama)){
        echo "Hemos detectado:<br />";
        echo $reclama;
        echo "<br />Solicitala(s) con quien te atendio.";
    }
?>
</p>
</div>
<p align="center">
<div><a id="print_button" href="#"><font color="#C52D2D" size="4">Imprimir Ticket</font></a></div>
<br />

</p></font>
                            
                            
                            <?php
                            } 
                            ?>
					</div>
    <script language="javascript" type="text/javascript">
    $(window).load(function () {
  $("#print_button").focus();
});

$(document).ready(function(){
	$("#print_button").click(function(){
	     $.jPrintArea('#myPrintArea');
	});
});
    </script>