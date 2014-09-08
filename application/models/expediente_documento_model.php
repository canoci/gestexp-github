<?php

class Expediente_Documento_Model extends CI_Model{

	public function __construct() {
    	parent::__construct();
    	$this->load->database();
  	}

  	public function insertarExpedienteDocumento($id_exp, $id_doc){
  		$fecha = date('Ymd');
      $data = array(
        'id_exp' => $id_exp,
        'id_doc' => $id_doc,
        'fecha_inclusion' => $fecha
    );
    return $this->db->insert('exp_doc', $data);
  	}

}

?>