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

	//get by apellido
	public function getByBuscador($idProfesional,$a_pat){
		$sql = $this->db->query('SELECT distinct concat(p.a_pat," ",p.a_mat," ",p.nombre)as paciente
									FROM paciente p, ficha f
									WHERE p.rut_num = f.rut_pac
									and f.idProfesional='.$idProfesional.' and upper(p.a_pat) like '%'$a_pat'%'');
		if($sql->num_rows() > 0) {
			return $sql->row();
		}else{
			return null;
		}
	}
	//new
	public function savePaciente($rut,$nombre,$apat,$amat,$dir,$tel,$mail,$sexo,$fnac){
		$sql = $this->db->query("insert into paciente(rut_num,nombre,a_pat,a_mat,direccion,telefono,email,sexo,fecha_nac)values('$rut',UPPER('$nombre'),UPPER('$apat'),UPPER('$amat'),'$dir','$tel','$mail','$sexo','$fnac')");
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	//update
	public function updatePaciente($rut_num,$fnac,$dir,$tel,$sexo,$mail){
		$sql = $this->db->query("update paciente set fecha_nac='$fnac', direccion='$dir',telefono='$tel',sexo='$sexo',telefono='$tel',email='$mail' WHERE rut_num='$rut_num'");
		return ($this->db->affected_rows() != 1) ? false : true;
	}

	function get_pacBusca($q){
	    $this->db->select('*');
	    //$this->db->where('idProfesional', $apat);
	    $this->db->like('a_pat', $q);
	    $query = $this->db->get('paciente');
	    if($query->num_rows() > 0){
	      foreach ($query->result_array() as $row){
	        $new_row['label']=htmlentities(stripslashes($row['a_pat'].' '.$row['a_mat'].' '.$row['nombre']));
	        $new_row['value']=htmlentities(stripslashes($row['rut_num']));

	        //$new_row['label']=$row['a_pat'];
	        //$new_row['value']=$row['rut_num'];
	        $row_set[] = $new_row; //build an array
	      }
	      echo json_encode($row_set); //format the array into json data
	    }
	 }
}