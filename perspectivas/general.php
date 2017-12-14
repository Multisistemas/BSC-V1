<?php
include_once("../registros/Function.php");
?>
<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<script language="javascript">
$(document).ready(function() {
	$("#botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>
<style type="text/css">
#botonExcel{cursor:pointer;}
</style>
<?php
	$idempresa = $_SESSION['id_empresa'];
	
	if(isset($_REQUEST['id_area'])) {
		$idarea = $_REQUEST['id_area'];
	} elseif(isset($_SESSION['id_area'])) {
		$idarea = $_SESSION['id_area'];
	} else {
		$idarea=2;
	}
	
	if(isset($_REQUEST['mes'])) {
		$mes=$_REQUEST['mes'];
	}
?>
<form action="index.php" method="post">
	<div class="box" id='Exportar_a_Excel'>
	    <!-- /.box-header -->
	    <div class="box-body">
	        <div id="filters_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
	            <div class="row">
	                <div class="col-sm-3">
		                <div class="box-header">
		                    <div class="dataTables_filter" id="year_filter">
		                        <label>Seleccione A&ntilde;o&nbsp;&nbsp;</label>
		                        <?php if(isset($_POST['anio'])) $anio = $_POST['anio']; else $anio=date("Y"); llenaranios($anio); ?>
		                    </div>
	                	</div>
	                    
						<?php //tablaperspectiva($idempresa, $idarea, 1, $anio, $mes); ?>                    
	                </div>
	                <div class="col-sm-3">
		                <div class="box-header">
		                    <div class="dataTables_filter" id="month_filter">
		                        <label>Seleccione Mes&nbsp;&nbsp;</label>
									<select name="mes" class="form-control input-sm">
										<?php if(isset($_POST['mes'])) $mes = $_POST['mes']; else $mes='01'; ?>
								        <option value="01" <?php if($mes=='01') { ?> selected="selected" <?php ;} ?>>Enero</option>
								        <option value="02" <?php if($mes=='02') { ?> selected="selected" <?php ;} ?>>Febrero</option>
										<option value="03" <?php if($mes=='03') { ?> selected="selected" <?php ;} ?>>Marzo</option>
										<option value="04" <?php if($mes=='04') { ?> selected="selected" <?php ;} ?>>Abril</option>
										<option value="05" <?php if($mes=='05') { ?> selected="selected" <?php ;} ?>>Mayo</option>
										<option value="06" <?php if($mes=='06') { ?> selected="selected" <?php ;} ?>>Junio</option>
										<option value="07" <?php if($mes=='07') { ?> selected="selected" <?php ;} ?>>Julio</option>
										<option value="08" <?php if($mes=='08') { ?> selected="selected" <?php ;} ?>>Agosto</option>
										<option value="09" <?php if($mes=='09') { ?> selected="selected" <?php ;} ?>>Septiembre</option>
										<option value="10" <?php if($mes=='10') { ?> selected="selected" <?php ;} ?>>Octubre</option>
										<option value="11" <?php if($mes=='11') { ?> selected="selected" <?php ;} ?>>Noviembre</option>
										<option value="12" <?php if($mes=='12') { ?> selected="selected" <?php ;} ?>>Diciembre</option>
								  	</select>&nbsp;&nbsp;<input name="button" type="submit" class="form-control input-sm" value="Ver" />
		                    </div>
		                </div>
	                </div>
	                <div class="col-sm-3 pull-right">
		                <div class="box-header">
		                    <div class="dataTables_export" id="button_export">
				                <div class="btn-group pull-right">
									<button type="button" class="btn btn-info">Acciones</button>
									<button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<span class="caret"></span>
										<span class="sr-only">Abrir acciones</span>
									</button>
									<ul class="dropdown-menu" role="menu" id="export-menu">
										<li id="export-to-excel"><a href="#">Exportar a excel</a></li>
										<li id="export-to-csv"><a href="#">Exportar a csv</a></li>
										<li class="divider"></li>
										<li id="print"><a href="#" onclick="window.print();">Imprimir</a></li>
									</ul>
								</div>
		                    </div>
		                </div>
	                </div>
					
	            </div>
	        </div> <!-- filters_wrapper -->
	        <div id="tables_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
	            <div class="row">
	                <div class="col-sm-6">
						<?php 
							tablaperspectiva($idempresa, $idarea, 1, $anio, $mes);
							tablaperspectiva($idempresa, $idarea, 3, $anio, $mes);
						?>
	                </div>
	                <div class="col-sm-6">
						<?php 
							tablaperspectiva($idempresa, $idarea, 2, $anio, $mes);
							tablaperspectiva($idempresa, $idarea, 4, $anio, $mes);
						?>
	                </div>
	            </div>
	        </div> <!-- tables_wrapper -->
	    </div>
	    <!-- /.box-body -->
	</div>
</form>
<div>
	<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
		<p align="center">
			<a class='btn btn-app' href='#' onClick='window.print();'>
				<i class="fa fa-print"></i>
<!-- 				<img src="../../images/imprimir.png" border='0' title='Imprimir' width='30' height='30'> -->
			</a>&nbsp;&nbsp;&nbsp;
			<a id='botonExcel' class="btn btn-app">
				<i class='fa fa-file-excel-o'></i>
<!-- 			<img src="../../images/excel.jpg" class="botonExcel" width="30" height="30" title="Exportar a Excel"/> -->
			</a>
		</p>
		<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
	</form>
</div>
