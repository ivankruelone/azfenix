<?php

class Contacto extends Controller {

	function Contacto()
	{
		parent::Controller();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
        $var['titulo']="Contacto";
        $data['contacto']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('welcome/contenido', $var);
		$this->load->view('welcome/panel');
		$this->load->view('footer');
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */