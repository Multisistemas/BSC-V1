<?php
include('../conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($link, "SELECT * FROM persona WHERE idpersona = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['ruc'], 
				1 => $valores2['razonsocial'], 
				2 => $valores2['direccion'], 
				3 => $valores2['telefono'], 
				4 => $valores2['movil'], 
				5 => $valores2['email'], 
				6 => $valores2['idtipopersona'], 
				);
echo json_encode($datos);
?>