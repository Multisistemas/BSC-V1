<?php
include('../conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysql_query("SELECT * FROM empresa WHERE idempresa = '$id'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
				0 => $valores2['ruc'], 
				1 => utf8_encode($valores2['razonsocial']), 
				2 => utf8_encode($valores2['direccion']), 
				3 => $valores2['telefono'], 
				4 => $valores2['movil'], 
				5 => $valores2['email'], 
				);
echo json_encode($datos);
?>