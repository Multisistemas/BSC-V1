$(document).ready(pagination(1));
$(function(){
	
	$('#nuevo-usuario').on('click',function(){
		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();
		$('#registra-usuario').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#busca').on('keyup',function(){
		var dato = $('#busca').val();
		var url = '../usuario/busca_usuario.php';
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
	var url = '../usuario/agrega_usuario.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			$('#registra-usuario').modal('hide');
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			$('#registra-usuario').modal('hide');
			return false;
			}
		}
	});
	return false;
}

function eliminarusuario(id){
	var url = '../usuario/elimina_usuario.php';
	var pregunta = confirm('¿Esta seguro de eliminar este Usuario?');
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

function editarusuario(id){
	$('#formulario')[0].reset();
	var url = '../usuario/edita_usuario.php';
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
				$('#login').val(datos[0]);
				$('#dui').val(datos[1]);
				$('#nombres').val(datos[2]);
				$('#apellidos').val(datos[3]);
				$('#email').val(datos[4]);
				$('#clave').val(datos[5]);
				$('#idtipousuario').val(datos[6]);
				$('#idarea').val(datos[7]);
				$('#idempresa').val(datos[8]);
				$('#registra-usuario').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}


function pagination(partida){
	var url = '../usuario/paginarusuario.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida,
		success:function(data){
			var array = eval(data);
			if(typeof array !== 'undefined'){
				$('#agrega-registros').html(array[0]);
				$('#pagination').html(array[1]);
			}
		}
	});
	return false;
}