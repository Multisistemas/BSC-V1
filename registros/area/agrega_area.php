<?php
include('../conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$area = $_POST['area'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
	$registro3 = mysql_query("SELECT area FROM area where area='$area'");
	$val=mysql_num_rows($registro3);
	if ($val>0){echo "<script language=’JavaScript’> 
                alert('Area ya existe'); 
                </script>";} else {
		mysql_query("INSERT INTO area (area)VALUES('$area')");}
	break;
	
	case 'Edicion':
		mysql_query("UPDATE area SET area = '$area' WHERE idarea = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysql_query("SELECT * FROM area ORDER BY idarea ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Area</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['area'].'</td>
				<td><a href="javascript:editararea('.$registro2['idarea'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminararea('.$registro2['idarea'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>