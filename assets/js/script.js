$(document).ready(function(){

	function configToastr(){
		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": false,
		  "progressBar": true,
		  "positionClass": "toast-top-right",
		  "preventDuplicates": true,
		  "onclick": null,
		  "showDuration": "300",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}
	}

	var baseUrl = 'http://localhost/clinic_calendar/index.php/';

	$('.input-number').on('input', function () { 
    	this.value = this.value.replace(/[^0-9]/g,'');
	});

	//BUSCAR PACIENTE POR RUT AL PRESIONAR ENTER
	$('#txtPaciente').keypress(function(e) {
    	var keycode = (e.keyCode ? e.keyCode : e.which);
    	if (keycode == '13') {
    		if($("#txtPaciente").val().length > 0){
    			var rut_num = $('input[name=txtPaciente').val();

	        	$.ajax({
	        		type: 'post',
	        		url: baseUrl + 'Paciente/GetPaciente2',
	        		data: {rut_num: rut_num},
	        		success: function(data){
	        			var obj = JSON.parse(data);
	        			var nom = obj['nombre'];
		        		//console.log(data);
		        		//$('#txtNomPac').val(obj.paciente.nombre+' '+obj.paciente.a_pat+' '+obj.paciente.a_mat);
		        		if (data.length > 17) {
		        			//alert('hay datos');
		        			$('#txtNomPac').val(obj.paciente.nombre+' '+obj.paciente.a_pat+' '+obj.paciente.a_mat);
		        			$('#btnOK').attr("disabled", false);
		        		}else{
		        			$('#modalPreguntaPac').modal('show');
		        			$('#txtRutPac').val($('#txtPaciente').val());
		        		}
	        			
	        		}
	        	});
    		}
	    	else{
	    		alert('Ingrese rut');
	    	}
    	}
	});

	//limpia inputs cuando el modal se cierra
	$('#modalNew').on('hidden.bs.modal', function () {
    	$('#btnOK').attr("disabled", true);
    	$('#txtPaciente').val('');
    	$('#txtobs').val('');
    	$('#txtNomPac').val('');
	});

	//GUARDA EVENTO
	$('#btnOK').click(function(event) {
	    event.preventDefault();
	    $.ajax({
	        type:'post',
	        url: baseUrl + 'Events/NewEvent',
	        data:{
	          'rut_num':$('input[name=txtPaciente').val(),
	          'fini': $('input[name=txtIni').val(),
	          'ffin':$('input[name=txtFin').val(),
	          'rut_med':$('input[id=txtRutmedHidden').val(),
	          'obs':$('input[name=txtobs').val(),
	        },
	        success:function(data){
	        	console.log(data);
	          window.location.reload();
	        },
	    });
	});

	//LLENA COMBO PROFESIONAL
	/*$.ajax({
		type: 'post',
		url: baseUrl+'Profesional/GetAll',
		success: function(data){
			var obj = JSON.parse(data);
			console.log(obj);
			$.each(data.prof,function(key, value) {
				$("#cboProfesional").append('<option name="' + key + '">' + value + '</option>');
			});
		}
	});*/

    //event click
    $('#btnConfirmar').click(function(event){
      var id = $('#txtIdEvento').val();
      $.ajax({
      	type: 'post',
      	url: baseUrl + 'Events/UpdateEvent',
      	data: {id: id, request: 1},
      	success: function(){
      		alert('Confirmada');
      		var calendar = new Calendar(calendarEl, {
			  events: [
			    // my event data
			  ],
			  eventColor: '#180680'
			});

      	}
      });
    });

	$('#btnCancelEv').click(function(event){
	  var id = $('#txtIdEvento').val();
      $.ajax({
      	type: 'post',
      	url: baseUrl + 'Events/UpdateEvent',
      	data: {id: id, request: 0},
      	success: function(){
      		window.location.reload();
      	}
      });
	});

	$('#btnSi').click(function(){
		$('#modalPreguntaPac').modal('hide');
		$('#modalNewPaciente').modal('show');
	});

	//limpia inputs cuando el modal de nuevo paciente se cierra
	$('#modalNewPaciente').on('hidden.bs.modal', function () {
    	//$('#btnOK').attr("disabled", true);
    	$('#txtRutPac').val('');
		$('#txtNomPac2').val('');
		$('#txtApat').val('');
		$('#txtAmat').val('');
		$('#txtTel').val('');
		$('#cboSexo2').val(''); 
		$('#txtEmail2').val('');
		$('#txtFnac').val('');
	});

	//NUEVO PACIENTE
	$('#btnGuardaPac').click(function(){
		var rut = $('#txtRutPac').val();
		var nom = $('#txtNomPac2').val();
		var apat = $('#txtApat').val();
		var amat = $('#txtAmat').val();
		var tel = $('#txtTel').val();
		var sexo = $('#cboSexo2').val(); 
		var email = $('#txtEmail2').val();
		var fnac = $('#txtFnac').val();

		if(nom == "" || apat ==""){
			alert('Debe indicar nombre y apellido');
		}else{
			if(sexo == ""){
		    	alert('Debe seleccionar sexo');
			} else {
				if(fnac == ""){
					alert('Ingrese fecha de nacimiento');
				}else{
					$.ajax({
						type: 'post',
						url: baseUrl + 'Paciente/NewPaciente',
						data: {rut: rut,nombre: nom, apat: apat, amat: amat, fono: tel,email: email,sexo: sexo,fnac: fnac},
						success: function(){
							toastr.success('Paciente guardado!');
							$('#modalNewPaciente').modal('hide');
							$('#txtNomPac').val(nom+' '+apat+' '+amat);
							$('#btnOK').attr("disabled", false);
						},
						error: function(){
							console.log('error al guardar paciente');
						}
					});
				}
			}

		}

	});

	//comienza atencion desde un evento de la agenda
	$('#btnComenzar').click(function(){
		var idEvento2 = $('#txtIdEvento').val();
		window.location.href= baseUrl + 'Ficha?idEvento='+idEvento2;
	});

	$('#btnInfoPac').click(function(){
		var rut = $('#txtRutPac4').val();
		$('#modalInfoPaciente').modal('show');
		$('#txtRutPac3').val(rut);
	});

	//guarda datos del paciente desde header paciente
	$('#btnGuardaInfoPac').click(function(){
		
		var rut = $('#txtRutPac4').val();
		var fnac = $('#txtFechaNac2').val();

		$.ajax({
			type: 'post',
			url: baseUrl + 'Paciente/UpdatePaciente',
			data: {rut: rut,fnac: fnac},
			success: function(){
				console.log('Datos guardados');
				$('#modalInfoPaciente').modal('hide');
			},
			error: function(){
				console.log('error al guardar datos');
			}
		});
	});

	//guarda ficha de atencion
	$('#btnGuardaFicha').click(function(){
		$('#modalConfirm').modal('show');
	});

	$('#btnConfirmFicha').click(function(){
		var rut_pac = $('#txtRutPac4').val();
		var rut_med = $('#txtFechaNac2').val();
		var ante = $('#txtAntePed').val();
		var moti = $('#txtMotPed').val();
		var diag = $('#txtDiagPed').val();
		var indi = $('#txtIndiPed').val();
		var ex_fis = $('#txtExaPed').val();
		var sol_ex = $('#txtSolExPed').val();

		$.ajax({
			type: 'post',
			url: baseUrl + 'FichaPed/SaveFicha',
			data: {rut_pac: rut_pac,rut_med: rut_med, ante: ante, moti: moti, diag: diag,indi: indi, ex_fis: ex_fis,sol_ex: sol_ex},
			success: function(){
				console.log('Datos guardados');
				$('#modalConfirm').modal('hide');

			},
			error: function(){
				console.log('error al guardar datos');
			}
		});
	});

	//Formulario registro usuarios
	$('#btnRegistrar').click(function(){
		var nom = $('#txt_reg_nom').val();
		var apat = $('#txt_reg_apat').val();
		var amat = $('#txt_reg_amat').val();
		var email = $('#txt_reg_email').val();
		var pass1 = $('#txt_reg_pass').val();
		var pass2 = $('#confirmPass').val();

		var mail2 = $('#txt_mail_confirm').val();
		var nomCompleto = nom+' '+apat+' '+amat;
		var mensaje = "Hola "+"<strong>"+ nomCompleto+"</strong>"+" ,bienvenido a Clinic Calendar.<br>"+
						"Para acceder a configurar tu centro médico y agenda picha el siguiente enlace: http://localhost/clinic_calendar/ <br>"+
					   "Atentante, el equipo de Clinic Calendar";

		if (email != mail2) {
			toastr.error('Los correos no coinciden');
			$('#txt_mail_confirm').val('');
			$('#txt_mail_confirm').focus();			
		}else {

			if(pass1 === pass2){
	        	var promise = $.ajax({
		         	type:'post',
		         	url: baseUrl + 'User/Register',
		         	data:{a_pat: apat, a_mat: amat, nombre: nom, email: email, pass: pass1},
		         	success: function(){
		         		alert('Usuario registrado exitosamente. Serás redirigido al inicio de sesión.');
		         		$('#txt_reg_nom').val('');
						$('#txt_reg_apat').val('');
						$('#txt_reg_amat').val('');
						$('#txt_reg_email').val('');
						$('#txt_reg_pass').val('');
						$('#confirmPass').val('');
						$('#txt_mail_confirm').val('');
						window.location.href=baseUrl+ 'Home';
		         	},
		         	error: function(){
		         		toastr.error('Error al intentar registrar usuario');
		         	}
		         });
	        	promise.then(function(){
	        		$.ajax({
	        			type:'post',
	        			url: baseUrl+'User/sendMail',
	        			data: {subject: email,mensaje: mensaje},
	        		});
	        	});
	         
		    }else if(pass1 !== pass2){
		         //Si no son iguales
		         toastr.error("Las contraseñas no coinciden");
		         $('#txt_reg_pass').focus();
		    }
		}
	}); 

	//guarda nuevo profesional
	$('#btnNuevoProf').click(function(){
		var nomProf = $('#txtNomProf').val();
		var apeProf = $('#txtApeProf').val();
		var espe = $('#cboEspe').val();

		$.ajax({
			type: 'post',
			url: baseUrl + 'Profesional/newProfresional',
			data: {nomProf: nomProf, apeProf: apeProf, espe: espe},
			success: function(){
				toastr.success('Profesional registrado exitosamente');
						$('#txtNomProf').val('');
						$('#txtApeProf').val('');
						$('#cboEspe').val('');
			}
		});
	});

	//- - - - - - - -GUARDA FICHA SIMPLE - - - - - - - -
	$('#btnGuardaFsimple').click(function(){


		if($('#txtMotivo').val()=="" && $('#txtObsFicha').val()==""){
			toastr.warning('Se debe ingresar un motivo de consulta o una observación');
		}
		else{

			var obs = $('#txtObsFicha').val();
			var rut_pac = $('#txtRutPac4').val();
			var idEvento_ = $('#idEvento3').val();
			var motivo = $('#txtMotivo').val();

			var promise = $.ajax({
				type: 'post',
				url: baseUrl + 'Ficha/Save',
				data: {rut_pac: rut_pac, obs: obs, motivo:motivo},
				success: function(){
					toastr.success('Guardado exitosamente');
							$('#txtObsFicha').val('');
							$('#txtMotivo').val('');
				}
			});
			promise.then(function(){
				$.ajax({
					type: 'post',
					url: baseUrl + 'Events/updateEvent',
					data: {id: idEvento_, request: 2},
				});
			});	
		}
		
	});

	//Historial de atenciones
	$('#list-historial a').on('click', function (e) {
	  	var a = $(this).attr('value');
	  	
	  	$.ajax({
	  		type: 'post',
	  		url: baseUrl+'Ficha/getFichabyId',
	  		data: {idficha: a},
	  		success: function(data){
	  			var obj = JSON.parse(data);
	  			$('#txtMotivo').val(obj.ficha.motivo);
	  			$('#txtObsFicha').val(obj.ficha.obsGenerales);
	  			
	  		},
	  		error: function(){
	  			console.log('error al buscar ficha by ID');
	  		}
	  	});
	});

	//limpiar form ficha
	$('#btnLimpiar').on('click',function(){
		$('#txtMotivo').val('');
	  	$('#txtObsFicha').val('');
	  	$('#txtMotivo').focus();
	});


	$('#autocomplete').each(function(i, el) {
	    var that = $(el);
	    that.autocomplete({
	        source: baseUrl+'Paciente/getPacientes',
	        select: function( event , ui ) {
	        	$('#autocomplete').val(ui.item.label);
	        	var pac = ui.item.value;

	        	window.location.href = baseUrl + "Paciente/GetPaciente?pac="+pac;
	            //alert( "You selected: " + ui.item.label );
	        }
	    });

	});

	//- - - - - -  - GUARDA NOMBRE CENTRO MEDICO - - - - - - 
	/*$('#btnAddCentro').click(function(){
		var obs = $('#txtObsFicha').val();
		var rut_pac = $('#txtRutPac4').val();

		$.ajax({
			type: 'post',
			url: baseUrl + 'Ficha/Save',
			data: {rut_pac: rut_pac, obs: obs},
			success: function(){
				alert('Guardado exitosamente');
						$('#txtObsFicha').val('');
			}
		});
	});*/

});
