<?php
include('../conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysql_query("SELECT * FROM tipousuario WHERE idtipousuario = '$id'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
				0 => $valores2['tipousuario'], 
				);
echo json_encode($datos);
?>