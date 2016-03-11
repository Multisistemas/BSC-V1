<?php
session_start();
include('../conexion.php');
$usu = addslashes($_POST['usu']);
$pass = addslashes($_POST['pass']);
$area = addslashes($_POST['area']);

$usuario = mysql_query("SELECT * FROM usuario WHERE login = '$usu'");
if(mysql_num_rows($usuario)<1){
	echo 'usuario';
}else{
	$area = mysql_query("SELECT * FROM usuario WHERE login = '$usu' AND idarea = '$area'");
	if(mysql_num_rows($area)<1){
		echo 'area';
	}else{
		$consulta = mysql_query("SELECT * FROM usuario WHERE login = '$usu' AND clave = '".md5($pass)."'");
		if(mysql_num_rows($consulta)<1){
			echo 'password';
		}else{
			$consulta2 = mysql_fetch_array($consulta);
			$_SESSION['id_usu'] = $consulta2['idusuario'];
			$_SESSION['id_area'] = $consulta2['idarea'];
			$_SESSION['id_empresa'] = $consulta2['idempresa'];
			switch($consulta2['idarea']){
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
}
?>
