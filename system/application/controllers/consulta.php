<?php

class Consulta extends Controller {

	function Consulta()
	{
		parent::Controller();
		$this->load->helper(array('form','url'));
	}

	function index()
	{
	if(isset(Current_user::user()->id)){

        $data['titulo']="Consulta de Productos Registrados.";
        $data['consulta']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('consulta/contenido');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
	}else{
		redirect('welcome');
	}
	}

	function traesocio()
	{
        $this->load->database();
        $this->load->model('cliente_model');
        $query = $this->cliente_model->Clientes_uno($this->input->post('socio'));
		$data['numrows'] = $query->num_rows();        
        $row = $query->row();
        if($data['numrows'] > 0){
        $this->load->model('consulta_model');
		$data['tabla'] = $this->consulta_model->Consulta_pendientes($row->id);        

        }
        $data['query'] = $query;
        $this->load->library('table');
		$this->load->view('consulta/trae_socio', $data);
	}

	function traesocio1()
	{
        $this->load->database();
        $this->load->model('cliente_model');
        $query = $this->cliente_model->Clientes_uno($this->input->post('socio'));
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
}