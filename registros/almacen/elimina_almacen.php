<?php
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysqli_query($link, "DELETE FROM almacen WHERE idalmacen = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($link, "SELECT * FROM almacen ORDER BY idalmacen ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Almacen</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['almacen'].'</td>
				<td><a href="javascript:editaralmacen('.$registro2['idalmacen'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminaralmacen('.$registro2['idalmacen'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>