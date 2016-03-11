<?php
include('../conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$tipou = $_POST['tipou'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
	$registro3 = mysql_query("SELECT tipousuario FROM tipousuario where tipousuario='$tipou'");
	$val=mysql_num_rows($registro3);
	if ($val>0){echo "<script language=’JavaScript’> 
                alert('Tipo de Usuario ya existe'); 
                </script>";} else {
		mysql_query("INSERT INTO tipousuario (tipousuario)VALUES('$tipou')");}
	break;
	
	case 'Edicion':
		mysql_query("UPDATE tipousuario SET tipousuario = '$tipou' WHERE idtipousuario = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysql_query("SELECT * FROM tipousuario ORDER BY idtipousuario ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Tipo Usuario</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['tipousuario'].'</td>
				<td><a href="javascript:editartipousuario('.$registro2['idtipousuario'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminartipousuario('.$registro2['idtipousuario'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>