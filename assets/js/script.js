$(document).ready(function(){

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
	        		url: baseUrl + 'Paciente/GetPaciente',
	        		data: {rut_num: rut_num},
	        		success: function(data){
	        			var obj = JSON.parse(data);
	        			var nom = obj['nombre'];
		        		console.log(data);
		        		//$('#txtNomPac').val(obj.paciente.nombre+' '+obj.paciente.a_pat+' '+obj.paciente.a_mat);
		        		if (data.length > 17) {
		        			//alert('hay datos');
		        			$('#txtNomPac').val(obj.paciente.nombre+' '+obj.paciente.a_pat+' '+obj.paciente.a_mat);
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
      var id = $('#idEvento').val();
      $.ajax({
      	type: 'post',
      	url: baseUrl + 'Events/UpdateEvent',
      	data: {id: id, request: 1},
      	success: function(){
      		alert('Confirmada');
      	}
      });
    });

	$('#btnCancelEv').click(function(event){
	  var id = $('#idEvento').val();
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

	//NUEVO PACIENTE
	$('#btnGuardaPac').click(function(){
		var rut = $('#txtRutPac').val();
		var nom = $('#txtNomPac2').val();
		var apat = $('#txtApat').val();
		var amat = $('#txtAmat').val();
		var tel = $('#txtTel').val();

		$.ajax({
			type: 'post',
			url: baseUrl + 'Paciente/NewPaciente',
			data: {rut: rut,nombre: nom, apat: apat, amat: amat, fono: tel},
			success: function(){
				alert('Paciente guardado!');
				$('#modalNewPaciente').modal('hide');
				$('#txtNomPac').val(nom+' '+apat+' '+amat);
			},
			error: function(){
				console.log('error al guardar paciente');
			}
		});
	});

	$('#btnComenzar').click(function(){
		var idEvento2 = $('#txtIdEvento').val();
		window.location.href= baseUrl + 'FichaPed?idEvento='+idEvento2;
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
		var sexo = $('#cboSexo').val();
		var dir = $('#txtDir').val();
		var tel = $('#txtTel').val();
		var mail = $('#txtMail').val();

		$.ajax({
			type: 'post',
			url: baseUrl + 'Paciente/UpdatePaciente',
			data: {rut: rut,fnac: fnac, sexo: sexo, dir: dir, fono: tel, mail: mail},
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

		if (email != mail2) {
			alert('Los correos no coinciden');
			$('#txt_mail_confirm').val('');
			$('#txt_mail_confirm').focus();			
		}else {

			if(pass1 === pass2){
	         $.ajax({
	         	type:'post',
	         	url: baseUrl + 'User/Register',
	         	data:{a_pat: apat, a_mat: amat, nombre: nom, email: email, pass: pass1},
	         	success: function(){
	         		alert('Usuario registrado exitosamente');
	         		$('#txt_reg_nom').val('');
					$('#txt_reg_apat').val('');
					$('#txt_reg_amat').val('');
					$('#txt_reg_email').val('');
					$('#txt_reg_pass').val('');
					$('#confirmPass').val('');
					$('#txt_mail_confirm').val('');
	         	},
	         	error: function(){
	         		alert('Error al intentar registrar usuario');
	         	}
	         });

	         
		    }else if(pass1 !== pass2){
		         //Si no son iguales
		         alert("Las contraseñas no coinciden");
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
				alert('Profesional registrado exitosamente');
						$('#txtNomProf').val('');
						$('#txtApeProf').val('');
						$('#cboEspe').val('');
			}
		});
	});

});
