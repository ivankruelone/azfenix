<?php

class Cliente extends Controller {

	function Cliente()
	{
		parent::Controller();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		if(isset(Current_User::user()->id)){
        $this->load->database();
        $data['titulo']="Clientes.";   
        $this->load->library('table');
        $tmpl = array (
                    'table_open'          => '<table id="hor-minimalist-b">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th scope="col">',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );

		$this->table->set_template($tmpl);
        $this->load->model('cliente_model');
        $data['query'] = $this->cliente_model->Clientes_todos(Current_User::user()->idsuc); 
        $data['clientes']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('clientes/contenido');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('welcome');
		}
	}

	function cli()
	{
		if(isset(Current_User::user()->id) && (Current_User::user()->nivel == 2 || Current_User::user()->nivel == 4)){
   		$data['extraHead'] = "
           <script type=\"text/javascript\" src=\"". base_url()."js/highslide-with-html.min.js\"></script>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"". base_url()."css/highslide.css\" type=\"text/css\" media=\"screen\" />
";
        $this->load->database();
        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'index.php/cliente/cli/';
        $config['total_rows'] = $this->db->count_all('clientes');
        $config['per_page'] = 200;
        $config['full_tag_open'] = '<p>';
        $config['full_tag_close'] = '</p>';

        $this->pagination->initialize($config);
	
        
        $data['titulo']="Clientes.";   
        $this->load->model('cliente_model');
        $data['tabla'] = $this->cliente_model->Clientes_nivel2($config['per_page'], $this->uri->segment(3)); 
        $data['clientes']='class="current_page_item"';
        $data['lins'] = 1;
		$this->load->view('header', $data);
		$this->load->view('clientes/contenido2');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
	}
	
	function ver($id)
	{
		if(isset(Current_User::user()->id) && (Current_User::user()->nivel == 2 || Current_User::user()->nivel == 4)){
        $this->load->database();
        //$data['titulo']="Datos del Cliente $id";   
        $this->load->model('cliente_model');
        $data['tabla'] = $this->cliente_model->Clientes_ver($id); 
		$this->load->view('clientes/ver', $data);
		}else{
			echo "Sesion Caducada";
		}
	}

	function his($id)
	{
        $this->load->database();
        $this->load->model('cliente_model');
        $query = $this->cliente_model->Clientes_uno($id);
		$data['numrows'] = $query->num_rows();        
        $row = $query->row();
        if($data['numrows'] > 0){
        $this->load->model('consulta_model');
		$data['tabla'] = $this->consulta_model->Consulta_detalle($row->id);        

        }
        $data['query'] = $query;
        $this->load->library('table');
		$this->load->view('consulta/trae_socio', $data);
	}

	function submit_busca()
	{
		if(isset(Current_User::user()->id) && (Current_User::user()->nivel == 2 || Current_User::user()->nivel == 4)){
   		$data['extraHead'] = "
           <script type=\"text/javascript\" src=\"". base_url()."js/highslide-with-html.min.js\"></script>
        <link rel=\"stylesheet\" type=\"text/css\" href=\"". base_url()."css/highslide.css\" type=\"text/css\" media=\"screen\" />
";
        $this->load->database();
        $data['titulo']="Coincidencias Clientes.";   
        $this->load->model('cliente_model');
        $data['tabla'] = $this->cliente_model->Clientes_nivel2(null, null, $this->input->post('busca')); 
        $data['clientes']='class="current_page_item"';
        $data['lins'] = 2;
		$this->load->view('header', $data);
		$this->load->view('clientes/contenido2');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
	}

	function cliente_captura()
	{
		if(isset(Current_User::user()->id)){
        $data['titulo']="Nuevo Cliente.";   
        $data['clientes']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('clientes/cliente_form');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
		}else
		redirect('welcome');
	}

	function submit()
	{
		if(isset(Current_User::user()->id)){
	   $anio_ = $this->input->post('anio');
	   $mes_ = $this->input->post('mes');
	   $dia_ = $this->input->post('dia');
       
       if($anio_ > 0 && $mes_ > 0 && $dia_ > 0){
            $fecha_=$anio_."-".$mes_."-".$dia_;
       }else{
            $fecha_='0000-00-00';
       }
       
       if(Current_User::user()->nivel == 2){
        $idsuc_= 699;
       }else{
        $idsuc_= $this->session->userdata('idsuc');
       }

       //id, nombre, apaterno, amaterno, nacio, sexo, cp, telefono, mail, cedula, dosis, tiempo, idsuc, activo, created_at, updated_at
        $c = new Clientes();
        $c->tarjeta = trim(strtoupper($this->input->post('tarjeta')));
        $c->nombre = trim(strtoupper($this->input->post('nombre')));
        $c->apaterno = trim(strtoupper($this->input->post('apaterno')));
        $c->amaterno = trim(strtoupper($this->input->post('amaterno')));
        $c->nacio = $fecha_;
        $c->sexo = strtoupper($this->input->post('sexo'));
        $c->cp = strtoupper($this->input->post('cp'));
        $c->idsuc = $idsuc_;
        $c->telefono = $this->input->post('tel');
        $c->mail = $this->input->post('email');
        $c->dosis = $this->input->post('dosis');
        $c->tiempo = $this->input->post('tiempo');
        
        $c->save();
       
		redirect('/cliente');
	}else{
		redirect('welcome');
	}
}

}
/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */