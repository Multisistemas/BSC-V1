<?php
include('../conexion.php');
$id = $_POST['idu'];
$nombre = $_POST['nombrep'];
$apellidos = $_POST['apellidosp'];
$email = $_POST['emailp'];
$clave = md5($_POST['clavep']);
$login = $_POST['loginp'];

		mysql_query("UPDATE usuario SET nombres = '$nombre',apellidos = '$apellidos',correo='$email',clave='$clave',login='$login' WHERE idusuario = '$id'");
?>