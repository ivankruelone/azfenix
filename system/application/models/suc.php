<?php
class Suc extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('cia', 'integer', 1);
		$this->hasColumn('suc', 'integer', 2);
		$this->hasColumn('nombre', 'string', 30);
		$this->hasColumn('tipo2', 'string', 1);
	}

	public function setUp() {
		$this->setTableName('suc');
	}

}