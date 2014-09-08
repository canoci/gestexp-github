<?php
class Doc_Aux_Model extends CI_Model{

	public function __construct() {
    	parent::__construct();
    	$this->load->database();
  	}

  	public function getTipoDocumentos(){
  		//hacemos la consulta
  		$query = $this->db->query('SELECT * FROM documentos_aux');

  		//si hay resultados
  		if($query->num_rows() > 0){
  			foreach ($query->result() as $row) {
  				$array[$row->id_doc] = $row->nombre_tipo_doc;
  			}
  			return $array;
  		}
  	}
}
?>