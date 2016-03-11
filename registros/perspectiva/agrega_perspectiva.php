<?php
include('../conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$perspectiva = $_POST['perspectiva'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
	$registro3 = mysql_query("SELECT nombre FROM perspectivas where nombre='$perspectiva'");
	$val=mysql_num_rows($registro3);
	if ($val>0){echo "<script language=’JavaScript’> 
                alert('Perspectiva ya existe'); 
                </script>";} else {
		mysql_query("INSERT INTO perspectivas (nombre)VALUES('$perspectiva')");}
	break;
	
	case 'Edicion':
		mysql_query("UPDATE perspectivas SET nombre = '$perspectiva' WHERE idperspectiva = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysql_query("SELECT * FROM perspectivas ORDER BY idperspectiva ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Perspectiva</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
				<td>'.utf8_encode($registro2['nombre']).'</td>
				<td><a href="javascript:editarperspectiva('.$registro2['idperspectiva'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarperspectiva('.$registro2['idperspectiva'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>