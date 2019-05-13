<!DOCTYPE html>
<html>
<head>
	<title>Agenda Electronica</title>
</head>
<script type="text/javascript">
$(document).ready(function(){
  var baseUrl = 'http://localhost/clinic_calendar/index.php/';
    //INDEX - - - GET EVENTOS BY PROFESIONAL

  });
</script>
<body>
	<div class="container">
      <div class="row">
        <form action="<?php echo base_url('index.php/Events/Index2'); ?>" method="post">
          <label>Profesional:</label>
        <select id="cboProfesional" name="cboProfesional">
          <option value="0" selected>Seleccione</option>
          <?php
          foreach($profesionales as $each)
          {
              ?>
              <option value="<?=$each['rut']?>"><?=$each['a_pat'].' '.$each['a_mat'].' '.$each['nombre']?></option>
              <?php
          }

          ?>
        </select>

        <button type="submit" name="btnFiltrar" id="btnFiltrar" class="btn btn-primary">Ver Agenda</button>

      </div>
        
        
		<div class="jumbotron">
			<p>Seleccione un profesional de la lista </p>
		</div>
</form>
  
</body>
</html>