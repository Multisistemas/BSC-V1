<?php
	include_once(dirname(__FILE__).'/../../config.php');
	$idempresa=$_SESSION['id_empresa'];
	$idarea=$_SESSION['id_area'];
	$DB = new mysqli('localhost','root','toor','bsc');

	$total = array('TOTAL');
	$area = array('MESES');
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
	$diciembre = array('DICIEMBRE');SET lc_time_names = 'es_UY';*/


	$consulta ="select count(idasistencia) as cantidad,area from asistencia asi,area a,usuario u where u.idusuario=asi.idusuario and u.idarea=a.idarea and asi.opcion='1' and idempresa='$idempresa' group by area";
	$result = $DB->query($consulta);

	while ($fila = $result->fetch_array()) {
		$total[] = (double)$fila['cantidad'];
		$area[] = $fila['area'];
	}

/*	$consulta = "SELECT * FROM objetivos where idempresa='$idempresa' and idarea='$idarea' and idperspectiva='4'";
	$result = $DB->query($consulta);
	while($fila = $result->fetch_array()){

		if($fila['mes'] == 'ENERO')
			$enero[] = (double)$fila['total'];
		else if ($fila['mes'] == 'FEBRERO'){
			$febrero[] = (double)$fila['total'];
			$stock[] = $fila
		}
	}
*/
	echo json_encode( array($area,$total) );

?>
