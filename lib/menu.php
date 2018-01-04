<?php
	include_once(dirname(__FILE__).'/../config.php');
	include_once($CFG->dirroot."/registros/Function.php");
	if ($_SESSION['id_usu']=="") {
		header("location:index.php");
	}
	
	if(isset($_REQUEST['id_area'])) {
		$idarea = $_REQUEST['id_area'];
	} elseif (isset($_SESSION['id_area'])) {
		$idarea = $_SESSION['id_area'];
	}
	
?>
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
			  	<li><a href="<?php echo $CFG->wwwroot;?>/registros/empresa"><i class="fa fa-circle-o"></i> Empresa</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/registros/usuario"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/registros/tipousuario"><i class="fa fa-circle-o"></i> Tipo Usuarios</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/persona"><i class="fa fa-circle-o"></i> Cliente / Proveedor</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/tipopersona"><i class="fa fa-circle-o"></i> Tipo Cliente / Proveedor</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/producto"><i class="fa fa-circle-o"></i> Producto</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/almacen"><i class="fa fa-circle-o"></i> Almac&eacute;n</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/area"><i class="fa fa-circle-o"></i> Area</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;a</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/perspectiva"><i class="fa fa-circle-o"></i> Perspectiva</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/objetivos"><i class="fa fa-circle-o"></i> Objetivos</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/producto"><i class="fa fa-circle-o"></i> Producto</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/almacen"><i class="fa fa-circle-o"></i> Almac&eacute;n</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;a</a></li>
				<?php } else { ?>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/persona"><i class="fa fa-circle-o"></i> Cliente / Proveedor</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/tipopersona"><i class="fa fa-circle-o"></i> Tipo Cliente / Proveedor</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/producto"><i class="fa fa-circle-o"></i> Producto</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;a</a></li>
				<?php }}?>
              </ul>
            </li>
			<li class="treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i> <span>Movimientos</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
			  <?php if($_SESSION['id_area']==5) { ?>
                <li><a href="<?php echo $CFG->wwwroot;?>/registros/venta"><i class="fa fa-circle-o"></i> Venta por Menor</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/ventaxmayor"><i class="fa fa-circle-o"></i> Venta por Mayor</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/registros/compras"><i class="fa fa-circle-o"></i> Registrar Compras</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/reportes/kardex"><i class="fa fa-circle-o"></i> Ver Kardex</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li><a href="<?php echo $CFG->wwwroot;?>/reportes/kardex"><i class="fa fa-circle-o"></i> Ver Kardex</a></li>
				<?php } else { ?>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/venta"><i class="fa fa-circle-o"></i> Venta por Menor</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/registros/ventaxmayor"><i class="fa fa-circle-o"></i> Venta por Mayor</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/registros/compras"><i class="fa fa-circle-o"></i> Registrar Compras</a></li>
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
                <li><a href="<?php echo $CFG->wwwroot;?>/reportes/producto"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/reportes/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;as</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/reportes/clientes"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/reportes/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/reportes/ventas"><i class="fa fa-circle-o"></i> Ventas</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/reportes/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
				<?php } else {if($_SESSION['id_area']==3){ ?>
				<li><a href="<?php echo $CFG->wwwroot;?>/reportes/producto"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/reportes/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;as</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/reportes/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/reportes/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
				<?php } else { ?>
				<li><a href="<?php echo $CFG->wwwroot;?>/reportes/producto"><i class="fa fa-circle-o"></i> Productos</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/reportes/categoria"><i class="fa fa-circle-o"></i> Categor&iacute;as</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/reportes/clientes"><i class="fa fa-circle-o"></i> Clientes</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/reportes/proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/reportes/ventas"><i class="fa fa-circle-o"></i> Ventas</a></li>
				<li><a href="<?php echo $CFG->wwwroot;?>/reportes/compras"><i class="fa fa-circle-o"></i> Compras</a></li>
				<?php }}?>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-map-marker"></i> <span>Ver Cuadro de Mando</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $CFG->wwwroot;?>/registros/verobjetivos"><i class="fa fa-circle-o"></i> Objetivos</a></li>
                <li><a href="<?php echo $CFG->wwwroot;?>/registros/mapasestrategicos"><i class="fa fa-circle-o"></i> Mapas Estrategicos</a></li>
				<li class=""><a href="#"><i class="fa fa-circle-o"></i> Perspectivas por área</a>
				<ul class="treeview-menu">
				<?php
					$query_areas = "SELECT * FROM area ORDER BY orden";
					$result_areas = mysqli_query($DB, $query_areas);
					
					$i = 0;
					while ($row_area = mysqli_fetch_assoc($result_areas)) {
						$i++;
						

						if($row_area['idarea'] == $idarea) {
							echo "<li class='active'><a href='{$CFG->wwwroot}/perspectivas/?id_area=".$row_area['idarea']."'><i class='fa fa-circle-o'></i> ".$row_area['area']."</a></li>";
						} else {
							echo "<li><a href='{$CFG->wwwroot}/perspectivas/?id_area=".$row_area['idarea']."'><i class='fa fa-circle-o'></i> ".$row_area['area']."</a></li>";
						}
						
					} // END WHILE
				?>
				</ul>
				</li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>