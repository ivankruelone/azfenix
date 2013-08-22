<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
        $var['titulo']="Bienvenido !!!";
        $data['home']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('welcome/contenido', $var);
		$this->load->view('welcome/panel');
		$this->load->view('footer');
	}

	public function submit() {

		if ($this->_submit_validate() === FALSE) {
			$this->index();
			return;
		}

		redirect('/welcome');

	}

	private function _submit_validate() {

		$this->form_validation->set_rules('username', 'Usuario',
			'trim|required|callback_authenticate');

		$this->form_validation->set_rules('password', 'Password',
			'trim|required');

		$this->form_validation->set_message('authenticate','Intento Invalido. Intentalo de nuevo por favor.');

		return $this->form_validation->run();

	}

	public function authenticate() {
	
        return Current_User::login($this->input->post('username'), $this->input->post('password'));

	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */