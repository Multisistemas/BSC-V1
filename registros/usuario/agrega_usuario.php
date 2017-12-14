<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa=$_SESSION['id_empresa'];

$id = $_POST['id'];
$proceso = $_POST['pro'];
$login = $_POST['login'];
$dui = $_POST['dui'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$email = $_POST['email'];
$clave = md5($_POST['clave']);
$idtipousuario = $_POST['idtipousuario'];
$idarea = $_POST['idarea'];
$idempresa = $_POST['idempresa'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
		mysqli_query($DB, "INSERT INTO usuario (login,dui,nombres,apellidos,correo,clave,idtipousuario,idarea,idempresa)VALUES('$login','$dui','$nombres','$apellidos','$email','$clave','$idtipousuario','$idarea','$idempresa')");
	break;

	case 'Edicion':
		mysqli_query($DB, "UPDATE usuario SET login='$login',dui='$dui',nombres = '$nombres',apellidos='$apellidos',correo='$email',clave='$clave',idtipousuario='$idtipousuario',idarea='$idarea',idempresa='$idempresa' WHERE idusuario = '$id'");
	break;
}


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
