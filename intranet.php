<?php session_start();?>
<?php if ($_SESSION['id_usu']==""){header("location:index.php");}?>
<?php
   	include("registros/Function.php");
	$link=OpenConexion();
	$idusuario=$_SESSION['id_usu'];
	$rs=mysqli_query($link, "SELECT * FROM usuario u,area a,empresa e WHERE u.idarea=a.idarea and e.idempresa=u.idempresa and idusuario='$idusuario'");
	$filas =mysqli_fetch_object($rs);
	$nombres=$filas->nombres;
	$apellidos=$filas->apellidos;
	$usu=$nombres.' '.$apellidos;
	$correo=$filas->correo;
	$login=$filas->login;
	$area=$filas->area;
	$razon=$filas->razonsocial;
	$direccion=$filas->direccion;
	$rsf=mysqli_query($link, "SELECT * FROM uploadsperfil WHERE idusuario='$idusuario' order by id desc limit 1");
	$filasf =mysqli_fetch_object($rsf);
	$foto=$filasf->name;
	?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Balanced Score Card | Administrador - Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" type="text/css" href="bower_components/dropzone/downloads/css/dropzone.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="registros/js/jquery.js"></script>
	<script src="registros/js/myjavaperfil.js"></script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="intranet.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>BSC</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin </b>BSC</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="uploadsperfil/<?php echo utf8_encode($foto);?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $usu;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="uploadsperfil/<?php echo utf8_encode($foto);?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $usu;?> Administrador
                      <small>Miembro desde 2015</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="intranet.php" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="Cerrar_Sesion.php" class="btn btn-default btn-flat">Cerrar Sesion</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="uploadsperfil/<?php echo utf8_encode($foto);?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $nombres;?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MEN&Uacute; NAVEGACI&Oacute;N</li>
			<li class="active treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Registro</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  <?php if($_SESSION['id_area']==5) { ?>
			  	<li><a href="registros/empresa"><i class="fa fa-circle-o"></i> Empresa</a></li>
                <li><a href="registros/usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="registros/tipousuario"><i class="fa fa-circle-o"></i> Tipo Usuarios</a></li>
				<li><a href="registros/persona"><i class="fa fa-circle-o"></i> Cliente / Proveedor</a></li>
				<li><a href="registros/tipopersona"><i class="fa fa-circle-o"></i> Tipo Cliente / Proveedor</a></li>
				<li><a href="registros/producto"><i class="fa fa-circle-o"></i> Producto</a></li>
				<li><a href="registros/almacen"><i class="fa fa-circle-o"></i> Almac&eacute;n</a></li>
				<li><a href="registros/area"><i class="fa fa-circle-o"></i> Area</a></li>
				<li><a href="registros/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;a</a></li>
				<li><a href="registros/perspectiva"><i class="fa fa-circle-o"></i> Perspectiva</a></li>
				<li><a href="registros/objetivos"><i class="fa fa-circle-o"></i> Objetivos</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li><a href="registros/producto"><i class="fa fa-circle-o"></i> Producto</a></li>
				<li><a href="registros/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;a</a></li>
				<li><a href="registros/almacen"><i class="fa fa-circle-o"></i> Almac&eacute;n</a></li>
				<?php } else { ?>
				<li><a href="registros/persona"><i class="fa fa-circle-o"></i> Cliente / Proveedor</a></li>
				<li><a href="registros/tipopersona"><i class="fa fa-circle-o"></i> Tipo Cliente / Proveedor</a></li>
				<li><a href="registros/producto"><i class="fa fa-circle-o"></i> Producto</a></li>
				<li><a href="registros/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;a</a></li>
				<?php }}?>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i> <span>Movimientos</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  <?php if($_SESSION['id_area']==5) { ?>
                <li class="active"><a href="registros/venta"><i class="fa fa-circle-o"></i> Venta por Menor</a></li>
				<li class="active"><a href="registros/ventaxmayor"><i class="fa fa-circle-o"></i> Venta por Mayor</a></li>
                <li><a href="registros/compras"><i class="fa fa-circle-o"></i> Registrar Compras</a></li>
				<li><a href="reportes/kardex"><i class="fa fa-circle-o"></i> Ver Kardex</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li><a href="reportes/kardex"><i class="fa fa-circle-o"></i> Ver Kardex</a></li>
				<?php } else { ?>
				<li class="active"><a href="registros/venta"><i class="fa fa-circle-o"></i> Venta por Menor</a></li>
				<li class="active"><a href="registros/ventaxmayor"><i class="fa fa-circle-o"></i> Venta por Mayor</a></li>
                <li><a href="registros/compras"><i class="fa fa-circle-o"></i> Registrar Compras</a></li>
				<?php }}?>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Reportes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  <?php if($_SESSION['id_area']==5) { ?>
                <li><a href="reportes/producto"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="reportes/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;as</a></li>
                <li><a href="reportes/clientes"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="reportes/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
				<li><a href="reportes/ventas"><i class="fa fa-circle-o"></i> Ventas</a></li>
				<li><a href="reportes/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li><a href="reportes/producto"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="reportes/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;as</a></li>
				<li><a href="reportes/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
				<li><a href="reportes/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
				<?php } else { ?>
				<li><a href="reportes/producto"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="reportes/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;as</a></li>
                <li><a href="reportes/clientes"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="reportes/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
				<li><a href="reportes/ventas"><i class="fa fa-circle-o"></i> Ventas</a></li>
				<li><a href="reportes/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
				<?php }}?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i> <span>Ver Cuadro de Mando</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="registros/verobjetivos"><i class="fa fa-circle-o"></i> Objetivos</a></li>
                <li><a href="registros/mapasestrategicos"><i class="fa fa-circle-o"></i> Mapas Estrategicos</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i> Cuadro de Mando</a>
				<ul class="treeview-menu">
				<?php if($_SESSION['id_area']==5) { ?>
                <li class="active"><a href="perspectivas/pgenerala"><i class="fa fa-circle-o"></i> Almac&eacute;n</a></li>
				<li class="active"><a href="perspectivas/pgeneralo"><i class="fa fa-circle-o"></i> Operaciones</a></li>
				<li class="active"><a href="perspectivas/pgeneralrh"><i class="fa fa-circle-o"></i> Recursos Humanos</a></li>
				<li class="active"><a href="perspectivas/pgeneral"><i class="fa fa-circle-o"></i> Perspectiva General</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li class="active"><a href="perspectivas/pgenerala"><i class="fa fa-circle-o"></i> Almac&eacute;n</a></li>
				<?php } else {if($_SESSION['id_area']==4){ ?>
				<li class="active"><a href="perspectivas/pgeneralrh"><i class="fa fa-circle-o"></i> Recursos Humanos</a></li>
				<?php } else {?>
				<li class="active"><a href="perspectivas/pgeneralo"><i class="fa fa-circle-o"></i> Operaciones</a></li>
				<?php }}} ?>
				</ul>
				</li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

   <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Perfil de Usuario
          </h1>
          <ol class="breadcrumb">
            <li><a href="."><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Perfil de Usuario</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-3">

              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img src="uploadsperfil/<?php echo utf8_encode($foto);?>" alt="User profile picture" width="128" height="128" class="profile-user-img img-responsive img-circle">
                  <h3 class="profile-username text-center"><?php echo $usu;?></h3>
                  <p class="text-muted text-center"><strong>Area:</strong> <?php echo $area;?></p>

                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Acerca de</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <strong><i class="fa fa-book margin-r-5"></i>  Empresa:</strong>
                  <p class="text-muted">
                    <?php echo $razon;?>
                  </p>

                  <hr>

                  <strong><i class="fa fa-map-marker margin-r-5"></i> Direcci&oacute;n</strong>
                  <p class="text-muted"><?php echo utf8_encode($direccion);?></p>

                  <hr>

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-9">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#activity" data-toggle="tab">Cambiar Foto</a></li>
                  <li><a href="#timeline" data-toggle="tab">Editar Datos</a></li>
                </ul>
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
    <script type="text/javascript" src="js/jQuery-2.1.4.min.js"></script>
	<script type="text/javascript" src="bower_components/dropzone/downloads/dropzone.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function()
	{
		Dropzone.autoDiscover = false;
		$("#dropzone").dropzone({
			url: "uploadsperfil.php",
			addRemoveLinks: true,
			maxFileSize: 5,
			dictResponseError: "Ha ocurrido un error en el server",
			acceptedFiles: 'image/*,.jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF',
			complete: function(file)
			{
				if(file.status == "success")
				{
					location='intranet.php';
				}
			},
			error: function(file)
			{
				alert("Error subiendo el archivo " + file.name);
			},
			removedfile: function(file, serverFileName)
			{
				var name = file.name;
				$.ajax({
					type: "POST",
					url: "uploadsperfil.php?delete=true",
					data: "filename="+name,
					success: function(data)
					{
						var json = JSON.parse(data);
						if(json.res == true)
						{
							var element;
							(element = file.previewElement) != null ? 
							element.parentNode.removeChild(file.previewElement) : 
							false;
							location='intranet.php';
						}
					}
				});
			}
		});
	});
	</script>
	<div id="dropzone" class="dropzone"></div>
                    </div><!-- /.post -->
                  </div><!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
					<form class="form-horizontal" id="formulariodatos" onSubmit="return actualizaRegistro();">
					<input type="text" required="required" id="idu" name="idu" value="<?php echo $_SESSION['id_usu'];?>" readonly="readonly" style="visibility:hidden; height:1px;"/>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Nombres</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nombrep" name="nombrep" placeholder="nombre" required="" value="<?php echo $nombres;?>">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Apellidos</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="apellidosp" name="apellidosp" placeholder="apellidos" required="" value="<?php echo $apellidos;?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="emailp" name="emailp" placeholder="email" required="" value="<?php echo $correo;?>">
                        </div>
                      </div>
					  <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Login</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="loginp" name="loginp" placeholder="login" required="" value="<?php echo $login;?>">
                        </div>
						</div>
                      <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Clave</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="clavep" name="clavep" placeholder="Ingrese clave" required="">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-12">
                          <input type="submit" value="Actualizar Datos" class="btn btn-success" id="reg"/>
                        </div>
                      </div>
                    </form>
                  </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
              </div><!-- /.nav-tabs-custom -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versi&oacute;n</b> 1.0
        </div>
        <strong>Copyright &copy; 2017 <a href="https://multissitemas.com.sv">Multisistemas</a>.</strong> Todos los derechos reservados.
      </footer>

 
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>-->
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
  </body>
</html>
