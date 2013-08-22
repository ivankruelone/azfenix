<?php
class Tools extends Controller {

	function tablas() {
		echo 'Recordatorio: Asegurate que las tablas no existan.<br />
		<form action="" method="POST">
		<input type="submit" name="action" value="Crear Tablas"><br /><br />';

		if ($this->input->post('action')) {
			Doctrine::createTablesFromModels();
			echo "Hecho!";
		}
	}
    
	public function crea_usuario() {


        $u = new User();
        $u->username = 'alejandro';
        $u->password ='urruzuno';
        $u->nombre = 'Alejandro';
        $u->nivel = 3;
        $u->idsuc = 1;
        $u->save();
    
}

	public function crea_cliente() {


        $c = new Clientes();
        $c->nombre = 'IVAN';
        $c->apaterno ='ZUÑIGA';
        $c->amaterno = 'PEREZ';
        $c->nacio = '1978-10-19';
        $c->sexo = 1;
        $c->cp = '06200';
        $c->idsuc = 105;
        $c->save();
    
}

}