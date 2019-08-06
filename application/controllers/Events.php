<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Events extends CI_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->model('EventsModel');
		$this->load->model('ProfesionalModel');
	}

	public function Index(){
		
		$data['profesionales'] = $this->ProfesionalModel->getProfByCentro($this->session->userdata('idCentro'));
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('index2', $data);
		//echo json_encode($data);
	}

	public function Index2(){
		$rut_med = $this->input->post('cboProfesional',TRUE);
		$data['events'] = $this->EventsModel->getAll($rut_med);

		if($rut_med > 0){
			$data['medico'] = $this->ProfesionalModel->getByRut($rut_med);	
		}else{
			$data['medico'] = 'Nadie';
		}
		
		$data['profesionales'] = $this->ProfesionalModel->getProfByCentro($this->session->userdata('idCentro'));
		$this->load->view('template/header');
		$this->load->view('template/nav');
		$this->load->view('index3', $data);
		//echo json_encode($data);
	}

	public function NewEvent(){
		$rut_pac = $this->input->post('rut_num');
		$rut_med = $this->input->post('rut_med');
		$fini = $this->input->post('fini');
		$ffin = $this->input->post('ffin');
		$obs = $this->input->post('obs');
		$fecha = date('d/m/Y H:i:s');
		$this->EventsModel->saveEvent($rut_pac,$fini,$ffin,$rut_med,$obs,$fecha);
	}

	//get by id
	public function GetEvent(){
		$id = $this->input->post('id');
		$data['event'] = $this->EventsModel->getEventById($id);
		//echo json_encode($data);
	}

	//cancelar o confirmar evento
	public function UpdateEvent(){
		$id = $this->input->post('id');
		$estado = $this->input->post('request');
		$this->EventsModel->update($id,$estado);
	}
}