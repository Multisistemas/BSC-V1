$(function(){
	
	$('#busca').on('keyup',function(){
		var dato = $('#busca').val();
		var url = '../php/busca_mensajes.php';
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

function actualizaRegistro(){
	var url = 'registros/perfil/actualiza_perfil.php';
	$.ajax({
		type:'POST',
		url:url,
		data:$('#formulariodatos').serialize(),
		success: function(registro){
			$('#formulariodatos')[0].reset();
			alert("Datos de Usuario actualizados...");
			location='intranet.php';
			return false;
		}
	});
	return false;
}
