
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