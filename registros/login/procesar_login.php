<?php
include_once('../../config.php');
global $DB;
//debug_to_console($DB);
if(isset($_POST['usu'])) $usu = addslashes($_POST['usu']);
if(isset($_POST['pass'])) $pass = addslashes($_POST['pass']);
if(isset($_POST['area'])) $area = addslashes($_POST['area']);
if(isset($_POST['email'])) $email = addslashes($_POST['email']);

if(isset($email) && !empty($email)) {
	$usuario = mysqli_query($DB, "SELECT * FROM usuario WHERE correo = '$email'");
	$method = 'oauth';
} else {
	$usuario = mysqli_query($DB, "SELECT * FROM usuario WHERE login = '$usu'");
	$method = 'manual';
}
if(mysqli_num_rows($usuario)<1){
	echo 'usuario';
	var_dump(json_encode($DB));
} else {
	$row = mysqli_fetch_array($usuario);

	switch($method) {
		case 'manual':
			if($area != $row['idarea']){
				echo 'area';
			}else{
				if(md5($pass) != $row['pass']){
					echo 'password';
				}else{
					
					$_SESSION['id_usu'] = $row['idusuario'];
					$_SESSION['id_area'] = $row['idarea'];
					$_SESSION['id_empresa'] = $row['idempresa'];

					switch($row['idarea']){
						case 5:
							echo 'ventas';
						break;
						case 3:
							echo 'ventas';
						break;
						case 4:
							echo 'ventas';
						break;
						case 2:
							echo 'almacen';
						break;
					}
				}
			}			
		break;
		case 'oauth':
			$_SESSION['id_usu'] = $row['idusuario'];
			$_SESSION['id_area'] = $row['idarea'];
			$_SESSION['id_empresa'] = $row['idempresa'];
			switch($row['idarea']){
				case 5:
					echo 'ventas';
				break;
				case 3:
					echo 'ventas';
				break;
				case 4:
					echo 'ventas';
				break;
				case 2:
					echo 'almacen';
				break;
			}			
		break;
	}

}
?>
