<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
	}

	//new user
	public function index(){
		$this->load->view('template/header');
		$this->load->view('user/register');
	}

	public function Register(){
		$a_pat = $this->input->post('a_pat');
		$a_mat = $this->input->post('a_mat');
		$nombre = $this->input->post('nombre');
		$email = $this->input->post('email');
		$pass = $this->input->post('pass');
		$this->UserModel->createUser($a_pat,$a_mat,$nombre,$email,$pass); 
	}

	

}