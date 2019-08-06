<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profesional extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('ProfesionalModel');
	}

	//get all
	public function GetAll(){
		$data['prof'] = $this->ProfesionalModel->getProfByCentro($this->session->userdata('idCentro'));
		echo json_encode($data);
	}

	//Guarda nuevo profesional
	public function newProfresional(){
		$nomProf = $this->input->post('nomProf');
		$apeProf = $this->input->post('apeProf');
		$espe = $this->input->post('espe');
		$tipo_ficha = 1;
		$cod_centro = $this->session->userdata('idCentro');
		$this->ProfesionalModel->createProfesional($nomProf,$apeProf,$espe,$tipo_ficha,$cod_centro);
	}

	//obtiene profesionales x centro medico

}