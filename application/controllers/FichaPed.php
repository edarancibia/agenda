<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FichaPed extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('FichaModel');
		$this->load->model('EventsModel');
		$this->load->model('PacienteModel');
	}

	public function index(){
		$data['idEvento'] = $_REQUEST['idEvento'];

		//consulta si tiene atenciones anteriores para rescatar datos del paciente
		$rut_pac = $this->EventsModel->getPaciente($_REQUEST['idEvento']);
		$data['pac'] = $rut_pac;

		if($rut_pac != null){
			$data['datosPac'] = $this->PacienteModel->getByRut($rut_pac->rut_num);
			$this->load->view('template/header');
			$this->load->view('template/nav');
			$this->load->view('template/cab_pac',$data);
			$this->load->view('ficha/ficha');
		}else{
			$this->load->view('template/header');
			$this->load->view('template/nav');
			$this->load->view('template/cab_pac',$data);
			$this->load->view('ficha/ficha');
		}
	}

	//save ficha atencion
	public function SaveFicha(){
		$rut_pac = $this->input->post('rut_pac');
		$rut_med = 123456;
		$fecha = date('d/m/Y H:i:s');
		$ante = $this->input->post('ante');
		$moti = $this->input->post('moti');
		$diag = $this->input->post('diag');
		$indi = $this->input->post('indi');
		$ex_fis = $this->input->post('ex_fis');
		$sol_ex = $this->input->post('sol_ex');
		$this->FichaModel->saveFicha($rut_pac,$rut_med,$fecha,$ante,$moti,$diag,$indi,$ex_fis,$sol_ex);
	}
}