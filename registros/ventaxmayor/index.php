<?php session_start();?>
<?php if ($_SESSION['id_usu']==""){header("location:index.php");}?>
<?php
   	include("../../registros/Function.php");
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
  <style>
.suggest-element{
margin-left:5px;
margin-top:5px;
width:550px;
cursor:pointer;
}
#agrega-registros {
width:550px;
height:150px;
overflow: hidden;
}
</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Balanced Score Card | Administrador - Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="../js/jquery.js"></script>
	<script src="../js/myjavaventapm.js"></script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
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
                  <img src="../../uploadsperfil/<?php echo utf8_encode($foto);?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $usu;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../../uploadsperfil/<?php echo utf8_encode($foto);?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $usu;?> Administrador
                      <small>Miembro desde 2015</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="../../intranet.php" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="../../Cerrar_Sesion.php" class="btn btn-default btn-flat">Cerrar Sesion</a>
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
              <img src="../../uploadsperfil/<?php echo utf8_encode($foto);?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $nombres;?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MEN&Uacute; NAVEGACI&Oacute;N</li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-edit"></i> <span>Registro</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  <?php if($_SESSION['id_area']==5) { ?>
			  	<li><a href="../../registros/empresa"><i class="fa fa-circle-o"></i> Empresa</a></li>
                <li><a href="../../registros/usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="../../registros/tipousuario"><i class="fa fa-circle-o"></i> Tipo Usuarios</a></li>
				<li><a href="../../registros/persona"><i class="fa fa-circle-o"></i> Cliente / Proveedor</a></li>
				<li><a href="../../registros/tipopersona"><i class="fa fa-circle-o"></i> Tipo Cliente / Proveedor</a></li>
				<li><a href="../../registros/producto"><i class="fa fa-circle-o"></i> Producto</a></li>
				<li><a href="../../registros/almacen"><i class="fa fa-circle-o"></i> Almac&eacute;n</a></li>
				<li><a href="../../registros/area"><i class="fa fa-circle-o"></i> Area</a></li>
				<li><a href="../../registros/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;a</a></li>
				<li><a href="../../registros/perspectiva"><i class="fa fa-circle-o"></i> Perspectiva</a></li>
				<li><a href="../../registros/objetivos"><i class="fa fa-circle-o"></i> Objetivos</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li><a href="../../registros/producto"><i class="fa fa-circle-o"></i> Producto</a></li>
				<li><a href="../../registros/almacen"><i class="fa fa-circle-o"></i> Almac&eacute;n</a></li>
				<li><a href="../../registros/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;a</a></li>
				<?php } else { ?>
				<li><a href="../../registros/persona"><i class="fa fa-circle-o"></i> Cliente / Proveedor</a></li>
				<li><a href="../../registros/tipopersona"><i class="fa fa-circle-o"></i> Tipo Cliente / Proveedor</a></li>
				<li><a href="../../registros/producto"><i class="fa fa-circle-o"></i> Producto</a></li>
				<li><a href="../../registros/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;a</a></li>
				<?php }}?>
              </ul>
            </li>
			<li class="active treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i> <span>Movimientos</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  <?php if($_SESSION['id_area']==5) { ?>
                <li><a href="../../registros/venta"><i class="fa fa-circle-o"></i> Venta por Menor</a></li>
				<li class="active"><a href="../../registros/ventaxmayor"><i class="fa fa-circle-o"></i> Venta por Mayor</a></li>
                <li><a href="../../registros/compras"><i class="fa fa-circle-o"></i> Registrar Compras</a></li>
				<li><a href="../../reportes/kardex"><i class="fa fa-circle-o"></i> Ver Kardex</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li><a href="../../reportes/kardex"><i class="fa fa-circle-o"></i> Ver Kardex</a></li>
				<?php } else { ?>
				<li><a href="../../registros/venta"><i class="fa fa-circle-o"></i> Venta por Menor</a></li>
				<li class="active"><a href="../../registros/ventaxmayor"><i class="fa fa-circle-o"></i> Venta por Mayor</a></li>
                <li><a href="../../registros/compras"><i class="fa fa-circle-o"></i> Registrar Compras</a></li>
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
                <li><a href="../../reportes/producto"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="../../reportes/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;as</a></li>
                <li><a href="../../reportes/clientes"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="../../reportes/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
				<li><a href="../../reportes/ventas"><i class="fa fa-circle-o"></i> Ventas</a></li>
				<li><a href="../../reportes/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li><a href="../../reportes/producto"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="../../reportes/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;as</a></li>
				<li><a href="../../reportes/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
				<li><a href="../../reportes/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
				<?php } else { ?>
				<li><a href="../../reportes/producto"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="../../reportes/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;as</a></li>
                <li><a href="../../reportes/clientes"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="../../reportes/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
				<li><a href="../../reportes/ventas"><i class="fa fa-circle-o"></i> Ventas</a></li>
				<li><a href="../../reportes/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
				<?php }}?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i> <span>Ver Cuadro de Mando</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="active"><a href="../../registros/verobjetivos"><i class="fa fa-circle-o"></i> Objetivos</a></li>
                <li><a href="../../registros/mapasestrategicos"><i class="fa fa-circle-o"></i> Mapas Estrategicos</a></li>
				<li><a href="#"><i class="fa fa-circle-o"></i> Cuadro de Mando</a>
				<ul class="treeview-menu">
				<?php if($_SESSION['id_area']==5) { ?>
                <li class="active"><a href="../../perspectivas/pgenerala"><i class="fa fa-circle-o"></i> Almac&eacute;n</a></li>
				<li class="active"><a href="../../perspectivas/pgeneralo"><i class="fa fa-circle-o"></i> Operaciones</a></li>
				<li class="active"><a href="../../perspectivas/pgeneralrh"><i class="fa fa-circle-o"></i> Recursos Humanos</a></li>
				<li class="active"><a href="../../perspectivas/pgeneral"><i class="fa fa-circle-o"></i> Perspectiva General</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li class="active"><a href="../../perspectivas/pgenerala"><i class="fa fa-circle-o"></i> Almac&eacute;n</a></li>
				<?php } else {if($_SESSION['id_area']==4){ ?>
				<li class="active"><a href="../../perspectivas/pgeneralrh"><i class="fa fa-circle-o"></i> Recursos Humanos</a></li>
				<?php } else {?>
				<li class="active"><a href="../../perspectivas/pgeneralo"><i class="fa fa-circle-o"></i> Operaciones</a></li>
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
            Registro de Ventas
          </h1>
          <ol class="breadcrumb">
            <li><a href="."><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Nueva Venta</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
		<!-- Inicio Formulario -->
 <div class="container">
 		<form id="formulario" class="formulario" onSubmit="return agregaRegistro();">
 		<div class="page-header">
			<h1>Venta por mayor</h1>
		</div>
		<div class="row">
			<div class="col-md-3">	
				<div><label>Empresa: </label> <label><?php echo $razon;?></label>
				</div>
			</div>
			<div class="col-md-3">
				<div><label>Cliente:</label> <?php llenarcombo('persona','idpersona, razonsocial',' where idtipopersona=1 and idempresa='.$_SESSION["id_empresa"].' ORDER BY 2', $idpersona, '','idpersona'); ?>
				</div>
			</div>
			<div class="col-md-3">
				<div>
				<label>Fecha: </label>
				<input type="date" id="fecha" name="fecha" class="form-control" required=""/>
				</div>
			</div>
		</div>
 		<div class="row">
			<div class="col-md-5">	
				<div><label>Producto:</label> <input id="busca" name="busca" type="text" class="col-md-2 form-control" placeholder="Ingresar Producto.." autocomplete="on" /><input type="text" id="idpro" name="idpro" style="visibility:hidden; height:1px;"/>
				<div id="agrega-registros"></div>
				</div>
			</div>
			<div class="col-md-2">
				<div><label>Cantidad:</label>
				  <input id="cantidad" name="cantidad" type="text" class="col-md-2 form-control" placeholder="Ingrese cantidad" autocomplete="off" />
				</div>
			</div>
			<div class="col-md-2">
				<div style="margin-top: 25px;">
				<button type="button" id="agregar" class="btn btn-success btn-agregar-producto">Agregar</button>
				</div>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-9">
		<div class="panel panel-info">
			 <div class="panel-heading">
		        <h3 class="panel-title">Productos Agregados</h3>
		      </div>
			<div class="panel-body detalle-producto">
				<div id="agrega-ventas"></div>
				<div id="pagination" class="pagination"></div>
				<div class="row">
				<div class="col-md-12" style="text-align:right;">
				<button type="submit" id="grabarventa" class="btn btn-primary btn-agregar-producto">Grabar Venta</button>
				<button type="button" id="cancelarventa" class="btn btn-warning btn-agregar-producto">Cancelar Venta</button>
				</div></div>
			</div>
		</div>
		</div></div>
		</form>
 	</div>
	  <!--Fin formulario-->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versi&oacute;n</b> 1.0
        </div>
        <strong>Copyright &copy; 2015 <a href="http://www.balancedscorecard.com">Jorge Mendieta</a>.</strong> Todos los derechos reservados.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>

              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-warning pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../../plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
  </body>
</html>
