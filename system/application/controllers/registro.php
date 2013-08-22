<?php

class Registro extends Controller {

	function Registro()
	{
		parent::Controller();
		$this->load->helper(array('form','url'));
	}

	function index()
	{
		if(isset(Current_User::user()->id)){
        $this->load->library('cart');
        $this->cart->destroy();
        $data['titulo']="Registro de productos.";
 
        $data['registro']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('registro/contenido');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
		}else{
		redirect('welcome');
		}
	}
    
	function historico()
	{
		if(isset(Current_User::user()->id)){
        $data['titulo']="Registro Historico.";
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
        
        $this->load->model('registro_model');
        $data['query'] = $this->registro_model->historico(Current_User::user()->idsuc); 
        $data['registro']='class="current_page_item"';
		$this->load->view('header', $data);
		$this->load->view('registro/historico');
		$this->load->view('welcome/panel');
		$this->load->view('footer');
		}else{
		redirect('welcome');
		}
	}

    function submit()
    {
    	if(isset(Current_User::user()->id)){
        $this->load->library('cart');
        $this->load->helper('string');
        $this->load->model('Registro_model');

        $suc_=Current_User::user()->idsuc;
    	$user_id_=Current_User::user()->id;
    	$ticket_=trim($this->input->post('ticket'));
        
        $tarjeta_=trim($this->input->post('cliente_oculto'));
        
        $cliente_ = $this->Registro_model->trae_id_cliente($tarjeta_);
        
        $cupon_ = strtoupper(random_string('alnum', 10));
        $llave_ = strtoupper(random_string('unique'));

        $tTable= Doctrine_Core::getTable('T');
        $ti=$tTable->findByTicket($ticket_);

        if($ti->count()==0){
        	$t =  new T();  
            $t->suc = $suc_;  
            $t->cliente_id = $cliente_;  
            $t->ticket = $ticket_;  
            $t->user_id = $user_id_;
            $t->cupon = $cupon_;
            $t->llave = $llave_;
            $t->save();

            $t_id=$t->id;

            foreach($this->cart->contents() as $items):
            
            $j=0;
            foreach ($this->cart->product_options($items['rowid']) as  $option_name => $option_value):
            
            $a[$j]=$option_value;
            
            $j++;
            endforeach;
            
            $d= new D();
            $d->t_id = $t_id;
            $d->ean = $a[0];
            $d->precio = $items['price'];
            $d->piezas = $items['qty'];
           
            $d->save();
            
        	endforeach;
            
            
            $query_ean = $this->Registro_model->Busca_ean($t_id);
                $num_rows_c = null;
                $grupo_c = null;
            foreach ($query_ean->result() as $row_ean)
            {
                $query_cliente = $this->Registro_model->Busca_cliente_productos($row_ean->ean, $cliente_);
                $num_rows_c = $query_cliente->num_rows(); 
                $grupo_c = $row_ean->grupo+1;
                
                $factor = floor($num_rows_c / $grupo_c);
                
                if($factor >= 1){
                    $i = 1;
                    $control = $factor * $grupo_c;
                    foreach ($query_cliente->result() as $row_cliente)
                    {   
                        if($i <= $control){
//                            $this->Registro_Model->Act_estatus($row_cliente->id);
        $sql_act_estatus="update d set estatus=1, updated_at=now() where id = ?;";
        $this->db->query($sql_act_estatus, array($row_cliente->id));
                        }
                        
                        $modulo = $i / $grupo_c;
//                        echo $i." esto es i<br>";
//                        echo $factor." este es el factor<br />";                        
//                        echo $modulo." este el modulo<br />";
//                        $vari=is_float($modulo);
//                        echo $vari." este float <br /><br />";
                        
                        if(is_float($modulo)){
//                            $this->Registro_model->Act_gratis($row_cliente->id);
                        }else{
        $sql_act_gratis="update d set gratis=1, updated_at=now() where id = ?;";
        $this->db->query($sql_act_gratis, array($row_cliente->id));
                        }

                        $i++;
                    }
                }

            }
//            die();

        }else{
        $this->cart->destroy();
        redirect('registro/duplicado/'.$ticket_);

        } 
        $this->cart->destroy();
        redirect('registro/resultado/'.$t_id);
    	}else{
            $this->cart->destroy();
    		redirect('welcome');
    	}

    }
    
    function resultado($t_id)
    {
    	if(isset(Current_User::user()->id)){
        $this->load->model('Registro_model');
        
        $query_id = $this->Registro_model->Busca_id($t_id);
        $query_cupon = $this->Registro_model->Info_cupon($t_id);
        $gratis = $this->Registro_model->gratis($t_id);
        $reclama = $this->Registro_model->reclama($t_id);

        $data['query_id'] = $query_id;
        $data['query_cupon'] = $query_cupon;
        $data['gratis'] = $gratis;
        $data['reclama'] = $reclama;
        
        $var['registro']='class="current_page_item"';
   		$data['titulo']="Resultado de la transacci&oacute;n.";
   		$var['extraHead'] = "
           <script type=\"text/javascript\" src=\"". base_url()."js/jquery.jPrintArea.js\"></script>";

   		$this->load->view('header', $var);
		$this->load->view('registro/transaccion', $data);
		$this->load->view('welcome/panel');
		$this->load->view('footer');
    	}else{
    		redirect('welcome');
    	}
        
    }

    function duplicado($ticket_)
    {
    	if(isset(Current_User::user()->id)){
        $this->load->model('Registro_model');


   		$data['titulo']="Este Ticket $ticket_ ya fue registrado.";
        $data['registro']='class="current_page_item"';

   		$this->load->view('header', $data);
		$this->load->view('registro/duplicada', $data);
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
        $row = $query->row();
        $data['numrows'] = $query->num_rows();
        $data['query']=$query;
        
        $this->load->library('table');
		$this->load->view('registro/trae_socio', $data);
	}

	function traecarro()
	{
        $this->load->database();
        $this->load->library('cart');
        $id_=$this->cart->total_items()+1;
        
        $this->load->model('producto_model');
        $query = $this->producto_model->Busca($this->input->post('producto'));
//        $query = $this->producto_model->Busca('750');
        
        $numrows = $query->num_rows();
        
        if($numrows>0){
            $row = $query->row();    
            $loko = array(
               'id'      => $id_,
               'qty'     => 1,
               'price'   => 1,
               'name'    => "$row->descripcion",
               'options' => array('EAN' => $row->ean)
            );
     	$this->cart->insert($loko);
        }

        
        $data['numrows']=$numrows;
        $data['items']=$this->cart->total_items();        
		$this->load->view('registro/trae_carro', $data);
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */