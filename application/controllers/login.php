<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('login_model');
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
		$this->load->database('default');

		//$this->output->enable_profiler(TRUE);
    }
	
	public function index($error=NULL)
	{	
		switch ($this->session->userdata('perfil')) {
			case '':
				$data['token'] = $this->token();
				if ($error == "ERROR") {
					$data['estilo'] = "has-error";
				}
				$data['titulo'] = 'Login con roles de usuario en codeigniter desde vacio';
				$this->load->view('login_view',$data);
				break;
			case 'administrador':
				echo "entro en administrador";
				redirect(base_url().'administrador');
				break;	
			case 'usuario':
				echo "entro en usuario";
				redirect(base_url().'usuario');
				break; 
			default:		
				echo "entro en default";
				$data['titulo'] = 'Login con roles de usuario en codeigniter desde default';
				$this->load->view('login_view',$data);
				break;		
		}
	}
	
	public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	
	public function new_user()
	{
		if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
		{
            $this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
            $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[6]|max_length[150]|xss_clean');
 

 			//variamos los div si hay error
 			$this->form_validation->set_error_delimiters('<p class="bg-danger">', '</p>');

            //lanzamos mensajes de error si es que los hay
            $this->form_validation->set_message('required', 'El %s es requerido');
            $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
            $this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');
			if($this->form_validation->run() == FALSE)
			{
				$this->index("ERROR");
			} else {
				$username = $this->input->post('username');
				$password = sha1($this->input->post('password'));
				$check_user = $this->login_model->login_user($username,$password);
				if($check_user == TRUE)
				{
					$data = array(
	                'is_logued_in' 	=> 		TRUE,
	                'id_usuario' 	=> 		$check_user->id,
	                'perfil'		=>		$check_user->perfil,
	                'username' 		=> 		$check_user->username,
	                'email' 		=> 		$check_user->email
            		);		
					$this->session->set_userdata($data);
					echo "punto 1";
					$this->index();
				}
			}
		} else {
			echo "punto 2";
			redirect(base_url().'login');
		}
	}	


	public function add_user()
	{

        $this->form_validation->set_rules('username', 'nombre de usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('password', 'password', 'required|trim|min_length[6]|max_length[150]|xss_clean');
        $this->form_validation->set_rules('passconf', 'confirmación del password', 'required|matches[password]|xss_clean');
		$this->form_validation->set_rules('email', 'email', 'required|is_unique[usuarios.email]|xss_clean');
		$this->form_validation->set_rules('perfil', 'perfil', 'required');

		//variamos los div si hay error
		$this->form_validation->set_error_delimiters('<p class="bg-danger">', '</p>');

        //lanzamos mensajes de error si es que los hay
        $this->form_validation->set_message('required', 'El %s es requerido');
        $this->form_validation->set_message('min_length', 'El %s debe tener al menos %s carácteres');
        $this->form_validation->set_message('max_length', 'El %s debe tener al menos %s carácteres');
		$this->form_validation->set_message('is_unique[usuarios.email]', 'Ya existe un usuario registrado con ese %s');
		$this->form_validation->set_message('matches[password]', 'Las contraseñas no coinciden');

		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('alta_usuario_view', FALSE);
		} else {

			// Rescatamos los datos del formulario y creamos el token
			
			$username = $this->input->post('username');
			$password = sha1($this->input->post('password'));
			$passconf = sha1($this->input->post('passconf'));
			$email = $this->input->post('email');
			$perfil = $this->input->post('perfil');
			$token = $this->token();
			
			
			// Inserto en la tabla de usuarios provisionales, a la espera de que confirmen mediante correo su cuenta
			$insert = $this->login_model->add_user_prov($username, $password, $perfil, $email, $token);
			// Envío un correo indicando el enlace para confirmar
			$this->load->library('email');


	       //configuracion para gmail
	        $configGmail = array(
	            'protocol' => 'smtp',
	            'smtp_host' => 'ssl://smtp.gmail.com',
	            'smtp_port' => 465,
	            'smtp_user' => 'cmdourense',
	            'smtp_pass' => 'woudepor03',
	            'mailtype' => 'html',
	            'charset' => 'utf-8',
	            'newline' => "\r\n"
	        );    
	        //cargamos la configuración para enviar con gmail
	        $this->email->initialize($configGmail);
			$this->email->from('info@deportesourense.com', 'Expedientes');
			$this->email->to($email);
			$this->email->subject('Solicitud alta en gestión expedientes');
			$mensaje = "<h5>Por favor, <strong>pulse el siguiente enlace</strong> para completar el alta: <a href='http://localhost:8080/gestexp/login/confirm_user/$token'>http://localhost:8080/gestexp/login/confirm_user/$token</a></h5>";
			$this->email->message($mensaje);			
			$this->email->send();
			//Aquí puedo ver los datos
			$datos_envio = $this->email->print_debugger();
			$data['mensaje'] = "Ha completado el proceso de alta. Revise su email para su alta definitiva.";
			// Los reenviamos a una página de 
			$this->load->view('usuario_nuevo_success', $data, FALSE);
		}

	}
	public function goNewUser()
	{
		$this->load->view('alta_usuario_view', FALSE);
	}

	public function template()
	{	
		$this->load->view('template', FALSE);
	}

	public function confirm_user($token)
	{
		if ($this->login_model->add_user_def($token)) {
			$this->index();
		} else {
			$this->load->view('error_en_usuario_def');
		}
	}

	public function logout_ci()
	{
		$this->session->sess_destroy();
		$this->index();
	}
}
