<?php

class Documento_Model extends CI_Model{

	public function __construct() {
    	parent::__construct();
    	$this->load->database();
  	}

  public function record_count() {
        return $this->db->count_all("documentos");
  }

  public function getDocumentos_pagination($limit, $offset){
    $data = array();
    $this->db->limit($limit, $offset);
    $query = $this->db->get('documentos');
    if($query->num_rows > 0){
      foreach ($query->result_array() as $row) {
        $data[] = $row;
      }
    }
    $query->free_result();
    return $data;
  }

  public function selectDocumentos() {
 
    $sql = "
      SELECT `id_doc`
      ,`tipo_doc`
      ,`nombre`
      ,`ruta`
      ,`num_registro`
      ,`num_pag`
      FROM `documentos`
      ORDER BY `id_doc` ASC;
      ";
 
    $result = $this->db->query($sql);
    if(!$result) {
      return false;
    }
 
    return $result;
  }
 
  public function selectDocumento($id) {
 
    $where = array ('id_doc'=>$id);
    $result = $this->db->get_where('documentos',$where);

    if(!$result) {
      return false;
    }
    return $result->row();
  }


  public function buscar_Documento($busqueda) {
  
    $sql = "
    SELECT `documentos`.`id_doc`,
     `documentos`.`tipo_doc`,
     `documentos`.`nombre`, 
     `documentos`.`ruta`, 
     `documentos`.`num_registro`, 
     `documentos`.`num_pag`, 
     `documentos_aux`.`nombre_tipo_doc`
    FROM `documentos`
    INNER JOIN `documentos_aux` ON `documentos`.`tipo_doc`=`documentos_aux`.`id_doc`
    WHERE  (`documentos`.`nombre`  LIKE ?);
    ";
 
 
    $result = $this->db->query($sql, array('%'.$busqueda.'%','%'.$busqueda.'%'));
    if(!$result) {
      return false;
    }
 
    return $result;
  }






  	public function insertarDocumento($tipo_doc, $nombre, $ruta, $num_registro, $num_pag){
  		$data = array(
        'tipo_doc' => $tipo_doc,
        'nombre' => $nombre,
        'ruta' => $ruta,
        'num_registro' => $num_registro,
        'num_pag' => $num_pag
    );
    $result = $this->db->insert('documentos', $data);

    return $this->db->insert_id();
  	}
}

?>