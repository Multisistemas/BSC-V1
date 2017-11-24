<?php
$conexion = $link = mysqli_connect('localhost', 'root', 'toor');
mysqli_select_db($conexion, 'bsc');

function fechaNormal($fecha){
		$nfecha = date('d/m/Y',strtotime($fecha));
		return $nfecha;
}
?>