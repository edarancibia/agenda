<div class="container">
	<div class="row">
		<h4>Bienvenido a E-Doctor</h4>
		<h5><?= $this->session->userdata('centro') ?></h5>
	</div>


	<br>
	<div class="row">
		<div class="col-md-5" align="center">

			<table class="table" style="width: 600px; margin-left: 200px;">
				<tr>
					<td>Aún no se ha agregado un centro médico, hazlo aquí:</td>
					<td><input type="text" class="form-control" id="txtNomCentro"></td>
				</tr>
				<tr>
					<td><button type="button" class="btn btn-info" id="btnAddCentro">Agregar</button></td>
				</tr>
			</table>
			
			<table border="0" class="table" style="width: 450px; margin-left: 200px;">
				<tbody>
					<th></th>
					<th><h3>Agregar profesionales</h3></th>
					<tr>
						<td>Nombre</td>
						<td><input type="text" id="txtNomProf" class="form-control"></td>
					</tr>
					<tr>
						<td>Apellidos</td>
						<td><input type="text" id="txtApeProf" class="form-control"></td>
					</tr>
					<tr>
						<td>Especialidad</td>
						<td><select id="cboEspe" class="form-control">
							<?php
								foreach ($especialiades as $item) {
									echo '<option value="'.$item->idespecialidad.'">'.$item->nombre.'</option>';
								}
							?>	
						</select></td>
					</tr>
					<tr>
						<td></td>
						<td >
							<button id="btnNuevoProf" type="button" class="btn btn-info">Registrar profesional</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>