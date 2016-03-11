<?php
include('../conexion.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysql_query("SELECT * FROM producto WHERE idproducto = '$id'");
$valores2 = mysql_fetch_array($valores);

$datos = array(
				0 => $valores2['producto'], 
				1 => $valores2['preciocompra'], 
				2 => $valores2['precioventa'], 
				3 => $valores2['precioventau'], 
				4 => $valores2['stock'], 
				5 => $valores2['color'], 
				6 => $valores2['referencia'], 
				7 => $valores2['idcategoria'], 
				8 => $valores2['idalmacen'], 
				);
echo json_encode($datos);
?>