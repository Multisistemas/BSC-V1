<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa=$_SESSION['id_empresa'];

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysqli_query($DB, "DELETE FROM objetivos WHERE idobjetivo = '$id'");
mysqli_query($DB, "DELETE FROM detalle_objetivos WHERE idobjetivo = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($DB, "SELECT idobjetivo,o.nombre as objetivo,p.nombre as perspectiva,area FROM objetivos o,perspectivas p,area a where o.idperspectiva=p.idperspectiva and o.idarea=a.idarea and idempresa='$idempresa' ORDER BY idobjetivo desc limit 15");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Objetivo</th>
				<th width="100">Perspectiva</th>
				<th width="100">Area</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.utf8_encode($registro2['objetivo']).'</td>
				<td>'.utf8_encode($registro2['perspectiva']).'</td>
				<td>'.utf8_encode($registro2['area']).'</td>
				<td><a href="javascript:editarobjetivos('.$registro2['idobjetivo'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarobjetivos('.$registro2['idobjetivo'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>
