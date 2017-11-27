<?php
include_once(dirname(__FILE__).'/../../config.php');

$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysqli_query($link, "SELECT * FROM tipopersona WHERE tipopersona LIKE '%$dato%' ORDER BY idtipopersona ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Tipo Persona</th>
                <th width="50">Opciones</th>
            </tr>';
if(mysqli_num_rows($registro)>0){
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['tipopersona'].'</td>
				<td><a href="javascript:editartipopersona('.$registro2['idtipopersona'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminartipopersona('.$registro2['idtipopersona'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>