<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Documentos extends CI_Controller {
 
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('file');
    $this->load->model('Documento_Model');

    //$this->output->enable_profiler(TRUE);
  }
 
  public function index() {
 
  $data = array();
 
    $query = $this->Documento_Model->selectDocumentos();
    if(!$query || $query->num_rows() < 1) {
      $data['Documento_list'] = null;
    }
    else {
 
      $data['Documento_list'] = array( );
      foreach ($query->result() as $row) {
        $documento = array( );
        $documento['id_doc'] = $row->id_doc;
        $documento['tipo_doc'] = $row->tipo_doc;
        $documento['nombre'] = $row->nombre;
        $documento['ruta'] = $row->ruta;
        $documento['num_registro'] = $row->num_registro;
        $documento['num_pag'] = $row->num_pag;
        $data['documento_list'][] = $documento;
      }
    }

    $data['content'] = 'documento_list';
        
    $this->load->view('layout',$data);
  }

  function ci_pagination($id_exp){
      $this->load->library('pagination');
      $this->load->library('table');

      $result_per_page = 3;

      $config["base_url"] = base_url() . "index.php/expedientes/prod/$id_exp";
      $config["total_rows"] = $this->Documento_Model->record_count();
      $config["per_page"] = $result_per_page;
      $this->pagination->initialize($config);

      $datatable = $this->Documento_Model->getDocumentos_pagination($result_per_page, $this->uri->segment(3));

      $data['datatable'] = $datatable;
      $data['result_per_page'] = $result_per_page;
      return $data;
    }


  public function prod($prod_id) {
    
    if(!$prod_id) {
      show_404();
      return;   
    }
    $query = $this->Documento_Model->selectDocumento($prod_id);
    if(!$query || $query->num_rows() < 1) {
      //show_404();
      return;
    }
 
    $row = $query->row();
    if(!$row) {
      //show_404();
      return;
    }
        
        $documento = array( );
        $documento['id_doc'] = $row->id_doc;
        $documento['nombre_tipo_doc'] = $row->nombre_tipo_doc;
        $documento['tipo_doc'] = $row->tipo_doc;
        $documento['nombre'] = $row->nombre;
        $documento['ruta'] = $row->ruta;
        $documento['num_registro'] = $row->num_registro;
        $documento['num_pag'] = $row->num_pag;
        $data['documento'] = $documento;
 
  
    $data['content'] = 'documento_data'; 
    $this->load->view('layout',$data);

  }

  function nuevo_documento(){
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('tipo_doc', 'Tipo', 'required|numeric');
        
    if($this->form_validation->run() === true){
        //Si la validación es correcta, cogemos los datos de la variable POST
        //y los enviamos al modelo
        $tipo_doc = $this->input->post('tipo_doc');
        $nombre = $this->input->post('nombre');
        $ruta = $this->input->post('ruta');
        $num_registro = $this->input->post('num_registro');
        $num_pag = $this->input->post('num_pag');
                    
        $this->load->model('Documento_Model');
        $this->Documento_Model->insertar_documento($tipo_doc, $nombre, $ruta, $num_registro, $num_pag);
    }

    //Se cargan los datos de los tipos de documentos para la vista
    $this->load->model('Documento_Aux_Model');
    $data['documentos_datos'] = $this->Documento_Aux_Model->getdocumentosDatos();

    $data['content'] = 'Documento_insert';
        
    $this->load->view('layout',$data);
}

function busqueda_documento(){

    $this->load->helper('form');
    $param_busqueda = $this->input->post('param_busqueda');

    $data = array( );
 
    $query = $this->Documento_Model->buscar_documento($param_busqueda);
    if(!$query || $query->num_rows() < 1) {
      $data['Documento_list'] = null;
    }
    else {
 
      $data['Documento_list'] = array( );
      foreach ($query->result() as $row) {
        $documento = array( );
        $documento['id_doc'] = $row->id_doc;
        $documento['tipo_doc'] = $row->tipo_doc;
        $documento['nombre'] = $row->nombre;
        $documento['ruta'] = $row->ruta;
        $documento['num_registro'] = $row->num_registro;
        $documento['num_pag'] = $row->num_pag;
        $data['documento_list'][] = $documento;
      }
    }

    //Se cargan los datos de los tipos de documentos para la vista
    $this->load->model('Documento_Aux_Model');
    $data['documentos_datos'] = $this->Documento_Aux_Model->getdocumentosDatos();
    
    //Se carga la vista que corresponde en el contenido de la plantilla
    $data['content'] = 'Documento_resultado_busqueda';
        
    $this->load->view('layout',$data);
  }

  function eliminar_documento($id_doc, $id_exp){   

    if($query = $this->db->get_where('documentos', array('id_doc' => $id_doc))){
      foreach ($query->result() as $row) {
        $documento = array();
        $documento['ruta'] = $row->ruta;
        $documento['nombre'] = $row->nombre;
        }
      $basepath_mod = trim(BASEPATH,"system/");
      $ruta_dir_file = trim($documento["ruta"], ".");
      $ruta_borrado = $basepath_mod.$ruta_dir_file.$documento["nombre"];
      if($this->db->delete('documentos', array('id_doc' => $id_doc))){
        $query_2 = $this->db->delete('exp_doc', array('id_doc' => $id_doc));
        if(!unlink($ruta_borrado)){
          echo "No se ha podido borrar el archivo de la carpeta";
        }
      }

    //Se carga la vista que corresponde en el contenido de la plantilla
    redirect("expedientes/prod/$id_exp");
    }
  }
}