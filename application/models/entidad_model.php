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
    $term = $this->input->post('term');
    $this->db->distinct();
    $this->db->select('nombre','id_ent');
    $this->db->like('nombre', $term, 'after');
    $query = $this->db->get('Entidades');
    return $query->result();
  }
 
 
  public function getEntidad($cif) {
    $where = array('cif' => $cif);
    $query = $this->db->get_where('entidades',$where);

  //Si hay resultados
    $res = array(
      'estado' => FALSE,
      'nombre' => ""
     );
      if($query->num_rows() > 0){
        foreach ($query->result() as $row) {
          $res['estado'] = TRUE;
          $res['cif'] = $row->cif;
          $res['nombre'] = $row->nombre;
          $res['direccion'] = $row->direccion;
          $res['cp'] = $row->cp;
          $res['localidad'] = $row->localidad;
          $res['provincia'] = $row->provincia;
          $res['telefono'] = $row->telefono;
          $res['email'] = $row->email;
        }
        
        //return json_encode($res);
        echo json_encode($res);

      }
  }

  function get_data($item,$match) { 
     
   $this->db->like($item, $match); 
   $query = $this->db->get('entidades'); 
   return $query->result();        
  }
}
?>