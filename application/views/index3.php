<!DOCTYPE html>
<html>
<head>
  <title>Agenda Electronica</title>
</head>
<script type="text/javascript">
$(document).ready(function(){
  $('#btnOK').attr("disabled", true);
  var baseUrl = 'http://localhost/clinic_calendar/index.php/';

  if (<?= $this->session->userdata('perfil');  ?> == 0) {
    $('#btnComenzar').attr("disabled", true);
  }

    //INDEX - - - GET EVENTOS BY PROFESIONAL

      $('#calendar').fullCalendar({

        lang: 'es',

        monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
        dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],

        businessHours: {
          // days of week. an array of zero-based day of week integers (0=Sunday)
          dow: [ 1, 2, 3, 4,5], // Monday - Thursday

          start: '09:00', // a start time (10am in this example)
          end: '19:00', // an end time (6pm in this example)
        },

          editable: true,
          header: {
              left: 'prev,next today',
              center: 'title',
              right: 'month,agendaWeek,agendaDay'
          },
          defaultView: 'agendaWeek',
          height: 500,
          slotMinutes: 15,

          minTime: '09:00',
          maxTime: '19:00',
          selectable: true,
          allDaySlot: false,
          timeFormat: 'h:mm t{ - h:mm t} ',
          dragOpacity: "0.5",
          eventColor: '#378006',
          eventBorderColor: 'blue',
          displayEventTime: false,
          hiddenDays: [0],

          events: [ 
            <?php 

            foreach($events as $event): 
              $start = explode(" ", $event['fini']);
              $end = explode(" ", $event['ffin']);
              if($start[1] == '00:00:00'){
                $start = $start[0];
              }else{
                $start = $event['fini'];
              }
              if($end[1] == '00:00:00'){
                $end = $end[0];
              }else{
                $end = $event['ffin'];
              }
            ?>
              {
                id: '<?php echo $event['id']; ?>',
                title: '<?php echo $event['title']; ?>',
                start: '<?php echo $start; ?>',
                end: '<?php echo $end; ?>',
              },
            <?php endforeach; ?>
            ],

          select: function(start, end) {
            $('#modalNew').modal('show');
            $('#txtIni').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
            $('#txtFin').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
            //$.getScript('/events/new', function() {});
          },

          eventDrop: function(event, dayDelta, minuteDelta, allDay, revertFunc){
//              if (confirm("Are you sure about this change?")) {
                  moveEvent(event, dayDelta, minuteDelta, allDay);
//              }
//              else {
//                  revertFunc();
//              }
          },
          
          eventResize: function(event, dayDelta, minuteDelta, revertFunc){
//              if (confirm("Are you sure about this change?")) {
                  resizeEvent(event, dayDelta, minuteDelta);
//              }
//              else {
//                  revertFunc();
//              }
          },
          
          eventClick: function(event, jsEvent, view){
              //showEventDetails(event);
              //alert(event.title);
              $("#idEvento").val(event.id);
              $("#txtIdEvento").val(event.id);
              $("#myModal").on("show", function() {    // wire up the OK button to dismiss the modal when shown
                  $("#myModal a.btn").on("click", function(e) {
                      $("#myModal").modal('hide');     // dismiss the dialog
                  });
              });

              $("#myModal").on("hide", function() {    // remove the event listeners when the dialog is dismissed
                  $("#myModal a.btn").off("click");
              });
              
              $("#myModal").on("hidden", function() {  // remove the actual elements from the DOM when fully hidden
                  $("#myModal").remove();
              });
              
              $("#myModal").modal({                    // wire up the actual modal functionality and show the dialog
                "backdrop"  : "static",
                "keyboard"  : true,
                "show"      : true                     // ensure the modal is shown immediately
              });
          },
      
      });

  

    $.datepicker.regional['es'] = {
         closeText: 'Cerrar',
         prevText: '< Ant',
         nextText: 'Sig >',
         currentText: 'Hoy',
         monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
         monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
         dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
         dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
         dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
         weekHeader: 'Sm',
         dateFormat: 'yy-mm-dd',
         firstDay: 1,
         isRTL: false,
         showMonthAfterYear: false,
         yearSuffix: ''
    };

     $.datepicker.setDefaults($.datepicker.regional['es']);

    $('#datepicker').datepicker({
        inline: true,
        onSelect: function(dateText, inst) {
            var d = new Date(dateText);
            $('#calendar').fullCalendar('gotoDate', d);
        }
    }); 

  });
</script>
<body>
  <div class="container-fluid">
 
      <div class="row col-xs-12">
          <div class="col-xs-3" id="datepicker">

            <form action="<?php echo base_url('index.php/Events/Index2'); ?>" method="post">
            
            <label>Profesional:</label>
            <select id="cboProfesional" class="form-control" name="cboProfesional">
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
            <br>

            <button type="submit" name="btnFiltrar" id="btnFiltrar" class="btn btn-primary">Ver Agenda</button>
          <br><br>
          
            <label><?php 
            if ((!is_null($medico->nombre)) && (!is_null($medico->rut))&& (!is_null($medico->a_pat))) {     
                echo $medico->nombre.' '.$medico->a_pat;
              }else{
                echo "Seleccione un profesional";
              }

              ?>
            
            
            </label>
            <input type="hidden" name="txtRutmedHidden" id="txtRutmedHidden" value='<?php echo $medico->rut?> '>
          </div>
        
    <div class="col-xs-9" id='calendar'>
      
    </div>
    </div>
</form>
</div>
  <div class="modal fade" id="modalNew">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Nueva hora</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <label>Inicio</label>
                <input type="text" id="txtIni" name="txtIni" class="form-control" disabled>
                <label>Rut</label>
                <input type="text" class="form-control input-number" name="txtPaciente" id="txtPaciente">
                <label>Paciente</label>
                <input type="text" name="txtNomPac" id="txtNomPac" class="form-control">
                <input type="hidden" id="txtFin" name="txtFin" class="form-control" disabled > 
                <label>Obs</label>
                <input type="text" name="txtobs" id="txtobs" class="form-control">
              </div>
              <div class="modal-footer">
                <button type="button" id="btnOK" class="btn btn-primary">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
    </div>

    <!-- set up the modal to start hidden and fade in and out -->
    <div id="myModal" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- dialog body -->
          <div class="modal-body">
            <input type="hidden" id="txtIdEvento" name="txtIdEvento">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            ¿Qué desea hacer?
          </div>
          <!-- dialog buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnComenzar">Comenzar atención</button>
            <button type="button" class="btn btn-primary" id="btnConfirmar">Confirmar</button>
            <button type="button" class="btn btn-primary" id="btnCancelEv">Cancelar</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

     <div id="modalPreguntaPac" class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- dialog body -->
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            Paciente no encontrado, ¿desea registrarlo?
          </div>
          <!-- dialog buttons -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="btnSi">Sí</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btnNo">No</button>
          </div>
        </div>
      </div>
    </div>

    <!-- REGISTRA PACIENTE-->
    <div class="modal fade" id="modalNewPaciente">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Nuevo Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="hidden" id="txtRutPac" name="txtRutPac" class="form-control" disabled>
                <label>Nombre</label>
                <input type="text" class="form-control" name="txtNomPac2" id="txtNomPac2">
                <label>Apellido Paterno</label>
                <input type="text" name="txt" id="txtApat" class="form-control">
                <label>Apellido Materno</label>
                <input type="text" name="txtAmat" id="txtAmat" class="form-control">
                <label>Sexo</label>
                <select class="form-control" id="cboSexo2">
                  <option selected value="">Seleccione</option>
                  <option value="1">Hombre</option>
                  <option value="0">Mujer</option>
                </select>
                <label>Fecha nacimiento</label>
                <input type="date" id="txtFnac" class="form-control" required>
                <label>Teléfono</label>
                <input type="text" name="txtTel" id="txtTel" class="form-control">
                <label>Email</label>
                <input type="text" name="txtEmail2" id="txtEmail2" class="form-control">
              </div>
              <div class="modal-footer">
                <button type="button" id="btnGuardaPac" class="btn btn-primary">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </div>
    </div>
</body>
</html>