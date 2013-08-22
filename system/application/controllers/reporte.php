<?php

class Reporte extends Controller {

	function Reporte()
	{
		parent::Controller();
		$this->load->helper(array('form','url'));
		$this->load->library('form_validation');
	}

	function index()
	{
		if(isset(Current_User::user()->id)){
        $data['titulo']="Consulta de Informacion";   
        $data['rep']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('reporte/contenido');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
		}else{
			redirect('welcome');
		}
	}

	function traereporte()
	{
		if(isset(Current_User::user()->id)){
		  
        $this->load->model('reporte_model');
        $data['query'] = $this->reporte_model->Consulta_previa($this->input->post('anio'), $this->input->post('mes'));
        $this->load->library('table');
        $data['anio'] = $this->input->post('anio');
        $data['mes'] = $this->input->post('mes');
        
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
		$this->load->view('reporte/traereporte', $data);
		}
	}
    
	function rep_excel($anio, $mes)
	{
		if(isset(Current_User::user()->id)){
        $this->load->model('reporte_model');
        $data['query'] = $this->reporte_model->Consulta($anio, $mes);
        $data['anio'] = $anio;
        $data['mes'] = $mes;
        
		$this->load->view('excel/rep01', $data);
		}else{
			redirect('welcome');
		}
	}

}