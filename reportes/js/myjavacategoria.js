$(document).ready(pagination(1));
$(function(){
	
	$('#busca').on('keyup',function(){
		var dato = $('#busca').val();
		var url = '../categoria/busca_categoria.php';
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
	var dato = $('#busca').val();
	window.open('../categoria/reporte.php?filtro='+dato);
}

function pagination(partida){
	var url = '../categoria/paginarcategoria.php';
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