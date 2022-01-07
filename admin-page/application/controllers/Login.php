<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		//$this->load->model('Auth_model');
	}
		
	public function index() {
		$this->load->view('login');
	}

	function getlogin() {
		$user = $this->input->post('username');
		$pass = $this->input->post('password');
		$user = $this->auth->log_admin($user,$pass);
			if($user==true){
				$this->session->set_userdata($user);
				$data['hasil']=1;
				echo json_encode($data);
			}else{
				$data['hasil'] = 0;
				echo json_encode($data);
			}
	}

	function logout(){
		//helper_log("logout", "Logout");
		$this->session->sess_destroy();
		redirect('Login','refresh');
    }
}
