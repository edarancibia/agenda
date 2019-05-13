<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FichaModel extends CI_Model{
	
	public function saveFicha($rut_pac,$rut_med,$fecha,$ante,$moti,$diag,$indi,$ex_fis,$sol_ex){
		$sql = $this->db->query("INSERT INTO ficha 
			(rut_pac,rut_med,fecha,antecedentes,motivo,diagnostico,indicaciones,examen_fis,sol_exam)
			values('$rut_pac','$rut_med','$fecha','$ante','$moti','$diag','$indi','$ex_fis','$sol_ex')");
	}
}