<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Paciente extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('PacienteModel');
	}

	//get by rut
	public function GetPaciente(){
		$rut = $this->input->post('rut_num');
		$data['paciente'] = $this->PacienteModel->getByRut($rut);
		echo json_encode($data);
	}

	//INSERT PACIENTE
	public function NewPaciente(){
		$rut = $this->input->post('rut');
		$nombre = $this->input->post('nombre');
		$apat = $this->input->post('apat');
		$amat = $this->input->post('amat');
		$dir = $this->input->post('dir');
		$fono = $this->input->post('fono');
		$mail = $this->input->post('mail');
		$sexo = $this->input->post('sexo');
		$fnac = $this->input->post('fnac');
		$this->PacienteModel->savePaciente($rut,$nombre,$apat,$amat,$dir,$fono,$mail,$sexo,$fnac);
	}

	//UPDATE
	public function UpdatePaciente(){
		$rut = $this->input->post('rut');
		$dir = $this->input->post('dir');
		$fono = $this->input->post('fono');
		$mail = $this->input->post('mail');
		$sexo = $this->input->post('sexo');
		$fnac = $this->input->post('fnac');
		$this->PacienteModel->updatePaciente($rut,$fnac,$dir,$fono,$sexo,$mail);	
	}
}