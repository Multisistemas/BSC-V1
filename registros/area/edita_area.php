<?php
include('../conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysql_query("SELECT * FROM area WHERE idarea = '$id'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
				0 => $valores2['area'], 
				);
echo json_encode($datos);
?>