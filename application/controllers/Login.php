<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel');
		$this->load->model('EventsModel');
		$this->load->model('ProfesionalModel');
	}

	public function index(){
		$this->load->view('template/header');
		$this->load->view('login');
	}

	public function Login(){
		$email = $this->input->post('email');
		$pass = $this->input->post('pass');

		if ($this->LoginModel->login($email,$pass) == 'si') {
			//usuario existe
			echo "<script>alert('pasa')</script>";
			/*$data['profesionales'] = $this->ProfesionalModel->getAll();
			$this->load->view('template/header');
			$this->load->view('template/nav');
			$this->load->view('index2',$data);*/

		}else if ($this->LoginModel->login($email,$pass) == 'no'){
			//usuario no existe
			echo "<script>alert('Usuario o contraseña incorrectos')</script>";
			$this->load->view('template/header');
			$this->load->view('login');	
		}
	}
}