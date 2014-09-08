<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	public function index()
	{
		$this->load->view('inicio', FALSE);
	}

}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */