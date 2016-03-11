$(document).ready(pagination(1));
$(function(){
	
	$('#nuevo-area').on('click',function(){
		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();
		$('#registra-area').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#busca').on('keyup',function(){
		var dato = $('#busca').val();
		var url = '../area/busca_area.php';
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
	var url = '../area/agrega_area.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			$('#registra-area').modal('hide');
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			$('#registra-area').modal('hide');
			return false;
			}
		}
	});
	return false;
}

function eliminararea(id){
	var url = '../area/elimina_area.php';
	var pregunta = confirm('¿Esta seguro de eliminar este area?');
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

function editararea(id){
	$('#formulario')[0].reset();
	var url = '../area/edita_area.php';
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
				$('#area').val(datos[0]);
				$('#registra-area').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}


function pagination(partida){
	var url = '../area/paginararea.php';
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