<?php
	session_start();
	$idempresa=$_SESSION['id_empresa'];
	$idarea=$_SESSION['id_area'];
	$conexion = new mysqli('localhost','root','toor','bsc');
	$categorias = array('MES');
	$total = array('TOTAL');
	
	$consulta = "select stock,categoria from producto p,categoria c where p.idcategoria=c.idcategoria and idempresa='$idempresa' group by categoria";
	$result = $conexion->query($consulta);
	
	while ($fila = $result->fetch_array()) {
		$total[] = (double)$fila['stock'];
		$categorias[] = $fila['categoria'];
	}
	
	echo json_encode( array($categorias,$total) );
	
?>
