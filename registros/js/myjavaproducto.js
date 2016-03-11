$(document).ready(pagination(1));
$(function(){
	
	$('#nuevo-producto').on('click',function(){
		$('#formulario')[0].reset();
		$('#pro').val('Registro');
		$('#edi').hide();
		$('#reg').show();
		$('#registra-producto').modal({
			show:true,
			backdrop:'static'
		});
	});
	
	$('#busca').on('keyup',function(){
		var dato = $('#busca').val();
		var url = '../producto/busca_producto.php';
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
	
	$('#buscacliente').on('keyup',function(){
		var dato = $('#buscacliente').val();
		var url = '../producto/busca_producto.php';
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
	var url = '../producto/agrega_producto.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			if ($('#pro').val() == 'Registro'){
			$('#formulario')[0].reset();
			$('#mensaje').addClass('bien').html('Registro completado con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			$('#registra-producto').modal('hide');
			return false;
			}else{
			$('#mensaje').addClass('bien').html('Edicion completada con exito').show(200).delay(2500).hide(200);
			$('#agrega-registros').html(registro);
			$('#registra-producto').modal('hide');
			return false;
			}
		}
	});
	return false;
}

function eliminarproducto(id){
	var url = '../producto/elimina_producto.php';
	var pregunta = confirm('¿Esta seguro de eliminar este producto?');
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

function editarproducto(id){
	$('#formulario')[0].reset();
	var url = '../producto/edita_producto.php';
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
				$('#producto').val(datos[0]);
				$('#precioc').val(datos[1]);
				$('#preciov').val(datos[2]);
				$('#preciovu').val(datos[3]);
				$('#stock').val(datos[4]);
				$('#color').val(datos[5]);
				$('#ref').val(datos[6]);
				$('#idcategoria').val(datos[7]);
				$('#idalmacen').val(datos[8]);
				$('#registra-producto').modal({
					show:true,
					backdrop:'static'
				});
			return false;
		}
	});
	return false;
}


function pagination(partida){
	var url = '../producto/paginarproducto.php';
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