<?php
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];

//OBTENEMOS LOS VALORES DEL PRODUCTO

$valores = mysqli_query($link, "SELECT * FROM tipopersona WHERE idtipopersona = '$id'");
$valores2 = mysqli_fetch_array($valores);

$datos = array(
				0 => $valores2['tipopersona'], 
				);
echo json_encode($datos);
?>