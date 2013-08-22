<?php
class User extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('username', 'string', 255, array('unique' => 'true'));
		$this->hasColumn('password', 'string', 255);
		$this->hasColumn('nombre', 'string', 255);
		$this->hasColumn('nivel', 'integer', 1);
		$this->hasColumn('idsuc', 'integer', 2);
		$this->hasColumn('activo', 'integer', 1, array('default' => '1'));
        $this->option('type', 'MyISAM');
        $this->option('collate', 'utf8_unicode_ci');
        $this->option('charset', 'utf8');
	}

	public function setUp() {
		$this->setTableName('user');
		$this->actAs('Timestampable');
		$this->hasMutator('password', '_encrypt_password');
	}

	protected function _encrypt_password($value) {
		$salt = '#*seCrEt!@-*%';
		$this->_set('password', md5($salt . $value));
	}
}