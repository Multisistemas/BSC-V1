<?php
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($DB, "SELECT * FROM categoria WHERE idcategoria = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['categoria'], 
				);
echo json_encode($datos);
?>