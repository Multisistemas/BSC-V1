$(document).ready(pagination(1));
$(function(){
	
	$('#bd-desde').on('change', function(){
		var desde = $('#bd-desde').val();
		var hasta = $('#bd-hasta').val();
		var url = '../compras/busca_compras_fecha.php';
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
		var url = '../compras/busca_compras_fecha.php';
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
	
});

function reportePDF(){
	var desde = $('#bd-desde').val();
	var hasta = $('#bd-hasta').val();
	window.open('../compras/reporte.php?desde='+desde+'&hasta='+hasta);
}

function verdetalle(id){
	var url = '../compras/ver_detalles.php';
		$.ajax({
		type:'POST',
		url:url,
		data:'id='+id,
		success: function(registro){
			$('#agrega-detalle').html(registro);
			$('#ver-detalle').modal({
			show:true,
			backdrop:'static'
		});
	}
	});
	return false;
}

function pagination(partida){
	var url = '../compras/paginarcompras.php';
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