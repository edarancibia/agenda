<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserModel extends CI_Model{

	public function createUser($a_pat,$a_mat,$nombre,$email,$pass){
		$sql = $this->db->query("insert into usuario(a_pat,a_mat,nombre,email,pass) 
			values('$a_pat','$a_mat','$nombre','$email','$pass')");
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	//obtiene info del usuario
	public function getUserData($email){
		$sql = $this->db->query("select * from usuario where email = '$email'");
		if ($sql->num_rows() > 0) {
			return $res = $sql->row();
		}else{
			return null;
		}
	}

	//guarda relacion usuario/centro
	public function relUsuarioCentro($idusuario,$idCentro){
		$sql = $this->db->query("insert into usuario_centro idUsuario,idCentro values('$idusuario','$idCentro')");
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}