<?php

class Productos extends Controller {

	function Productos()
	{
		parent::Controller();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
        $this->load->database();
        $data['titulo']="Articulos en promoci&oacute;n.";   
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
        $this->load->model('producto_model');
        $data['query'] = $this->producto_model->Catalogo(); 
        $data['productos']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('productos/contenido');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close(); 
	}

	function pro()
	{
		if(isset(Current_User::user()->id) && Current_User::user()->nivel == 2){
        $this->load->database();
        $data['titulo']="Articulos en promoci&oacute;n.";   
        $this->load->model('producto_model');
        $data['query'] = $this->producto_model->Catalogo(); 
        $data['productos']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('productos/contenido2');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
	}

	function modificar($id)
	{
		if(isset(Current_User::user()->id) && Current_User::user()->nivel == 2){
		$this->load->database();
        $data['titulo']="Modificar Articulo.";   
        $this->load->model('producto_model');
        $var['query'] = $this->producto_model->Busca_id2($id);
        $data['productos']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('productos/modificar', $var);
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
	}
	
	function submit_modificar()
	{
		if(isset(Current_User::user()->id) && Current_User::user()->nivel == 2){

		$this->load->database();
		$this->load->helper('date');
        $data['titulo']="Modificar Articulo.";
        
        $datestring = "%Y-%m-%d %H:%i:%s";
        $time = time();

        $datos = array(
				'ean' => trim($this->input->post('ean')),
				'descripcion' => strtoupper(trim($this->input->post('descripcion'))),
				'grupo' => $this->input->post('grupo'),
        		'activo' => $this->input->post('activo'),
        		'modificada' => mdate($datestring, $time),
				'eanalt' => trim($this->input->post('eanalt')),
				'descripcionalt' => strtoupper(trim($this->input->post('descripcionalt')))
            );

		$this->db->where('id', $this->input->post('id_producto'));
		$this->db->update('cat', $datos); 
        
        $data['productos']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('productos/modificar_exi');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
	}
	
	function nuevo()
	{
		if(isset(Current_User::user()->id) && Current_User::user()->nivel == 2){
        $data['titulo']="Alta de Producto.";
        $data['productos']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('productos/nuevo');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
	}

	function submit_nuevo()
	{
		if(isset(Current_User::user()->id) && Current_User::user()->nivel == 2){

		$this->load->database();
		$this->load->helper('date');
        $data['titulo']="Modificar Articulo.";
        
        $datestring = "%Y-%m-%d %H:%i:%s";
        $time = time();

        $datos = array(
				'ean' => trim($this->input->post('ean')),
				'descripcion' => strtoupper(trim($this->input->post('descripcion'))),
				'grupo' => $this->input->post('grupo'),
        		'activo' => $this->input->post('activo'),
        		'alta' => mdate($datestring, $time),
				'eanalt' => trim($this->input->post('eanalt')),
				'descripcionalt' => strtoupper(trim($this->input->post('descripcionalt')))
            );

		$this->db->insert('cat', $datos);
        
        $data['productos']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('productos/modificar_exi');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
        $this->db->close();
		}else{
			redirect('logout');
		}
	}
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */