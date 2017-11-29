<?php
	include_once(dirname(__FILE__).'/../../config.php');
	$idempresa=$_SESSION['id_empresa'];
	$idarea=$_SESSION['id_area'];
	$DB = new mysqli('localhost','root','toor','bsc');
	$categorias = array('MES');
	$total = array('TOTAL');

	$consulta = "select stock,categoria from producto p,categoria c where p.idcategoria=c.idcategoria and idempresa='$idempresa' group by categoria";
	$result = $DB->query($consulta);

	while ($fila = $result->fetch_array()) {
		$total[] = (double)$fila['stock'];
		$categorias[] = $fila['categoria'];
	}

	echo json_encode( array($categorias,$total) );

?>
