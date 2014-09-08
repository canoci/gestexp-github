<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagina_model extends CI_Model
{
	public function construct()
	{
		parent::__construct();
	}
	
    //obtenemos el total de filas para hacer la paginación
	function filas($tabla)
	{
		$consulta = $this->db->get($tabla);
		return  $consulta->num_rows() ;
	}
        
    //obtenemos todas las provincias a paginar con la función
    //total_posts_paginados pasando la cantidad por página y el segmento
    //como parámetros de la misma
	function total_paginados($tabla, $por_pagina,$segmento) 
        {
            $consulta = $this->db->get($tabla,$por_pagina,$segmento);
            if($consulta->num_rows()>0)
            {
                foreach($consulta->result() as $fila)
		{
		    $data[] = $fila;
		}
                    return $data;
            }
	}
	
}
