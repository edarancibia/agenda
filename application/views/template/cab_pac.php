<div class="container">
	<div class="col-md-12">
	<div class="panel panel-info margen">
	  <div class="panel-heading fuente"><?echo $datosPac->a_pat. ' '. $datosPac->a_mat .' '.$datosPac->nombre ;?></div>
	  <div class="panel-body" style="padding-top: 0px;">
	    <div class="row">
	    	<table class="table">
	    		<tr>
	    			<td><strong>Rut:</strong> <? echo $pac->rut_num;?></td>

	    			<td><strong>Fecha Nac: </strong>
	    				<? echo $datosPac->fecha_nac ?></td>

	    			<td><strong>Edad:</strong>
	    				<? $fechaActual = date("Y-m-d H:i:s");
	    				   $edad = $fechaActual - $datosPac->fecha_nac;
	    				   echo $edad .' '. 'años'; ?>
	    			</td>

	    			<td><strong>Sexo:</strong>
	    				<? if($datosPac->sexo == 0){
	    					echo "Mujer";
	    				} else{ echo  "Hombre";
	    			}
	    				?> </td>

	    			<td></td>
	    		</tr>
	    	</table>
	    </div>
	    <div class="row">
	    			    
	    	</div>
	     
	  </div>
	</div>