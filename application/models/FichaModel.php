<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FichaModel extends CI_Model{
	
	public function saveFicha($rut_pac,$rut_med,$fecha,$ante,$moti,$diag,$indi,$ex_fis,$sol_ex){
		$sql = $this->db->query("INSERT INTO ficha 
			(rut_pac,rut_med,fecha,antecedentes,motivo,diagnostico,indicaciones,examen_fis,sol_exam)
			values('$rut_pac','$rut_med','$fecha','$ante','$moti','$diag','$indi','$ex_fis','$sol_ex')");
	}

	public function saveFichaSimple($rut_pac,$idUser,$fecha,$obs,$motivo){
		$sql = $this->db->query("insert into ficha(rut_pac,idProfesional,fecha,obsGenerales,motivo) values('$rut_pac','$idUser','$fecha','$obs','$motivo')");
	}

	public function getByPac($rut_pac){
		$sql = $this->db->query("SELECT * FROM ficha WHERE rut_pac='$rut_pac'");
		return $sql->result_array();

	}

	public function getById($idficha){
		$sql = $this->db->query('SELECT * from ficha WHERE idficha='.$idficha.'');

		if ($sql->num_rows() >0) {
			return $sql->row();
		}else{
			return null;
		}
	}
}