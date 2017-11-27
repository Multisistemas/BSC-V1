<?php
	global $CFG;
	$conexion = $link = mysqli_connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass);
	mysqli_select_db($conexion, $CFG->dbname);

	function fechaNormal($fecha){
		$nfecha = date('d/m/Y',strtotime($fecha));
		return $nfecha;
	}
?>