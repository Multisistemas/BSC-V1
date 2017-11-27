<?php
session_start();
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
$fechar = date('Y-m-d');
$idtipopersona = $_POST['idtipopersona'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
		mysqli_query($link, "INSERT INTO persona (ruc,razonsocial,direccion,telefono,movil,email,fecharegistro,idtipopersona,idempresa)VALUES('$ruc','$rsocial','$direccion','$telefono','$celular','$correo','$fechar','$idtipopersona','$idempresa')");
	break;
	
	case 'Edicion':
		mysqli_query($link, "UPDATE persona SET ruc = '$ruc', razonsocial='$rsocial',direccion='$direccion',telefono='$telefono',movil='$celular',email='$correo',fecharegistro='$fechar',idtipopersona='$idtipopersona',idempresa='$idempresa' WHERE idpersona = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($link, "SELECT * FROM persona p,tipopersona tp where p.idtipopersona=tp.idtipopersona and idempresa='$idempresa' ORDER BY idpersona desc limit 15");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			                <th width="50">RUC</th>
							<th width="50">Razon Social</th>
							<th width="50">Direcci&oacute;n</th>
							<th width="50">Tel&eacute;fono</th>
							<th width="50">Movil</th>
							<th width="50">Correo</th>
							<th width="50">Tipo</th>
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
							<td>'.$registro2['tipopersona'].'</td>
							<td><a href="javascript:editarpersona('.$registro2['idpersona'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarpersona('.$registro2['idpersona'].');" class="glyphicon glyphicon-remove-circle"></a></td>
						  </tr>';
	}
echo '</table>';
?>