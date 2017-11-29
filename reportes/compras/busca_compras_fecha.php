<?php
session_start();
$idempresa=$_SESSION['id_empresa'];
include_once(dirname(__FILE__).'/../../config.php');

$desde = $_POST['desde'];
$hasta = $_POST['hasta'];
$desde = date('Y-m-d',strtotime($desde));
$hasta = date('Y-m-d',strtotime($hasta));

//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysqli_query($DB, "SELECT * FROM documento_compra dv,persona p WHERE dv.idproveedor=p.idpersona and dv.idempresa='$idempresa' and fecha BETWEEN '$desde' AND '$hasta' ORDER BY iddocumento ASC limit 500");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="200">Proveedor</th>
				<th width="200">Fecha</th>
				<th width="200">Total</th>
				<th width="200">Ver Detalle</th>
            </tr>';
if(mysqli_num_rows($registro)>0){
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.utf8_encode($registro2['razonsocial']).'</td>
				<td>'.$registro2['fecha'].'</td>
				<td>'.$registro2['total'].'</td>
				<td><button onclick="javascript:verdetalle('.utf8_encode($registro2['iddocumento']).');" class="btn btn-block btn-primary btn-ls"><i class="glyphicon glyphicon-eye-open"></i> Ver detalle</button></td>
				</tr>';
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>