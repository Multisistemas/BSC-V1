<?php
include('../conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysql_query("SELECT * FROM objetivos WHERE idobjetivo = '$id'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
				0 => utf8_decode($valores2['nombre']), 
				1 => $valores2['idperspectiva'], 
				2 => $valores2['idarea'], 
				);
echo json_encode($datos);
?>