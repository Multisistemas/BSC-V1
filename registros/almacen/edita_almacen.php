<?php
include_once(dirname(__FILE__).'../../config.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($link, "SELECT * FROM almacen WHERE idalmacen = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['almacen'], 
				);
echo json_encode($datos);
?>