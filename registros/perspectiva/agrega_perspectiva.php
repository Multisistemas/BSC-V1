<?php
include('../conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$perspectiva = $_POST['perspectiva'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
	$registro3 = mysqli_query($link, "SELECT nombre FROM perspectivas where nombre='$perspectiva'");
	$val=mysqli_num_rows($registro3);
	if ($val>0){echo "<script language=�JavaScript�> 
                alert('Perspectiva ya existe'); 
                </script>";} else {
		mysqli_query($link, "INSERT INTO perspectivas (nombre)VALUES('$perspectiva')");}
	break;
	
	case 'Edicion':
		mysqli_query($link, "UPDATE perspectivas SET nombre = '$perspectiva' WHERE idperspectiva = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($link, "SELECT * FROM perspectivas ORDER BY idperspectiva ASC");

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