$(document).ready(pagination(1));
$(function(){

	$('#busca').on('keyup',function(){
		var dato = $('#busca').val();
		var url = '../proveedores/busca_persona.php';
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
	window.open('../proveedores/reporte.php?filtro='+dato);
}

function pagination(partida){
	var url = '../proveedores/paginarpersona.php';
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