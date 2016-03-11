<?php
include('../conexion.php');

$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysql_query("SELECT * FROM tipousuario WHERE tipousuario LIKE '%$dato%' ORDER BY idtipousuario ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Tipo Usuario</th>
                <th width="50">Opciones</th>
            </tr>';
if(mysql_num_rows($registro)>0){
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['tipousuario'].'</td>
				<td><a href="javascript:editartipousuario('.$registro2['idtipousuario'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminartipousuario('.$registro2['idtipousuario'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>