<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ficha extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('FichaModel');
		$this->load->model('EventsModel');
		$this->load->model('PacienteModel');
		$this->load->model('UserModel');
	}

	public function index(){
		$data['idEvento'] = $_REQUEST['idEvento'];

		//consulta si tiene atenciones anteriores para rescatar datos del paciente
		$rut_pac = $this->EventsModel->getPaciente($_REQUEST['idEvento']);
		
		//obtiene idEvento para modidicar su estado despues de finalizar la atencion
		$data2['idEvento'] = $_REQUEST['idEvento'];
		$data['pac'] = $rut_pac;	

		//obtiene historial de atenciones
		$data2['historial'] = $this->FichaModel->getByPac($rut_pac->rut_num);
		

		if($rut_pac != null){
			$data['datosPac'] = $this->PacienteModel->getByRut($rut_pac->rut_num);
			$this->load->view('template/header');
			$this->load->view('template/nav');
			$this->load->view('template/cab_pac',$data);
			$this->load->view('ficha/fichaSimple',$data2);
		}else{
			$this->load->view('template/header');
			$this->load->view('template/nav');
			$this->load->view('template/cab_pac',$data);
			$this->load->view('ficha/fichaSimple',$data2);
		}
	}

	//guarda ficha atencion
	public function Save(){

		$email = $this->session->userdata('usermail');
		//obtiene nombre del centro medico
		$resulUser = $this->UserModel->getUserData($email);	
		$idUser = $resulUser->idusuario;
		//echo $idUser;
		
		$rut_med = $this->session->userdata('');
		$obs = $this->input->post('obs');
		$motivo = $this->input->post('motivo');
		$rut_pac = $this->input->post('rut_pac');
		$fecha = date('Y-m-d H:i:s');

		$this->FichaModel->saveFichaSimple($rut_pac,$idUser,$fecha,$obs,$motivo);
	}

	//get ficha byID
	public function getFichabyId(){
		$idficha = $this->input->post('idficha');
		$data['ficha'] = $this->FichaModel->getById($idficha);
		echo json_encode($data);
	}

}