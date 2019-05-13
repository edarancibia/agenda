
		<table class="table">
			<tr>
				<td>
					<label for="txtAntePed">Antecedentes médicos</label>
					<textarea class="form-control" id="txtAntePed"></textarea>
				</td>

				<td>
					<label for="txtMotPed">Motivo consulta</label>
					<textarea class="form-control" id="txtMotPed"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label for="txtExaPed">Exámen físico</label>
					<textarea class="form-control" id="txtExaPed"></textarea>
				</td>
				<td>
					<label for="txtDiagPed">Diagnóstico principal</label>
					<textarea class="form-control" id="txtDiagPed"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label for="txtIndiPed">Indicaciones generales</label>
					<textarea class="form-control" id="txtIndiPed"></textarea>
				</td>
				<td>
					<label for="txtSolExPed">Solicitud de exámenes</label>
					<textarea class="form-control" id="txtSolExPed"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<button type="button" class="btn btn-info" id="btnGuardaFicha">Guardar Atención</button>
				</td>
			</tr>
		</table>
	</div>

</div>
<!-- REGISTRA DATOS DEL PACIENTE-->
    <div class="modal fade" id="modalInfoPaciente">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Datos del Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              	<input type="hidden" name="txtRutPac3" id="txtRutPac3">
                <label>Fecha nacimiento</label>
                <input type="date" id="txtFechaNac2" name="txtRutPac" class="form-control">
                <label>Sexo</label>
                <select class="form-control" id="cboSexo">
                	<option selected>Seleccione</option>
                	<option value="1">Hombre</option>
                	<option value="0">Mujer</option>
                </select>
                <label>Dirección</label>
                <input type="text" name="txtDir" id="txtDir" class="form-control">
                <label>Teléfono</label>
                <input type="text" name="txtTel" id="txtTel" class="form-control">
                <label>Email</label>
                <input type="text" name="txtMail" id="txtMail" class="form-control">
              </div>
              <div class="modal-footer">
                <button type="button" id="btnGuardaInfoPac" class="btn btn-primary">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
    </div>

    <!-- set up the modal to start hidden and fade in and out -->
    <div id="modalConfirm" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- dialog body -->
          <div class="modal-body">
            <input type="hidden" id="txtIdEvento" name="txtIdEvento">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            ¿Seguro que desea guardar información terminar la atención?
          </div>
          <!-- dialog buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnConfirmFicha">Sí</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
          </div>
        </div>
      </div>
    </div>
</body>
</html>