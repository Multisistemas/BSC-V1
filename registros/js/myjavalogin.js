$(function(){
	$('#mensaje').hide(0);
	// Regular login
	$('#ingresar').on('click',function(){
		var usu = $('#usu').val();
		var pass = $('#pass').val();
		var url = 'registros/login/procesar_login.php';
		var total = usu.length * pass.length;
		if (total>0){
			$.ajax({
				type: 'POST',
				url: url,
				data: 'usu='+usu+'&pass='+pass,
				success: function(valor){
					if(valor == 'usuario'){
						$('#mensaje').addClass('error').html('El correo ingresado no existe').show(300).delay(3000).hide(300);
						$('#usu').focus();
						return false;
					}else if(valor == 'password'){
						$('#mensaje').addClass('error').html('Su contraseña es incorrecta').show(300).delay(3000).hide(300);
						$('#pass').focus();
						return false;
					}else if(valor == 'ventas'){
						document.location.href = 'intranet.php';
					}else if(valor == 'almacen'){
						document.location.href = 'intranet.php';
					}
				}
			});
			return false;
		}else{
			$('#mensaje').addClass('error').html('Complete todos los campos').show(300).delay(3000).hide(300);
		}
	});
	
	// Google OAuth2 login
	$('#my-signin2').on('click', function(){
		console.log('IN');
	});
	
});