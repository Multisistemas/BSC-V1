<?php
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysqli_query($DB, "DELETE FROM perspectivas WHERE idperspectiva = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($DB, "SELECT * FROM perspectivas ORDER BY idperspectiva ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Perspectiva</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.utf8_encode($registro2['nombre']).'</td>
				<td><a href="javascript:editarperspectiva('.$registro2['idperspectiva'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarperspectiva('.$registro2['idperspectiva'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>