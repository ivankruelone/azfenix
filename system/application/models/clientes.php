<?php
class Clientes extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('tarjeta', 'integer', 5);
		$this->hasColumn('nombre', 'string', 60);
		$this->hasColumn('apaterno', 'string', 60);
		$this->hasColumn('amaterno', 'string', 60);
		$this->hasColumn('nacio', 'date');
		$this->hasColumn('sexo', 'integer', 1);
		$this->hasColumn('cp', 'integer', 3);
		$this->hasColumn('telefono', 'string', 10, array('default' => 'N/D'));
		$this->hasColumn('mail', 'string', 60, array('default' => 'N/D'));
		$this->hasColumn('cedula', 'string', 20, array('default' => 'N/D'));
		$this->hasColumn('dosis', 'string', 100, array('default' => 'N/D'));
		$this->hasColumn('tiempo', 'string', 100, array('default' => 'N/D'));
		$this->hasColumn('idsuc', 'integer', 4);
		$this->hasColumn('activo', 'integer', 1, array('default' => '1'));
        $this->option('type', 'MyISAM');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
	}

	public function setUp() {
		$this->setTableName('clientes');
		$this->actAs('Timestampable');
	}

}