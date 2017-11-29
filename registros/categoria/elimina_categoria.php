<?php
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysqli_query($DB, "DELETE FROM categoria WHERE idcategoria = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($DB, "SELECT * FROM categoria ORDER BY idcategoria ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Categoria</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['categoria'].'</td>
				<td><a href="javascript:editarcategoria('.$registro2['idcategoria'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarcategoria('.$registro2['idcategoria'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>