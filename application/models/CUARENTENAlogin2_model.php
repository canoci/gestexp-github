<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login2_model extends CI_Model {

     
	public function __construct()
	{
	$this->load->library('session');
	$this->load->database();
	}


	public function getLogin($username,$password)
	{
	//comprobamos que el nombre de usuario y contraseña coinciden
	$data = array(
	'username' => $username,
	'password' => $password
	);

	$query = $this->db->get_where('usuarios',$data);
	return $query->result_array();
	}


	public function isLogged()
	{
	//Comprobamos si existe la variable de sesión username. En caso de no existir, le impediremos el paso a la página para usuarios registrados

	    if(isset($this->session->userdata['username']))
	    {
	    return TRUE;
	    }
	    else
	    {
	    return FALSE;
	    }
	   
	}


	public function close()
	{
	//cerrar sesión
	return $this->session->sess_destroy();
	}
}



/* End of file login2_model.php */
/* Location: ./application/models/login2_model.php */