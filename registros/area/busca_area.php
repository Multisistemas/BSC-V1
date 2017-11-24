<?php
include('../conexion.php');

$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysqli_query($link, "SELECT * FROM area WHERE area LIKE '%$dato%' ORDER BY idarea ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Area</th>
                <th width="50">Opciones</th>
            </tr>';
if(mysqli_num_rows($registro)>0){
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['area'].'</td>
				<td><a href="javascript:editararea('.$registro2['idarea'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminararea('.$registro2['idarea'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>