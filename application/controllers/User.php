<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('UserModel');
		$this->load->library('email');
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

	//envia correo luego de registrarse
	public function sendMail(){

		$from = 'Clinic Calendar';
		$to = $this->input->post('to');
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');

		//configuracion para gmail
		$configGmail = array(
			'protocol' => 'smtp',
			'smtp_host' => 'SMTP.Office365.com',
			'smtp_port' => '587',
			'smtp_user' => 'erwin2211@hotmail.com',
			'smtp_pass' => 'daniel1311',
			'mailtype' => 'html',
			'charset' => 'utf-8',
			'newline' => "\r\n",
			'mailtype' => 'html',
		); 

		//cargamos la configuración para enviar con gmail
		$this->email->initialize($configGmail);
 
		$this->email->from($from);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);
		$this->email->send();
		//con esto podemos ver el resultado
		var_dump($this->email->print_debugger());
	}

}