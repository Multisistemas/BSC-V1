<?php
include('../conexion.php');

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysqli_query($link, "DELETE FROM tipopersona WHERE idtipopersona = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($link, "SELECT * FROM tipopersona ORDER BY idtipopersona ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Tipo Persona</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['tipopersona'].'</td>
				<td><a href="javascript:editartipopersona('.$registro2['idtipopersona'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminartipopersona('.$registro2['idtipopersona'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>