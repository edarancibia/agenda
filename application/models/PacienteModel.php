<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PacienteModel extends CI_Model{
	//get by rut
	public function getByRut($rut){
		$sql = $this->db->query('SELECT * FROM paciente WHERE rut_num='.$rut.'');
		if($sql->num_rows() > 0) {
			return $sql->row();
		}else{
			return null;
		}
	}

	//new
	public function savePaciente($rut,$nombre,$apat,$amat,$dir,$tel,$mail,$sexo,$fnac){
		$sql = $this->db->query("insert into paciente(rut_num,nombre,a_pat,a_mat,direccion,telefono,email,sexo,fecha_nac)values('$rut','$nombre','$apat','$amat','$dir','$tel','$mail','$sexo','$fnac')");
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	//update
	public function updatePaciente($rut_num,$fnac,$dir,$tel,$sexo,$mail){
		$sql = $this->db->query("update paciente set fecha_nac='$fnac', direccion='$dir',telefono='$tel',sexo='$sexo',telefono='$tel',email='$mail' WHERE rut_num='$rut_num'");
		return ($this->db->affected_rows() != 1) ? false : true;
	}
}