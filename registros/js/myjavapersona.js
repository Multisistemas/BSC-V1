$(document).ready(pagination(1));
$(function(){
	
	$('#nuevo-persona').on('click',function(){
		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();
		$('#registra-persona').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#busca').on('keyup',function(){
		var dato = $('#busca').val();
		var url = '../persona/busca_persona.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#agrega-registros').html(datos);
		}
	});
	return false;
	});
	
});

function agregaRegistro(){
	var url = '../persona/agrega_persona.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			$('#registra-persona').modal('hide');
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			$('#registra-persona').modal('hide');
			return false;
			}
		}
	});
	return false;
}

function eliminarpersona(id){
	var url = '../persona/elimina_persona.php';
	var pregunta = confirm('¿Esta seguro de eliminar este Cliente o Proveedor?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-registros').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}

function editarpersona(id){
	$('#formulario')[0].reset();
	var url = '../persona/edita_persona.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(valores){
				var datos = eval(valores);
				$('#reg').hide();
				$('#edi').show();
				$('#pro').val('Edicion');
				$('#id').val(id);
				$('#ruc').val(datos[0]);
				$('#rsocial').val(datos[1]);
				$('#direccion').val(datos[2]);
				$('#telefono').val(datos[3]);
				$('#celular').val(datos[4]);
				$('#correo').val(datos[5]);
				$('#idtipopersona').val(datos[6]);
				$('#registra-persona').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}


function pagination(partida){
	var url = '../persona/paginarpersona.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida,
		success:function(data){
			var array = eval(data);
			$('#agrega-registros').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}