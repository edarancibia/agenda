

		<input type="hidden" id="idEvento3" value="<?php echo $idEvento; ?>">
		
	
		<div class="row">
		<table style="margin-bottom: 0px;">
			<tr>
				<td>
					<div class="col-sm-4">
					<h5>Motivo consulta:</h5>
					<textarea class="form-control" id="txtMotivo" style="height: 100px; width: 600px;"></textarea>
					<h5>Indicaciones generales:</h5>
					<textarea class="form-control" id="txtObsFicha" style="height: 100px; width: 600px;"></textarea>
					</div>
				</td>
				<td>
					<h5>Atenciones anteriores</h5>

					<div class="col-3">
						<div class="list-group fuente" id="list-historial" role="tablist">
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
		<br>
		<table border="0">
			<tr>
				<td class="borde_right"><button type="button" class="btn btn-primary" id="btnGuardaFsimple">Guardar</button></td>
				<td><button class="btn btn-warning" id="btnLimpiar">Limpiar</button></td>
			</tr>
		</table>		
	</div>
	
</div>
</body>
</html>