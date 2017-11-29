<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa = $_SESSION['id_empresa'];

$id = $_POST['id'];
$proceso = $_POST['pro'];
$ruc = $_POST['ruc'];
$rsocial = $_POST['rsocial'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$correo = $_POST['correo'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
		mysqli_query($DB, "INSERT INTO empresa (ruc,razonsocial,direccion,telefono,movil,email)VALUES('$ruc','$rsocial','$direccion','$telefono','$celular','$correo')");
	break;

	case 'Edicion':
		mysqli_query($DB, "UPDATE empresa SET ruc = '$ruc', razonsocial='$rsocial',direccion='$direccion',telefono='$telefono',movil='$celular',email='$correo' WHERE idempresa = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($DB, "SELECT * FROM empresa where idempresa='$idempresa' ORDER BY idempresa ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			                <th width="50">RUC</th>
							<th width="50">Razon Social</th>
							<th width="50">Direcci&oacute;n</th>
							<th width="50">Tel&eacute;fono</th>
							<th width="50">Movil</th>
							<th width="50">Correo</th>
			                <th width="50">Opciones</th>
			            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['ruc'].'</td>
							<td>'.utf8_encode($registro2['razonsocial']).'</td>
							<td>'.utf8_encode($registro2['direccion']).'</td>
							<td>'.$registro2['telefono'].'</td>
							<td>'.$registro2['movil'].'</td>
							<td>'.$registro2['email'].'</td>
							<td><a href="javascript:editarempresa('.$registro2['idempresa'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarempresa('.$registro2['idempresa'].');" class="glyphicon glyphicon-remove-circle"></a></td>
						  </tr>';
	}
echo '</table>';
?>
