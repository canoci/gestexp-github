<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function login_user($username,$password)
	{
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		$query = $this->db->get('usuarios');
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			redirect(base_url().'login','refresh');
		}
	}

	public function add_user_prov($username, $password, $perfil, $email, $token)
	{
		$usuario_provisional = array(
			'perfil' => $perfil,
			'username' => $username, 
			'password' => $password, 
			'email' => $email, 
			'token' => $token
			);
		$this->db->insert('usuarios_provisionales', $usuario_provisional);

	}

	public function add_user_def($token)
	{
		$this->db->where('token', $token);
		$query = $this->db->get('usuarios_provisionales');
		$usuario_provisional = $query->result();

		if ($query->num_rows() == 1) {
			$usuario = array(
			'perfil' => $usuario_provisional[0]->perfil,
			'username' => $usuario_provisional[0]->username, 
			'password' => $usuario_provisional[0]->password, 
			'email' => $usuario_provisional[0]->email, 
			);
			$this->db->insert('usuarios', $usuario);
			$this->db->where('token', $usuario_provisional[0]->token);
			$this->db->delete('usuarios_provisionales'); 
			return TRUE;
		} else {
			return FALSE;
		}
		
	}
}
