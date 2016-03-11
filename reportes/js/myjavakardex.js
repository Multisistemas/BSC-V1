$(document).ready(pagination(1));
$(function(){
	
	$('#bd-desde').on('change', function(){
		var desde = $('#bd-desde').val();
		var hasta = $('#bd-hasta').val();
		var url = '../kardex/ver_detalles.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros').html(datos);
			$('#pagination').html("");
		}
	});
	return false;
	});
	
	$('#bd-hasta').on('change', function(){
		var desde = $('#bd-desde').val();
		var hasta = $('#bd-hasta').val();
		var url = '../kardex/ver_detalles.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'desde='+desde+'&hasta='+hasta,
		success: function(datos){
			$('#agrega-registros').html(datos);
			$('#pagination').html("");
		}
	});
	return false;
	});
	
	$('#busca').on('keyup',function(){
		var dato = $('#busca').val();
		var url = '../kardex/busca_producto.php';
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

function reportePDF(){
	//var desde = $('#bd-desde').val();
	var id = $('#idpro').val();
	window.open('../kardex/reporte.php?idpro='+id);
}

function verdetalle(id){
	var url = '../kardex/ver_detalles.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-detalle').html(registro);
			$('#idpro').val(id);
			$('#ver-detalle').modal({
			show:true,
			backdrop:'static'
		});
	}
	});
	return false;
}

function pagination(partida){
	var url = '../kardex/paginarproducto.php';
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