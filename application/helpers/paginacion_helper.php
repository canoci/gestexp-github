<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('paginar($tabla, $salida_view)'))
     {
       
/*
	Funcion paginar($tabla, $salida_view)

	Descripcion: Se la pasa una tabla y la devuelve entera paginada
	Argumentos: $tabla -> la tabla a paginar
				$salida_view -> la pagina en la que queremos que se muestren los datos

 */
       function paginar($tabla, $salida_view)
       {	
       		//Asignamos a $ci el super objeto de codeigniter
        	//$ci será como $ci
        	$ci =& get_instance();
       		$ci->load->model('pagina_model');

	        $data['title'] = $tabla;
			$pages=10; //Número de registros mostrados por páginas
			$ci->load->library('pagination'); //Cargamos la librería de paginación
			$config['base_url'] = base_url().'paginacion/pagina/'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
			$config['total_rows'] = $ci->pagina_model->filas();//calcula el número de filas  
			$config['per_page'] = $pages; //Número de registros mostrados por páginas
	        $config['num_links'] = 10; //Número de links mostrados en la paginación
	 		$config['first_link'] = 'Primera';//primer link
			$config['last_link'] = 'Última';//último link
	        $config["uri_segment"] = 3;//el segmento de la paginación
			$config['next_link'] = 'Siguiente';//siguiente link
			$config['prev_link'] = 'Anterior';//anterior link
			$config['full_tag_open'] = '<div id="paginacion">';//el div que debemos maquetar
			$config['full_tag_close'] = '</div>';//el cierre del div de la paginación
			$ci->pagination->initialize($config); //inicializamos la paginación	

			$data["resultados"] = $ci->pagina_model->total_paginados($tabla, $config['per_page'],$ci->uri->segment(3));			
	                
	                //cargamos la vista y el array data
			$ci->load->view($salida_view, $data);
       }
     }

/*
	Funcion filas($tabla)

	Descripcion: Se le pasa una tabla y devuelve el número de registros
	Argumentos: $tabla -> la tabla de la que se quieren averiguar el número de registros
 */
	function filas($tabla)
	{
		//Asignamos a $ci el super objeto de codeigniter
        //$ci será como $ci
        $ci =& get_instance();
		$consulta = $ci->db->get($tabla);
		return  $consulta->num_rows() ;
	}



        
/*
	Funcion total_paginados($tabla, $por_pagina,$segmento)

	Descripcion: Se le pasa una tabla, el número de elementos por página que queremos
	Argumentos: $tabla -> la tabla de la que se quieren averiguar el número de registros
 */
	function total_paginados($tabla, $por_pagina,$segmento) 
        {
        	//Asignamos a $ci el super objeto de codeigniter
        	//$ci será como $ci
        	$ci =& get_instance();
        	
            $consulta = $ci->db->get($tabla,$por_pagina,$segmento);

            if($consulta->num_rows()>0)
            {
                foreach($consulta->result() as $fila)
				{
				    $data[] = $fila;
				}
                return $data;
            }
	}
/* End of file paginacion.php */
/* Location: ./application/helpers/paginacion.php */