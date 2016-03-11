<?php
session_start();
$idempresa=$_SESSION['id_empresa'];
include('../conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$objetivos = utf8_decode($_POST['objetivos']);
$idperspectiva = $_POST['idperspectiva'];
$idarea = $_POST['idarea'];
$chkmes = $_POST['chkmes'];
$can = $_POST['can'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
		mysql_query("INSERT INTO objetivos (nombre,idperspectiva,idempresa,idarea)VALUES('$objetivos','$idperspectiva','$idempresa','$idarea')");
		$registro = mysql_query("SELECT max(idobjetivo) as maxi FROM objetivos");
		$registro2 = mysql_fetch_array($registro);
		$idobjetivo=$registro2['maxi'];
		$numreg=count($chkmes);
		for ($i=0;$i<=$numreg-1;$i++){
		mysql_query("insert into detalle_objetivos(idobjetivo,cantidad,mes) values('$idobjetivo','$can[$i]','$chkmes[$i]')");
		}
	break;
	
	case 'Edicion':
		mysql_query("UPDATE objetivos SET nombre = '$objetivos',idperspectiva='$idperspectiva',idempresa='$idempresa',idarea='$idarea' WHERE idobjetivo = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysql_query("SELECT idobjetivo,o.nombre as objetivo,p.nombre as perspectiva,area FROM objetivos o,perspectivas p,area a where o.idperspectiva=p.idperspectiva and o.idarea=a.idarea and idempresa='$idempresa' ORDER BY idobjetivo desc limit 15");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Objetivo</th>
				<th width="100">Perspectiva</th>
				<th width="100">Area</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
				<td>'.utf8_encode($registro2['objetivo']).'</td>
				<td>'.utf8_encode($registro2['perspectiva']).'</td>
				<td>'.utf8_encode($registro2['area']).'</td>
				<td><a href="javascript:editarobjetivos('.$registro2['idobjetivo'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarobjetivos('.$registro2['idobjetivo'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>