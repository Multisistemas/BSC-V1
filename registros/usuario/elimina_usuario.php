<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa=$_SESSION['id_empresa'];

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysqli_query($DB, "DELETE FROM usuario WHERE idusuario = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($DB, "SELECT * FROM usuario u,tipousuario tu,area a,empresa e where u.idtipousuario=tu.idtipousuario and u.idarea=a.idarea and u.idempresa=e.idempresa and u.idempresa='$idempresa' ORDER BY idusuario ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			                <th width="50">Login</th>
							<th width="50">DUI</th>
							<th width="50">Nombres</th>
							<th width="50">Apellidos</th>
							<th width="50">Email</th>
							<th width="50">Tipo Usuario</th>
							<th width="50">Area</th>
							<th width="50">Empresa</th>
			                <th width="50">Opciones</th>
			            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
							<td>'.$registro2['login'].'</td>
							<td>'.$registro2['dui'].'</td>
							<td>'.$registro2['nombres'].'</td>
							<td>'.$registro2['apellidos'].'</td>
							<td>'.$registro2['correo'].'</td>
							<td>'.$registro2['tipousuario'].'</td>
							<td>'.$registro2['area'].'</td>
							<td>'.$registro2['razonsocial'].'</td>
				<td><a href="javascript:editarusuario('.$registro2['idusuario'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarusuario('.$registro2['idusuario'].');" class="glyphicon glyphicon-remove-circle"></a></td>
						  </tr>';
	}
echo '</table>';
?>
