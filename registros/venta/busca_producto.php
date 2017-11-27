<?php
session_start();
$idempresa=$_SESSION['id_empresa'];
include_once(dirname(__FILE__).'/../../config.php');

$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysqli_query($link, "SELECT idproducto,producto FROM producto where idempresa='$idempresa' and producto LIKE '%$dato%' ORDER BY idproducto ASC limit 8");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

//echo '<table class="table table-striped table-condensed table-hover">';
if(mysqli_num_rows($registro)>0){
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<div><a class="suggest-element" data="'.$registro2['producto'].'" id="'.$registro2['idproducto'].'">'.utf8_encode($registro2['producto']).'</a></div>';
	}
}else{
	echo '<div class="suggest-element">
				No se encontraron resultados
			</div>';
}
//echo '</table>';
?>