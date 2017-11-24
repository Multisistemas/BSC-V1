<?php
$conexion = mysqli_connect('localhost', 'root', 'toor');
mysqli_select_db('bsc', $conexion);

function fechaNormal($fecha){
		$nfecha = date('d/m/Y',strtotime($fecha));
		return $nfecha;
}
?>
