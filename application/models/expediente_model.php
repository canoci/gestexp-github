<?php
class Expediente_Model extends CI_Model {
 
  public function __construct() {
    parent::__construct();
    $this->load->database();
  }
 
  public function record_count() {
        return $this->db->count_all("expedientes");
  }

  public function getExpedientes(){
    $query = $this->db->get('expedientes');
    return $query;
  }

  public function getExpedientes_pagination($limit, $offset){
    $data = array();
    $this->db->limit($limit, $offset);
    $query = $this->db->get('expedientes');
    if($query->num_rows > 0){
      foreach ($query->result_array() as $row) {
        $data[] = $row;
      }
    }
    $query->free_result();
    return $data;
  }

  public function selectExpedientes() {
 
    $result = $this->db->get('expedientes');
    if(!$result) {
      return false;
    }
 
    return $result;
  }
 
  public function selectExpediente($id) {
 
    $sql = "
      SELECT `id_exp`
      ,`tipo_exp`
      ,`cod_exp`
      ,`cif_ent`
      ,`asunto`
      ,`fecha_creacion`
      ,`fecha_modificacion`
      ,`cerrado`
      FROM `expedientes`
      WHERE `id_exp` = ?;
      ";
 
    $bindings = array(
      $id
    );
 
    $result = $this->db->query($sql, $bindings);
    if(!$result) {
      return false;
    }
 
    return $result;
  }

  public function buscar_expediente($busqueda) {
  
    //Recordar que si no tengo los datos bien en el expediente del CIF, y no encuentra a la entidad,
    //no busca tampoco por el asunto. 

    //Inicio ACTIVE RECORD
    $this->db->select('exp.*, ent.nombre');
    $this->db->from('expedientes as exp');
    $this->db->join('entidades as ent','ent.cif = exp.cif_ent','INNER');
    $this->db->like('ent.nombre',$busqueda);
    $this->db->or_like('exp.asunto',$busqueda);
    $this->db->order_by('id_exp','asc');
    $result = $this->db->get();
    //FIN ACTIVE RECORD

    return $result;
  }


function insertar_expediente($tipo_exp, $cif, $asunto){
    $data = array(
        'tipo_exp' => $tipo_exp,
        'cif_ent' => $cif,
        'asunto' => $asunto
    );
    return $this->db->insert('expedientes', $data);
  }

function get_expedientes_autompletar($q){
  $this->db->select('expedientes');
  $this->db->like('asunto',$q,'after');
  $query = $this->db->get('expedientes');
  if($query->num_rows > 0){
    foreach ($query->result_array() as $row) {
      $row_set[] = htmlentities(stripcslashes($row['asunto']));
    }
    echo json_encode($row_set);
  }
}
}