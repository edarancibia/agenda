<div class="container">
	<div class="col-md-12">
	<div class="panel panel-info">
	  <div class="panel-heading"><?echo $datosPac->a_pat. ' '. $datosPac->a_mat .' '.$datosPac->nombre ;?></div>
	  <div class="panel-body">
	    <div class="row">
	    	<table class="table">
	    		<tr>
	    			<td>Rut:<input type="text" name="txtRutPac4" id="txtRutPac4" class="form-control" value="<? echo $pac->rut_num;?>" disabled></td>

	    			<td>Fecha Nac:
	    				<input type="text" name="txtFecNac" class="form-control" value="<? echo $datosPac->fecha_nac?>" disabled></td>

	    			<td>Sexo:
	    				<input value="<? if($datosPac->sexo == 0){
	    					echo "Mujer";
	    				} else{ echo  "Hombre";
	    			}
	    				?> " type="text" name="txtSexo" id="txtSexo" class="form-control" disabled></td>

	    			<td><button type="button" class="btn  btn-info" id="btnInfoPac">Completar info</button></td>
	    		</tr>
	    	</table>
	    </div>
	    <div class="row">
	    			    
	    	</div>
	     
	  </div>
	</div>
