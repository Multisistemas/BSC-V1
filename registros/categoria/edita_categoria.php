<?php
include('../conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysql_query("SELECT * FROM categoria WHERE idcategoria = '$id'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
				0 => $valores2['categoria'], 
				);
echo json_encode($datos);
?>