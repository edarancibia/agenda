<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LoginModel extends CI_Model{

	public function login($email,$pass){
		$sql = $this->db->query("select * from usuario where email = '$email' and pass = '$pass'");
		$row = $sql->num_rows();
			if($row > 0)
			{
				return 'si';
			}
			else
			{
				return 'no';
			}
				
	}
}