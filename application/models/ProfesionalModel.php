<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ProfesionalModel extends CI_Model{
	//get all
	public function getAll(){
		$query = $this->db->get('profesional');
		return $query->result_array();
	}

	//get by rut
	public function getByRut($rut){
		$sql = $this->db->query('select rut,nombre,a_pat from profesional where rut='.$rut.'');
		if($sql->num_rows() > 0) {
			return $sql->row();
		}else{
			return null;
		}
	}

	//insert nuevo
	public function nuevoPorfesional($nom,$ape,$espe){}

	//get especialidad
	public function getEspecialidades(){
		$query = $this->db->get('especialidad');
		return $query->result();
	}

	//nuevo profesional
	public function createProfesional($nom,$ape,$espe){
		$sql = $this->db->query("insert into profesional(nombre,a_pat,cod_esp) 
			values('$nom','$ape','$espe')");
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}