<?php
session_start();
$idempresa=$_SESSION['id_empresa'];
include('../conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$login = $_POST['login'];
$dni = $_POST['dni'];
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
		mysql_query("INSERT INTO usuario (login,dni,nombres,apellidos,correo,clave,idtipousuario,idarea,idempresa)VALUES('$login','$dni','$nombres','$apellidos','$email','$clave','$idtipousuario','$idarea','$idempresa')");
	break;
	
	case 'Edicion':
		mysql_query("UPDATE usuario SET login='$login',dni='$dni',nombres = '$nombres',apellidos='$apellidos',correo='$email',clave='$clave',idtipousuario='$idtipousuario',idarea='$idarea',idempresa='$idempresa' WHERE idusuario = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysql_query("SELECT * FROM usuario u,tipousuario tu,area a,empresa e where u.idtipousuario=tu.idtipousuario and u.idarea=a.idarea and u.idempresa=e.idempresa and u.idempresa='$idempresa' ORDER BY idusuario ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			                <th width="50">Login</th>
							<th width="50">DNI</th>
							<th width="50">Nombres</th>
							<th width="50">Apellidos</th>
							<th width="50">Email</th>
							<th width="50">Tipo Usuario</th>
							<th width="50">Area</th>
							<th width="50">Empresa</th>
			                <th width="50">Opciones</th>
			            </tr>';
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
							<td>'.$registro2['login'].'</td>
							<td>'.$registro2['dni'].'</td>
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