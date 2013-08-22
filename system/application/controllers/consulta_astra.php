<?php

class Consulta_astra extends Controller {

	function Consulta_astra()
	{
		parent::Controller();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		if(isset(Current_User::user()->id)){
        $data['titulo']="Consulta de Informacion";   
        $data['consulta']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('consulta_astra/contenido');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
		}else{
			redirect('welcome');
		}
	}

	function traereporte()
	{
		if(isset(Current_User::user()->id)){
		  
        $this->load->model('astra_model');
        $data['query'] = $this->astra_model->Consulta_gratis($this->input->post('anio'), $this->input->post('mes'));
        $data['anio'] = $this->input->post('anio');
        $data['mes'] = $this->input->post('mes');
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
		$this->load->view('consulta_astra/traereporte', $data);
		}
	}
    
	function rep_excel($anio, $mes)
	{
		if(isset(Current_User::user()->id)){
        $this->load->model('astra_model');
        $data['query'] = $this->astra_model->Consulta_gratis($anio, $mes);
        $data['anio'] = $anio;
        $data['mes'] = $mes;
        
		$this->load->view('excel/rep02', $data);
		}else{
			redirect('welcome');
		}
	}
    
	function mensual()
	{
		if(isset(Current_User::user()->id)){
        $data['titulo']="Reporte Concentrado Mensual";   
        $data['mensual']='class="current_page_item"';
        $this->load->model('astra_model');
        $data['query'] = $this->astra_model->concentrado();
		$this->load->view('header', $data);
		$this->load->view('consulta_astra/mensual');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
		}else{
			redirect('welcome');
		}
	}
    
    function excel_mensual()
    {
		if(isset(Current_User::user()->id)){
        $data['titulo']="Reporte Concentrado Mensual";   
        $this->load->model('astra_model');
        $data['query'] = $this->astra_model->mensual_consulta();
        $data['serie'] = $this->astra_model->serie();
        $data['registros'] = $data['query']->num_rows();

		$this->load->view('excel/excel_mensual', $data);
		}else{
			redirect('welcome');
		}
        
    }

}