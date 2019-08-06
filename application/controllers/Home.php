<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('LoginModel');
		$this->load->model('EventsModel');
		$this->load->model('ProfesionalModel');
		$this->load->model('UserModel');
		$this->load->model('CentroModel');
	}

	public function index(){
		$this->load->view('template/header');
		$this->load->view('login');
	}

	public function Main(){
		$email = $this->input->post('email');
		$pass = $this->input->post('pass');

		$result = $this->LoginModel->login($email,$pass);

		if ($result === 'si') {
			//usuario existe
			$this->session->set_userdata('usermail',$email);

			$data = $this->UserModel->getUserData($email);
			$userName = $data->nombre.' '.$data->a_pat.' '.$data->a_mat;
			$this->session->set_userdata('user',$userName);

			$email = $this->session->userdata('usermail');

			//obtiene nombre del centro medico
			$resulUser = $this->UserModel->getUserData($email);
			$idUser = $resulUser->idusuario;
			$resultCentro = $this->CentroModel->getIdCentro($idUser);

			if (empty($resultCentro)) {
				echo 'No tiene centro';
			}
			$resultIdCentro = $resultCentro->idCentro;
			$this->session->set_userdata('idCentro',$resultIdCentro);
			$resultNomCentro = $this->CentroModel->GetNomCentro($resultIdCentro);
			$this->session->set_userdata('centro',$resultNomCentro->nombre);

			//obtiene especialiades
			$data->especialiades = $this->ProfesionalModel->getEspecialidades();
			$this->load->view('template/header');
			$this->load->view('template/nav');
			$this->load->view('main',$data);

		}else if ($result === 'no') {
			//usuario no existe
			echo "<script>alert('Usuario o contraseña incorrectos')</script>";
			$this->load->view('template/header');
			$this->load->view('login');	
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		$this->load->view('template/header');
		$this->load->view('login');
	}

	public function newCentro(){
		
	}
}