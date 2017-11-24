<?php
include('../conexion.php');

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysqli_query($link, "DELETE FROM area WHERE idarea = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($link, "SELECT * FROM area ORDER BY idarea ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Area</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['area'].'</td>
				<td><a href="javascript:editararea('.$registro2['idarea'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminararea('.$registro2['idarea'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>