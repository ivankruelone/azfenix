<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>AstraZeneca - Fenix: Programa de lealtad, puntos para tu salud.</title>
<link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tipTip.minified.js"></script>
<link href="<?php echo base_url(); ?>css/tipTip.css" rel="stylesheet" type="text/css" media="screen" />
<?php
if(isset($extraHead)){
    echo $extraHead;
}	
?>   
</head>
<body <?php if(isset($extraBody)){ echo $extraBody;} ?>>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="header">
			<div id="logo">
				<h1><a href="#"><img src="<?php echo base_url(); ?>images/azfenix.png" border="0" /></a></h1>
				<p>Programa de lealtad, puntos para tu salud...</p>
			</div>
            <?php
            if($this->session->userdata('user_id')){
                if(Current_User::user()->activo == 1){
                if($this->session->userdata('nivel') == 1){
?>
			<div id="menu">
				<ul>
					<li <?php if(isset($home)){echo $home;}?>><?php echo anchor('welcome', 'Home');?></li>
					<li <?php if(isset($clientes)){echo $clientes;}?>><?php echo anchor('cliente', 'Clientes');?></li>
					<li <?php if(isset($registro)){echo $registro;}?>><?php echo anchor('registro', 'Registro');?></li>
					<li <?php if(isset($consulta)){echo $consulta;}?>><?php echo anchor('consulta', 'Consulta');?></li>
					<li <?php if(isset($productos)){echo $productos;}?>><?php echo anchor('productos', 'Productos');?></li>
				</ul>
			</div>
<?php
        }elseif($this->session->userdata('nivel') == 2){
?>
			<div id="menu">
				<ul>
					<li <?php if(isset($home)){echo $home;}?>><?php echo anchor('welcome', 'Home');?></li>
					<li <?php if(isset($clientes)){echo $clientes;}?>><?php echo anchor('cliente/cli', 'Clientes');?></li>
					<li <?php if(isset($productos)){echo $productos;}?>><?php echo anchor('productos/pro', 'Prod.');?></li>
					<li <?php if(isset($usuarios)){echo $usuarios;}?>><?php echo anchor('usuarios', 'Usuarios');?></li>
					<li <?php if(isset($consulta)){echo $consulta;}?>><?php echo anchor('consulta', 'Consulta');?></li>
					<li <?php if(isset($rep)){echo $rep;}?>><?php echo anchor('reporte', 'Rep.');?></li>
				</ul>
			</div>
<?php            
	}elseif($this->session->userdata('nivel') == 3){
?>
			<div id="menu">
				<ul>
					<li <?php if(isset($home)){echo $home;}?>><?php echo anchor('welcome', 'Home');?></li>
					<li <?php if(isset($productos)){echo $productos;}?>><?php echo anchor('productos', 'Productos');?></li>
					<li <?php if(isset($consulta)){echo $consulta;}?>><?php echo anchor('consulta_astra', 'Consulta');?></li>
					<li <?php if(isset($mensual)){echo $mensual;}?>><?php echo anchor('consulta_astra/mensual', 'Mensual');?></li>
				</ul>
			</div>
<?php            
	}elseif($this->session->userdata('nivel') == 4){
?>
			<div id="menu">
				<ul>
					<li <?php if(isset($home)){echo $home;}?>><?php echo anchor('welcome', 'Home');?></li>
					<li <?php if(isset($productos)){echo $productos;}?>><?php echo anchor('productos', 'Productos');?></li>
					<li <?php if(isset($consulta)){echo $consulta;}?>><?php echo anchor('cliente/cli', 'Clientes');?></li>
				</ul>
			</div>
<?php            
	}
    }else{
            redirect('logout');
    }    
    }else{
?>
			<div id="menu">
				<ul>
					<li <?php if(isset($home)){echo $home;}?>><?php echo anchor('welcome', 'Home');?></li>
					<li <?php if(isset($productos)){echo $productos;}?>><?php echo anchor('productos', 'Productos');?></li>
					<li <?php if(isset($contacto)){echo $contacto;}?>><?php echo anchor('Contacto', 'Contacto');?></li>
				</ul>
			</div>

<?php
}	
?>

		</div>
	</div>
	<!-- end #header -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">
