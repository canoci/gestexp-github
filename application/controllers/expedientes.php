<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Expedientes extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('Expediente_Model');
    $this->load->library('pagination');

    //$this->output->enable_profiler(TRUE);
  }

  public function index() {
  $this->load->library('table');
  $data = array();

    $query = $this->Expediente_Model->selectExpedientes();
    if(!$query || $query->num_rows() < 1) {
      $data['expediente_list'] = null;
    }
    else {
        //Aquí recupero los datos para la PAGINACION
          $ci_pagination = $this->ci_pagination("index.php/expedientes/index",'Expediente_Model','getExpedientes_pagination');
          $data['datatable'] = $ci_pagination['datatable'];
        //PAGINACIÓN HASTA AQUÍ

       //Para mostrar los datos en TABLAS

          $table = $this->format_table_exp($query->result_array(),"Expedientes");
          $data['table'] = $table;
        }
        //Fin de configuración TABLAS

    $data['num_exp'] = $this->Expediente_Model->record_count();
    $data['content'] = 'expediente_list';
    $this->load->view('layout',$data);
  }


  public function prod($prod_id) {
    $this->load->library('table');

    if(!$prod_id) {
      show_404();
      return;
    }

    $query = $this->Expediente_Model->selectExpediente($prod_id);
    if(!$query || $query->num_rows() < 1) {
      //show_404();
      return;
    }

    $row = $query->row();
    if(!$row) {
      //show_404();
      return;
    }else{

    $expediente = array( );
    $expediente['id_exp'] = $row->id_exp;
    $expediente['tipo_exp'] = $row->tipo_exp;
    $expediente['cod_exp'] = $row->cod_exp;
    $expediente['cif_ent'] = $row->cif_ent;
    $expediente['asunto'] = $row->asunto;
    $expediente['fecha_creacion'] = $row->fecha_creacion;
    $expediente['fecha_modificacion'] = $row->fecha_modificacion;
    $expediente['cerrado'] = $row->cerrado;

    //Se guarda también el tipo de expediente para la vista
    $this->load->model('Expediente_Aux_Model');
    $expediente['nombre_tipo_exp'] = $this->Expediente_Aux_Model->getTipoExpediente($expediente['tipo_exp']);

    //Se guarda el nombre de la entidad para la vista
    $this->load->model('Entidad_Model');
    $expediente['nombre_entidad'] = $this->Entidad_Model->getEntidad($expediente['cif_ent']);
    $data['expediente_data'] = $expediente;

    //
    $this->load->model('Exp_Doc_Model');
    $id_documentos_rel = $this->Exp_Doc_Model->getExpedienteDocumentos($row->id_exp);

    // DOCUMENTOS EN FORMATO TABLA
    $this->load->model('Documento_Model');

    $documentos = array();
    if(!empty($id_documentos_rel)){
    foreach ($id_documentos_rel as $key => $value) {
      $documentos[] = $this->Documento_Model->selectDocumento($value);
      }
    }

    // Recuperamos los tipos de documentos que hay
    $this->load->model('Doc_Aux_Model');
    $tipo_documentos = $this->Doc_Aux_Model->getTipoDocumentos();

    $data['documentos'] = $documentos;
    $data['table'] = $this->format_table_doc($documentos,"Documentos",$expediente['id_exp']);
    $data['tipo_documentos'] = $tipo_documentos;
    $data['permiso_role'] = $this->permiso_role();
    $data['content'] = 'expediente_data';
    $this->load->view('layout',$data);
    }
  }

  function insertar_expediente(){
    $this->load->model('Expediente_Aux_Model');
    $data['expedientes_datos'] = $this->Expediente_Aux_Model->getExpedientesDatos();
    $data['content'] = 'expediente_insert';
    $this->load->view('layout', $data, FALSE);
  }


  function nuevo_expediente(){
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('tipo_exp', 'Tipo', 'required|numeric');
    $this->form_validation->set_rules('asunto', 'Asunto', 'required');

    if($this->form_validation->run() === true){
        //Si la validación es correcta, cogemos los datos de la variable POST
        //y los enviamos al modelo
        $tipo_exp = $this->input->post('tipo_exp');
        $cif_ent = $this->input->post('cif_ent');
        $asunto = $this->input->post('asunto');

        $this->load->model('Expediente_Model');
        $this->Expediente_Model->insertar_expediente($tipo_exp, $cif_ent, $asunto);
    }

    //Se cargan los datos de los tipos de expedientes para la vista
    /*$this->load->model('Expediente_Aux_Model');
    $data['expedientes_datos'] = $this->Expediente_Aux_Model->getExpedientesDatos();

    $data['content'] = 'expediente_list';

    $this->load->view('layout',$data);*/

   $this->index();
  }

function busqueda_expediente(){

    $this->load->library('table');
    $this->load->helper('form');
    $param_busqueda = $this->input->post('param_busqueda');

    $data = array( );

    $query = $this->Expediente_Model->buscar_expediente($param_busqueda);
    if(!$query || $query->num_rows() < 1) {
      $data['expediente_list'] = null;
    }
    else {

        $table = $this->format_table_exp($query->result_array(),"Resultado/s búsqueda");
        $data['table'] = $table;
    }

    //Se carga la vista que corresponde en el contenido de la plantilla
    $data['content'] = 'expediente_list';
    $this->load->view('layout',$data);
  }

  function format_table_exp($datos, $leyenda){
    //Para mostrar los datos en TABLAS
    $data['datatable'] = $datos;
    $this->load->model('Entidad_Model');

    //-- Table Initiation
    //$this->table->set_caption($leyenda);
    $tmpl = array ( 'table_open'  => '<table border="0" cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
    $this->table->set_template($tmpl);
    //-- Header Row
    $this->table->set_heading('ID', 'Asunto','Entidad','Documentos');


    //-- Content Rows
    foreach($data['datatable'] as $index => $row)
    {
      $num_docs = $this->contar_docs($row['id_exp']);
      $this->table->add_row(
        $row['id_exp'],
        anchor("expedientes/prod/".$row['id_exp'], $row['asunto']),
        $this->Entidad_Model->getEntidad($row['cif_ent']),
        "<span class='badge'>$num_docs</span>"
        
      );
    }

    //-- Display Table
    $table = $this->table->generate();
    return $table;
    }
    
    // Permisos según el role
    public function permiso_role()
    {
        if ($this->session->userdata('perfil') == "administrador") {
            $permiso_role = "active";
        } else {
            $permiso_role = "disabled";
        }
        return $permiso_role;
    }

    function format_table_doc($datos, $leyenda, $id_exp){
    //Para mostrar los datos en TABLAS
    $data['datatable'] = $datos;

    //-- Table Initiation
    $tmpl = array ( 'table_open'  => '<table border="0" cellpadding="2" cellspacing="1" class="table table-striped table-hover">' );
    $this->table->set_template($tmpl);

    //-- Header Row
    $this->table->set_heading('ID', 'Documento', 'Acciones');

    //-- Content Rows
    foreach($data['datatable'] as $index => $row)
    {
      $href_documento = base_url().$row->ruta.$row->nombre;
      $href_eliminar = site_url().'documentos/eliminar_documento/'.$row->id_doc.'/'.$id_exp;
      $permiso_role = $this->permiso_role();

      $this->table->add_row(
        $row->id_doc,
        "<a href='$href_documento' target='_blank'>$row->nombre</a>",
        "<a href='$href_eliminar' class='btn btn-danger btn-sm $permiso_role' role='button'>Eliminar</a>"
      );
    }

    //-- Display Table
    $table = $this->table->generate();
    return $table;
    }




    function ci_pagination($url_sub, $modelo, $funcion){
    
    $result_per_page = 10;
    
    $config["base_url"] = base_url() . $url_sub;
    $config["total_rows"] = $this->$modelo->record_count();
    $config["per_page"] = $result_per_page;
    $this->pagination->initialize($config);
    
    $datatable = $this->$modelo->$funcion($result_per_page, $this->uri->segment(3));
    
    $data['content'] = 'expediente_data';
    $data['datatable'] = $datatable;
    $data['result_per_page'] = $result_per_page;
    return $data;
    }
    
    public function contar_docs($id_exp){
    $this->load->model('Exp_Doc_Model');
    $relacion_docs = $this->Exp_Doc_Model->getExpedienteDocumentos($id_exp);
    return count($relacion_docs);
    }
    
    public function autocomplete(){
    $this->load->model('Entidad_Model');
    $entidades = $this->Entidad_Model->getEntidades();
    $results = array();

    foreach ($entidades as $row) {
        $a = array(
            'id' => $row->id_ent,
            'label' => $row->nombre,
            'value' => $row->nombre
            );
        $results[] = $a;
    }
    var_dump($results);
    echo json_encode($results);
    }

function get_data(){ 
    $this->load->model('Entidad_Model');

    $match = $this->input->get('term', TRUE);  // TRUE para hacer un filtrado XSS  
    $item = $this->input->get('item', TRUE); 

    var_dump($match);
    var_dump($item);
    
    $data['item'] = $item;
    $data['results'] = $this->Entidad_Model->get_data($item,$match);
        
    $this->load->view('data',$data);    
}

}
?>