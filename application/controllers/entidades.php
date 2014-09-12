<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Entidades extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->model('Entidad_Model');

    $this->output->enable_profiler(TRUE);
  }

	public function index()
	{
		$data['entidades'] = $this->getEntidades();
		$data['content'] = 'lista_entidades';
		$this->load->view('layout',$data);
	}

	public function getEntidad()
	{
		
		$cif = $this->input->post('cif');
		
		$result = $this->Entidad_Model->getEntidad($cif);
		echo json_encode($result);
	}

	public function getEntidades()
	{
		$result = $this->Entidad_Model->getEntidades();
		echo json_encode($result);
		//echo $result;
	}

	public function nueva_entidad(){
		$data['content'] = 'entidad_nueva';
		$this->load->view('layout',$data);
	}

	public function insertar(){
	//Reglas de validación
	$this->form_validation->set_rules('cif','CIF','required|is_unique[entidades.cif]|xss_clean');
	$this->form_validation->set_rules('nombre','nombre de la entidad','required|xss_clean');
	$this->form_validation->set_rules('direccion','dirección','required|xss_clean');
	$this->form_validation->set_rules('cp','código postal','required|numeric|xss_clean');
	$this->form_validation->set_rules('localidad','localidad','required|xss_clean');
	$this->form_validation->set_rules('provincia','provincia','required|xss_clean');
	$this->form_validation->set_rules('telefono','teléfono','required|numeric|xss_clean');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean');

	//Mensajes para las reglas de validación
    $this->form_validation->set_message('required', 'El %s es requerido');
    $this->form_validation->set_message('numeric', 'El %s sólo puede llevar números');
    $this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');
	$this->form_validation->set_message('is_unique[entidades.cif]', 'Ya existe un tercero registrado con ese %s');
	
	//Adaptamos los div del mensaje de error
	$this->form_validation->set_error_delimiters('<p class="bg-danger">', '</p>');

    
    if($this->form_validation->run() === TRUE){
        //Si la validación es correcta, cogemos los datos de la variable POST
        //y los enviamos al modelo
     	$cif = $this->input->post('cif');
     	$nombre = $this->input->post('nombre');
     	$direccion = $this->input->post('direccion');
     	$cp = $this->input->post('cp');
     	$localidad = $this->input->post('localidad');
     	$provincia = $this->input->post('provincia');
     	$telefono = $this->input->post('telefono');
     	$email = $this->input->post('email');

        $this->load->model('Entidad_Model');
        $this->Entidad_Model->insertar($cif, $nombre, $direccion, $cp, $localidad, $provincia, $telefono, $email);

        $this->load->model('Expediente_Aux_Model');
        $data['cif'] = $cif;
    	$data['expedientes_datos'] = $this->Expediente_Aux_Model->getExpedientesDatos();
    	$data['content'] = 'expediente_insert';
    	$this->load->view('layout', $data, FALSE);
    	
	}else{
		$data['errores'] = validation_errors();
		$data['content'] = 'entidad_nueva';
		$this->load->view('layout', $data, FALSE);
	}
}
}

/* End of file entidades.php */
/* Location: ./application/controllers/entidades.php */