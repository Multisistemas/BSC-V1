<?php
	session_start();
	$idempresa=$_SESSION['id_empresa'];
	$idarea=$_SESSION['id_area'];
	$conexion = new mysqli('localhost','root','','bdbalancedscore');
	$categorias = array('MES');
	$total = array('TOTAL');
	$totalm = array('TOTALM');
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
	
	$consulta = "SELECT categoria,sum(cantidad) as cantidad,month(fecha) as mes FROM documento_venta d,detalle_documentoventa dv , producto p,categoria c where d.iddocumento=dv.iddocumento and p.idcategoria=c.idcategoria and dv.idproducto=p.idproducto and d.idempresa='$idempresa' group by p.idcategoria";
	$result = $conexion->query($consulta);
	
	while ($fila = $result->fetch_array()) {
		$total[] = (double)$fila['cantidad'];
		$categorias[] = $fila['categoria'];
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
	echo json_encode( array($categorias,$total) );
	
?>
