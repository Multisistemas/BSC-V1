<?php
include('../conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$almacen = $_POST['almacen'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
	$registro3 = mysql_query("SELECT almacen FROM almacen where almacen='$almacen'");
	$val=mysql_num_rows($registro3);
	if ($val>0){echo "<script language=’JavaScript’> 
                alert('Almacen ya existe'); 
                </script>";} else {
		mysql_query("INSERT INTO almacen (almacen)VALUES('$almacen')");}
	break;
	
	case 'Edicion':
		mysql_query("UPDATE almacen SET almacen = '$almacen' WHERE idalmacen = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysql_query("SELECT * FROM almacen ORDER BY idalmacen ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Almacen</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['almacen'].'</td>
				<td><a href="javascript:editaralmacen('.$registro2['idalmacen'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminaralmacen('.$registro2['idalmacen'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>