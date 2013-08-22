<?php
class Logout extends Controller {

	public function index() {

		$this->session->sess_destroy();
		redirect('/welcome');
	}

}