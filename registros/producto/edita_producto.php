<?php
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($link, "SELECT * FROM producto WHERE idproducto = '$id'");
$valores2 = mysqli_fetch_array($valores);

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