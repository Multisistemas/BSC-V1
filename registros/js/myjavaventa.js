$(document).ready(pagination(1));
$(function(){
	$('#agrega-registros').fadeOut(100);
	$('#agregar').on('click',function(){
		var idpro = $('#idpro').val();
		var can = $('#cantidad').val();
		var url = '../venta/agrega_producto.php';
		if (idpro>0){
		$.ajax({
		type:'POST',
		url:url,
		data:'idpro='+idpro+'&can='+can,
		success: function(registro){
			$('#agrega-ventas').html(registro);
			$('#busca').val('');
			$('#cantidad').val('');
			$('#idpro').val('');
			$('#busca').focus();
			}
		});
		} else
		{alert("No hay productos seleccionados"); $('#busca').focus();}
	return false;
	});
	
	$('#cancelarventa').on('click',function(){
		var url = '../venta/cancelar_venta.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'idpro='+idpro,
		success: function(registro){
			$('#agrega-ventas').html(registro);
			$('#busca').val('');
			$('#cantidad').val('');
			$('#idpro').val('');
			$('#idpersona').val('');
			$('#fecha').val('');
			$('#busca').focus();
			}
		});
	return false;
	});
	
	$('#busca').on('keyup',function(){
		var dato = $('#busca').val();
		var url = '../venta/busca_producto.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'dato='+dato,
		success: function(datos){
			$('#agrega-registros').fadeIn(1000).html(datos);
			$('.suggest-element').on('click', function(){
                    //Obtenemos la id unica de la sugerencia pulsada
                    var id = $(this).attr('id');
					$('#idpro').val(id);
                    //Editamos el valor del input con data de la sugerencia pulsada
                    $('#busca').val($('#'+id).attr('data'));
                    //Hacemos desaparecer el resto de sugerencias
					$('#cantidad').val('');
					$('#cantidad').focus();
                    $('#agrega-registros').fadeOut(1000);
                })
		}
	});
	return false;
	});
	
});

function agregaRegistro(){
	var url = '../venta/registrar_venta.php';
	if ($('#idpersona').val()>0){
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulario').serialize(),
		success: function(registro){
			$('#formulario')[0].reset();
			$('#agrega-ventas').html(registro);
			$('#busca').focus();
			return false;	
		}
	});
	}
	else
	{alert("Seleccione Cliente"); $('#idpersona').focus();}
return false;
}

function eliminarproducto(id){
	var url = '../venta/elimina_producto.php';
	var pregunta = confirm('¿Esta seguro de eliminar este producto?');
	if(pregunta==true){
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-ventas').html(registro);
			return false;
		}
	});
	return false;
	}else{
		return false;
	}
}

function actualizarproducto(id,val){
	var url = '../venta/actualizar_producto.php';
		var preventa = $('#preventa'+val+'').val();
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id+'&pre='+preventa,
		success: function(registro){
			$('#agrega-ventas').html(registro);
			return false;
		}
	});
	return false;
}

function pagination(partida){
	var url = '../venta/paginarventas.php';
	$.ajax({
		type:'POST',
		url:url,
		data:'partida='+partida,
		success:function(data){
			var array = eval(data);
			$('#agrega-ventas').html(array[0]);
			$('#pagination').html(array[1]);
		}
	});
	return false;
}