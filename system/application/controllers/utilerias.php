<?php
Class Utilerias extends Controller
{
    public function __construct()
    {
        parent::Controller();
        
   		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');        
    }
    
    function cambio_contrasena()
    {
   		$data['extraHead'] = "<script type=\"text/javascript\" src=\"". base_url()."js/jquery-1.4.2.min.js\"></script>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"". base_url() ."css/cambia_contra.css\" />";

   		$this->load->helper(array('form','url'));
		$this->load->view('header', $data);
		$this->load->view('utilerias/cam_con');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
   		    }
    
   	public function submit() {

		if ($this->_submit_validate() === FALSE) {
			$this->cambio_contrasena();
			return;
		}

		redirect('/utilerias/cambio_exitoso');

	}
    
    
      	public static function comprueba_pw($username, $password, $n_pass) {

		// get User object by username
		if ($u = Doctrine::getTable('User')->findOneByUsername($username)) {
		  

			// this mutates (encrypts) the input password
			$u_input = new User();
			$u_input->password = $password;

			// password match (comparing encrypted passwords)
			if ($u->password == $u_input->password) {

            $u->password = $n_pass;
            $u->save();

				return TRUE;
			}

			unset($u_input);
		}

		// login failed
		return FALSE;

	}

	private function _submit_validate() {

		$this->form_validation->set_rules('pw_actual', 'Password Actual',
			'trim|required|callback_authenticate');

		$this->form_validation->set_rules('pw_nuevo1', 'Password Nuevo',
			'trim|required');
            
		$this->form_validation->set_rules('pw_nuevo2', 'Password Nuevo Repite',
			'trim|required|matches[pw_nuevo1]');
            
		$this->form_validation->set_message('authenticate','Intento Invalido. Intentalo de nuevo por favor.');

		return $this->form_validation->run();

	}

	public function authenticate() {

        return Utilerias::comprueba_pw( Current_User::user()->username, $this->input->post('pw_actual'), $this->input->post('pw_nuevo1'));

	}

    function cambio_exitoso()
    {

   		$this->load->helper(array('form','url'));
		$this->load->view('header');
		$this->load->view('utilerias/cam_exi');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
    }
    
}