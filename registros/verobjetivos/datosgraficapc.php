<?php
	session_start();
	$idempresa=$_SESSION['id_empresa'];
	$idarea=$_SESSION['id_area'];
	$conexion = new mysqli('localhost','root','toor','bsc');
	
	$total = array('TOTAL');
	$meses = array('MESES');
	/*$enero = array('ENERO');
	$febrero = array('FEBRERO');
	$marzo = array('MARZO');
	$abril = array('ABRIL');
	$mayo = array('MAYO');
	$junio = array('JUNIO');
	$julio = array('JULIO');
	$agosto = array('AGOSTO');
	$septiembre = array('SEPTIEMBRE');
	$octubre = array('OCTUBRE');
	$noviembre = array('NOVIEMBRE');
	$diciembre = array('DICIEMBRE');*/
	
	$consulta = "select count(*) as cantidad,monthname(fecharegistro) as mes from persona where idtipopersona='1' and idempresa='$idempresa' group by month(fecharegistro)";
	$result = $conexion->query($consulta);
	
	while ($fila = $result->fetch_array()) {
		$total[] = (double)$fila['cantidad'];
		$meses[] = $fila['mes'];
	}
	
/*	$consulta = "SELECT * FROM objetivos where idempresa='$idempresa' and idarea='$idarea' and idperspectiva='4'";
	$result = $conexion->query($consulta);
	while($fila = $result->fetch_array()){
	
		if($fila['mes'] == 'ENERO')
			$enero[] = (double)$fila['total'];
		else if ($fila['mes'] == 'FEBRERO'){
			$febrero[] = (double)$fila['total'];
			$stock[] = $fila
		}
	}
*/
	echo json_encode( array($meses,$total) );
	
?>
