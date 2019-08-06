

		<input type="hidden" id="idEvento3" value="<?php echo $idEvento; ?>">
		

		<div class="row">
		<table class="table">
			<tr>
				<td>
					<h4>Motivo consulta:</h4>
					<textarea class="form-control" id="txtMotivo" style="height: 100px; width: 600px;"></textarea>
					<h4>Indicaciones generales:</h4>
					<textarea class="form-control" id="txtObsFicha" style="height: 100px; width: 600px;"></textarea></td>

				<td>
					<h4>Atenciones anteriores</h4>

					<div class="col-4">
						<div class="list-group" id="list-historial" role="tablist">
							<?php 
							foreach ($historial as $item) { ?>
								<a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#" role="tab" aria-controls="profile" value=<? echo $item['idficha']?>><? echo $item['fecha']?></a>
							<? } ?>
						</div>
					</div>

					</td>
			</tr>
		</table>
		</div>
		<table border="0">
			<tr>
				<td><button type="button" class="btn btn-primary" id="btnGuardaFsimple">Guardar</button></td>
			</tr>
		</table>		
	</div>
	
</div>
</body>
</html>