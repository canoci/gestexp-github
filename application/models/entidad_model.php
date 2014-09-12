<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* End of file entidad_model.php */
/* Location: ./application/models/entidad_model.php */

class Entidad_Model extends CI_Model{

	public function __construct() {
    	parent::__construct();
    	$this->load->database();
  	}

  public function insertar($cif, $nombre, $direccion, $cp, $localidad, $provincia, $telefono, $email){
    $data = array(
      'cif' => $cif,
      'nombre' => $nombre,
      'direccion' => $direccion,
      'cp' => $cp,
      'localidad' => $localidad,
      'provincia' => $provincia,
      'telefono' => $telefono,
      'email' =>  $email);
    $this->db->insert('entidades', $data);
  }

  public function getEntidades() {
    $query = $this->db->get('Entidades');

    return $query->result();
  }
 
 
  public function getEntidad($cif) {
    $where = array('cif' => $cif);
    $query = $this->db->get_where('entidades',$where);
    
    return $query->result();

      }
  }

?>