<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'date'));
	}


	function index()
	{
		$this->load->view('upload_form', array('error' => ''));
	}

/*
	function do_upload_old($cif, $id_exp)
	{
		$date = date('Ymd');

		if (!is_dir('./uploads/'.$id_exp.'-'.$cif.'/')){
			mkdir('./uploads/'.$id_exp.'-'.$cif.'/');
		}
		$upload_dir = './uploads/'.$id_exp.'-'.$cif.'/';

		$config['upload_path'] = $upload_dir;
		$config['allowed_types'] = 'doc|odt|gif|jpg|png|pdf|docx';
		$config['max_size']	= '300';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		//$config['userfile'] = $this->input->post('userfile');

		//Subo a la carpeta el documento
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$tipo_doc = $this->input->post('tipo_doc');
			$num_registro = $this->input->post('num_registro');
			$num_pag = $this->input->post('num_pag');

			//Guardamos los datos del documento en la BD
			$this->load->model('Documento_Model');
			$id_doc = $this->Documento_Model->insertarDocumento($tipo_doc, $data["upload_data"]["file_name"], $upload_dir, $num_registro, $num_pag);

			//Guardamos los datos de la tabla que relaciona los documentos y su expediente
			$this->load->model('Expediente_Documento_Model');
			$this->Expediente_Documento_Model->insertarExpedienteDocumento($id_exp, $id_doc);

			//Redirigimos al expediente en el que estábamos
			redirect("expedientes/prod/$id_exp");
		}
	}
*/
	
	function do_upload($cif, $id_exp)
	{
		$date = date('Ymd');
		$files = $_FILES;
		
		// Creamos la carpeta de almacén de documentos del expediente, si no existe
		if (!is_dir('./uploads/'.$id_exp.'-'.$cif.'/')){
			mkdir('./uploads/'.$id_exp.'-'.$cif.'/');
		}
		$upload_dir = './uploads/'.$id_exp.'-'.$cif.'/';
		
			$config['upload_path'] = $upload_dir;
			$config['allowed_types'] = 'doc|odt|gif|jpg|png|pdf|docx';
			$config['max_size']	= '2048';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';
			$config['userfile'] = $_FILES['userfile']['name'];

			//Subo a la carpeta el documento
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());

				$this->load->view('upload_form', $error);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				var_dump($data);
				$tipo_doc = $this->input->post('tipo_doc');
				$num_registro = $this->input->post('num_registro');
				$num_pag = $this->input->post('num_pag');
				//Guardamos los datos del documento en la BD
				$this->load->model('Documento_Model');
				$id_doc = $this->Documento_Model->insertarDocumento($tipo_doc, $data["upload_data"]["file_name"], $upload_dir, $num_registro, $num_pag);

				//Guardamos los datos de la tabla que relaciona los documentos y su expediente
				$this->load->model('Expediente_Documento_Model');
				$this->Expediente_Documento_Model->insertarExpedienteDocumento($id_exp, $id_doc);
			}
			//Redirigimos al expediente en el que estábamos
			redirect("expedientes/prod/$id_exp");			
		}
}
?>