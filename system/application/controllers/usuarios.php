<?php

class Usuarios extends Controller {

	public function __construct() {
		parent::Controller();

		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		if(isset(Current_User::user()->id) && Current_User::user()->nivel == 2){
        $this->load->database();
        $data['titulo']="Catalogo de Usuarios.";   
        $this->load->model('usuarios_model');
        $data['query'] = $this->usuarios_model->Catalogo(); 
        $data['usuarios']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('usuarios/contenido');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
	}
	
	public function agregar() {
		if(isset(Current_User::user()->id) && Current_User::user()->nivel == 2){
        $this->load->database();
        $data['titulo']="Agregar Usuario.";   
        $this->load->model('sucursal_model');
        $data['query'] = $this->sucursal_model->Catalogo(); 
		$data['nivel']=array(
                  '1'  => 'Usuario de Farmacia'
                );
        $data['usuarios']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('usuarios/signup_form');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
			}

	public function submit() {

		if ($this->_submit_validate() === FALSE) {
			$this->agregar();
			return;
		}
        
        $u = new User();
        $u->username = utf8_decode(strtolower($this->input->post('username')));
        $u->password = $this->input->post('password');
        $u->nombre = utf8_decode(strtoupper($this->input->post('nombre')));
        $u->nivel = $this->input->post('nivel');
        $u->idsuc = $this->input->post('idsuc');
        $u->save();
    

		$this->load->view('signup/submit_success');

	}

	private function _submit_validate() {

		// validation rules
		$this->form_validation->set_rules('username', 'Username',
			'required|alpha_numeric|min_length[6]|max_length[12]|unique[User.username]');

		$this->form_validation->set_rules('password', 'Password',
			'required|min_length[6]|max_length[12]');

		$this->form_validation->set_rules('passconf', 'Confirm Password',
			'required|matches[password]');

		$this->form_validation->set_rules('nombre', 'Nombre',
			'required');

		$this->form_validation->set_rules('nivel', 'Nivel',
			'required');

		$this->form_validation->set_rules('idsuc', 'Sucursal',
			'required');

		return $this->form_validation->run();

	}
	
	public function modificar($id) {
		if(isset(Current_User::user()->id) && Current_User::user()->nivel == 2){
        $this->load->database();
        $data['titulo']="Modificar Usuario.";   
        $this->load->model('sucursal_model');
        $data['query'] = $this->sucursal_model->Catalogo(); 
		$data['nivel']=array(
                  '1'  => 'Usuario de Farmacia'
                );
        $this->load->model('usuarios_model');
        $data['usu'] = $this->usuarios_model->Busca_id($id);
        $data['usuarios']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('usuarios/modificar_form');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
			}

	public function submit_modificar() {

		if ($this->_submit_validate_modificar() === FALSE) {
			$this->modificar($this->input->post('id_user'));
			return;
		}
        
		$u = Doctrine::getTable('User')->findOneById($this->input->post('id_user'));
        $u->username = utf8_decode(strtolower($this->input->post('username')));
        $u->nombre = utf8_decode(strtoupper($this->input->post('nombre')));
        $u->idsuc = $this->input->post('idsuc');
        $u->activo = $this->input->post('activo');
        $u->save();
    

		$this->index();

	}

	private function _submit_validate_modificar() {

		// validation rules
		$this->form_validation->set_rules('username', 'Username',
			'required|alpha_numeric|min_length[6]|max_length[12]|unique[User.username]');

		$this->form_validation->set_rules('nombre', 'Nombre',
			'required');

		$this->form_validation->set_rules('idsuc', 'Sucursal',
			'required');

		return $this->form_validation->run();

	}
			

	public function pw($id) {
		if(isset(Current_User::user()->id) && Current_User::user()->nivel == 2){
        $data['titulo']="Forzar Password.";   
        $data['id'] = $id;
        $data['usuarios']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('usuarios/pw');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
			}

	public function submit_pw() {

		if ($this->_submit_validate_pw() === FALSE) {
			$this->pw($this->input->post('id_user'));
			return;
		}
        
		$u = Doctrine::getTable('User')->findOneById($this->input->post('id_user'));
        $u->password = $this->input->post('password');
        $u->save();
    

		$this->index();

	}

	private function _submit_validate_pw() {

		$this->form_validation->set_rules('password', 'Password',
			'required|min_length[6]|max_length[12]');

		$this->form_validation->set_rules('passconf', 'Confirm Password',
			'required|matches[password]');
		
		return $this->form_validation->run();

	}
	
	
}