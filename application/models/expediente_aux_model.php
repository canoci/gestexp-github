<?php
class Expediente_Aux_Model extends CI_Model{

	public function __construct() {
    	parent::__construct();
    	$this->load->database();
  	}

  	public function getExpedientesDatos(){
  		//hacemos la consulta
  		$query = $this->db->query('SELECT * FROM expedientes_aux');

  		//si hay resultados
  		if($query->num_rows() > 0){
  			foreach ($query->result() as $row) {
  				$array[$row->id_exp] = $row->nombre_tipo_exp;
  			}
  			return $array;
  		}
  	}

    public function getTipoExpediente($id_exp){
      //hacemos la consulta
      $where = array('id_exp' => $id_exp);
      $query = $this->db->get_where('expedientes_aux', $where);

      //si hay resultados
      if($query->num_rows() > 0){
        foreach ($query->result() as $row) {
          $nombre_tipo_exp = $row->nombre_tipo_exp;
        }
        return $nombre_tipo_exp;
      }
    }
}
?>