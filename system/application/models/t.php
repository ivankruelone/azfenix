<?php
class T extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('suc', 'integer');
		$this->hasColumn('cliente_id', 'integer');
		$this->hasColumn('ticket', 'string', 20, array('unique' => 'true'));
		$this->hasColumn('user_id', 'integer');
		$this->hasColumn('cupon', 'string', 10);
		$this->hasColumn('llave', 'string', 32);
        $this->option('type', 'MYISAM');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
	}

	public function setUp() {
		$this->setTableName('t');
		$this->actAs('Timestampable');
	}

}