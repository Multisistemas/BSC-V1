<?php
include('config.php');
//include('registros/conexion.php');
$idarea = 0;
if(isset($_SESSION['id_usu'])==true){
		header('Location: intranet.php');
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Balanced Score Card | Acceso al Sistema</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $CFG->wwwroot;?>/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo $CFG->wwwroot;?>/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<!-- GOOGLE LOGIN BUTTON REQUIRED -->
	<meta name="google-signin-client_id" content="1072044933752-uon5ggg95c89e7l2q0uv8jqmgena397n.apps.googleusercontent.com">
<!-- GOOGLE LOGIN BUTTON REQUIRED -->
  </head>
  <?php 	include("registros/Function.php"); $DB=OpenConexion();?>
  <script src="registros/js/jquery.js"></script>
<script src="registros/js/myjavalogin.js"></script>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="."><b>Balanced Score Card</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
	  <!--<form method="post">-->
        <p class="login-box-msg">Ingrese sus datos para iniciar sesi&oacute;n</p>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Usuario" required="" id="usu">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Clave" required="" id="pass">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
		  <?php llenarcombo('area','idarea, area',' ORDER BY 2', $idarea, '','area'); ?>
		  </div>
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Recordar contraseña
                </label>
              </div>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button class="btn btn-primary btn-block btn-flat" id="ingresar">Ingresar</button>
            </div><!-- /.col -->
			<div class="col-xs-12"><div id="mensaje" class="callout callout-danger"></div></div>
          </div>
        <a href="recuperarclave.php">A olvidado su contraseña</a><br>
        <a href="registrarasistencia.php" class="text-center">Registrar Marcaci&oacute;n</a>
	  <!--</form>-->
	  <!-- GOOGLE BUTTON -->
	    <div class="gbutton" style="text-align: -webkit-center;margin-top: 30px;margin-bottom: 10px;">
		  <div id="my-signin2"></div>
		  <script>
		    function onSuccess(googleUser) {
		      console.log('Logged in as: ' + googleUser.getBasicProfile().getEmail());
		      var email = googleUser.getBasicProfile().getEmail();
		      var url = 'registros/login/procesar_login.php';
			  $.ajax({
				type: 'POST',
				url: url,
				data: 'email='+email,
				success: function(valor) {
					if(valor == 'usuario'){
						$('#mensaje').addClass('error').html('El usuario ingresado no existe').show(300).delay(3000).hide(300);
						$('#usu').focus();
						return false;
					}else if(valor == 'area'){
						$('#mensaje').addClass('error').html('Usted no pertenece al area seleccionada').show(300).delay(3000).hide(300);
						$('#area').focus();
						return false;
					}else if(valor == 'password'){
						$('#mensaje').addClass('error').html('Su password es incorrecto').show(300).delay(3000).hide(300);
						$('#pass').focus();
						return false;
					}else if(valor == 'ventas'){
						document.location.href = 'intranet.php';
					}else if(valor == 'almacen'){
						document.location.href = 'intranet.php';
					}
				}
			  });
		    }
		    function onFailure(error) {
		      console.log(error);
		    }
		    function renderButton() {
		      gapi.signin2.render('my-signin2', {
		        'scope': 'profile email',
		        'width': 240,
		        'height': 50,
		        'longtitle': true,
		        'theme': 'dark',
		        'onsuccess': onSuccess,
		        'onfailure': onFailure
		      });
		    }
		  </script>
		
		  <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
	    </div>
	  <!-- GOOGLE BUTTON -->
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
