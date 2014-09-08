<?php
class Exp_Doc_Model extends CI_Model{

	public function __construct() {
    	parent::__construct();
    	$this->load->database();
  	}

  	public function getExpedientesDocumentos(){
  		//hacemos la consulta
  		$query = $this->db->query('SELECT * FROM exp_doc');

  		//si hay resultados
  		if($query->num_rows() > 0){
  			foreach ($query->result() as $row) {
  				$array[$row->id_exp] = $row->nombre_tipo_exp;
  			}
  			return $array;
  		}
  	}

      public function getExpedienteDocumentos($id_exp){
      
      //Primero consigo los id de los documentos que pertenecen al expediente
      $sql = "SELECT * FROM exp_doc WHERE id_exp = ?";
      $bindings = array($id_exp);
      $query = $this->db->query($sql, $bindings);
      
      //si hay resultados, se consulta en la BBDD 'documentos' los datos de los documentos que pertenecen a dicho expediente
      if($query->num_rows() > 0){
        foreach ($query->result() as $row) {
          $id_documentos[] = intval($row->id_doc);
        }     
        return $id_documentos;
      }
  }
}
?>