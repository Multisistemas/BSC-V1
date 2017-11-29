<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa=$_SESSION['id_empresa'];

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysqli_query($DB, "DELETE FROM persona WHERE idpersona = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($DB, "SELECT * FROM persona p,tipopersona tp where p.idtipopersona=tp.idtipopersona and idempresa='$idempresa' ORDER BY idempresa desc limit 15");

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
