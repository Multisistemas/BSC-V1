$(document).ready(pagination(1));
$(function(){
	
	$('#nuevo-perspectiva').on('click',function(){
		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();
		$('#registra-perspectiva').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#busca').on('keyup',function(){
		var dato = $('#busca').val();
		var url = '../perspectiva/busca_perspectiva.php';
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
	var url = '../perspectiva/agrega_perspectiva.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			$('#registra-perspectiva').modal('hide');
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			$('#registra-perspectiva').modal('hide');
			return false;
			}
		}
	});
	return false;
}

function eliminarperspectiva(id){
	var url = '../perspectiva/elimina_perspectiva.php';
	var pregunta = confirm('¿Esta seguro de eliminar este perspectiva?');
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

function editarperspectiva(id){
	$('#formulario')[0].reset();
	var url = '../perspectiva/edita_perspectiva.php';
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
				$('#perspectiva').val(datos[0]);
				$('#registra-perspectiva').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}


function pagination(partida){
	var url = '../perspectiva/paginarperspectiva.php';
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