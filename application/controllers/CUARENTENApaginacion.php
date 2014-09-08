<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paginacion extends CI_Controller 
{
	function __construct() 
	{
		parent::__construct();
		$this->load->model('pagina_model');
	}
	
	function paginar($tabla)
	{
		$data['title'] = $tabla;
		$pages=10; //Número de registros mostrados por páginas
		$this->load->library('pagination'); //Cargamos la librería de paginación
		$config['base_url'] = base_url().'paginacion/pagina/'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
		$config['total_rows'] = $this->pagina_model->filas();//calcula el número de filas  
		$config['per_page'] = $pages; //Número de registros mostrados por páginas
        $config['num_links'] = 10; //Número de links mostrados en la paginación
 		$config['first_link'] = 'Primera';//primer link
		$config['last_link'] = 'Última';//último link
        $config["uri_segment"] = 3;//el segmento de la paginación
		$config['next_link'] = 'Siguiente';//siguiente link
		$config['prev_link'] = 'Anterior';//anterior link
		$config['full_tag_open'] = '<div id="paginacion">';//el div que debemos maquetar
		$config['full_tag_close'] = '</div>';//el cierre del div de la paginación
		$this->pagination->initialize($config); //inicializamos la paginación	

		$data["expedientes"] = $this->pagina_model->total_paginados($tabla, $config['per_page'],$this->uri->segment(3));			
                
                //cargamos la vista y el array data
		$this->load->view('expediente_list', $data);
	}
}
