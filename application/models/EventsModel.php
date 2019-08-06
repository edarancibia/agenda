<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EventsModel extends CI_Model{
	public function getAll($rut_med){
		$query = $this->db->query("select a.*, CONCAT(b.a_pat ,' ', b.a_mat ,' ',b.nombre) as title from events a, paciente b where a.estado not in (0,2) and a.rut_num = b.rut_num and a.rut_med = '$rut_med'");
		return $query->result_array();
	}

	public function saveEvent($rut_pac,$fini,$ffin,$rut_med,$obs,$fecha){
		$sql = $this->db->query("INSERT INTO events(rut_num,fini,ffin,rut_med,obs,estado,fecha) 
			VALUES ('$rut_pac','$fini','$ffin','$rut_med','$obs',1,'$fecha')");
	}

	//get by ID
	public function getEventById($id){
		$sql = $this->db->query('SELECT * FROM events WHERE id='.$id.'');
		if($sql->num_rows() > 0) {
			return $sql->row();
		}else{
			return null;
		}
	}

	//update estado event
	public function update($id,$estado){
		$sql = $this->db->query('update events set estado='.$estado.' where id='.$id.'');
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	//get paciente by idEvento
	public function getPaciente($idEvento){
		$sql = $this->db->query('select rut_num from events where id='.$idEvento);
		if($sql->num_rows() > 0) {
			return $sql->row();
		}else{
			return null;
		}
	}
}