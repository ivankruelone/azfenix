<?php
class D extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('t_id', 'integer', 4);
		$this->hasColumn('ean', 'integer', 5);
		$this->hasColumn('piezas', 'integer', 1);
        $this->hasColumn('precio', 'decimal', 10, array(
                'scale' => 2
            )
        );
		$this->hasColumn('estatus', 'integer', 1, array(
                'default' => 0
            ));
		$this->hasColumn('gratis', 'integer', 1, array(
                'default' => 0
            ));        $this->option('type', 'MYISAM');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
	}

	public function setUp() {
		$this->setTableName('d');
		$this->actAs('Timestampable');
	}

}