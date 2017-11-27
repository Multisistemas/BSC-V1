<?php
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($link, "SELECT * FROM usuario WHERE idusuario = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['login'], 
				1 => $valores2['dni'], 
				2 => $valores2['nombres'], 
				3 => $valores2['apellidos'], 
				4 => $valores2['correo'], 
				5 => $valores2['claves'], 
				6 => $valores2['idtipousuario'], 
				7 => $valores2['idarea'], 
				8 => $valores2['idempresa'], 
				);
echo json_encode($datos);
?>