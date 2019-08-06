<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CentroModel extends CI_Model{
	
	//obtiene id del centro medico
	public function getIdCentro($idUsuario){
		$sql = $this->db->query("select * from usuario_centro where idUsuario = '$idUsuario'");

		if ($sql->num_rows() > 0) {
			return $res = $sql->row();
		}else{
			return null;
		}	
	}

	//obtiene nombre del centro medico
	public function getNomCentro($idCentro){
		$sql = $this->db->query("select * from centro where idCentro = '$idCentro'");

		if ($sql->num_rows() > 0) {
			return $res = $sql->row();
		}else{
			return null;
		}	
	}

	//nuevo centro
	public function addCentro($nombre,$direccion){
		$sql = $this->db->query("insert into centro (nombre,direccion) values ('$nombre','$direccion')");
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}