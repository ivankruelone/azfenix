<?php
class Current_User {

	private static $user;

	private function __construct() {}

	public static function user() {

		if(!isset(self::$user)) {

			$CI =& get_instance();
			$CI->load->library('session');

			if (!$user_id = $CI->session->userdata('user_id')) {
				return FALSE;
			}

			if (!$u = Doctrine::getTable('User')->find($user_id)) {
				return FALSE;
			}

			self::$user = $u;
		}

		return self::$user;
	}

	public static function login($username, $password) {

		// get User object by username
		if ($u = Doctrine::getTable('User')->findOneByUsername($username)) {
		  
            $s =Doctrine::getTable('Suc')->findOneBysuc($u->idsuc);
            //$j =Doctrine::getTable('juris')->findOneByjur($s->jur);

			// this mutates (encrypts) the input password
			$u_input = new User();
			$u_input->password = $password;

			// password match (comparing encrypted passwords)
			if ($u->password == $u_input->password) {
				unset($u_input);

				$CI =& get_instance();
				$CI->load->library('session');
				$CI->session->set_userdata('user_id',$u->id);
				$CI->session->set_userdata('username',$u->username);
				//$CI->session->set_userdata('nombre',$u->nombre);
				$CI->session->set_userdata('nivel',$u->nivel);
				$CI->session->set_userdata('idsuc',$u->idsuc);
				$CI->session->set_userdata('activo',$u->id);
				$CI->session->set_userdata('alta',$u->created_at);
				$CI->session->set_userdata('sucursal',$s->nombre);
				//$CI->session->set_userdata('cvesuc',$s->cvesuc);
                //$CI->session->set_userdata('idsuc',$s->idsuc);
                //$CI->session->set_userdata('jur',$s->jur);
                //$CI->session->set_userdata('jurnombre',$j->desjur);
				self::$user = $u;

				return TRUE;
			}

			unset($u_input);
		}

		// login failed
		return FALSE;

	}
    

	public function __clone() {
		trigger_error('Clone is not allowed.', E_USER_ERROR);
	}

}