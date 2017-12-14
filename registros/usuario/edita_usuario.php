<?php
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($DB, "SELECT * FROM usuario WHERE idusuario = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => (isset($valores2['login']) ? $valores2['login'] : ''), 
				1 => (isset($valores2['dui']) ? $valores2['dui'] : ''), 
				2 => (isset($valores2['nombres']) ? $valores2['nombres'] : ''), 
				3 => (isset($valores2['apellidos']) ? $valores2['apellidos'] : ''), 
				4 => (isset($valores2['correo']) ? $valores2['correo'] : ''), 
				5 => (isset($valores2['clave']) ? $valores2['clave'] : ''), 
				6 => (isset($valores2['idtipousuario']) ? $valores2['idtipousuario'] : ''), 
				7 => (isset($valores2['idarea']) ? $valores2['idarea'] : ''), 
				8 => (isset($valores2['idempresa']) ? $valores2['idempresa'] : ''), 
				);
echo json_encode($datos);
?>