<?php
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($DB, "SELECT k.fecha,k.serie,k.nrodocumento,k.cantidad,k.idtipod,k.idtipoo FROM kardex k WHERE idproducto='$id' ORDER BY fecha,idkardex");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
	<td><b>FECHA</b></td>
	<td><b>SERIE</b></td>
	<td><b>N&Uacute;MERO</b></td>
	<td><b>TIPO DE OPERACI&Oacute;N</b></td>
	<td><b>ENTRADAS</b></td>
	<td><b>SALIDAS</b></td>
	<td><b>SALDO FINAL</b></td>
	</tr>';
	while($registro2 = mysqli_fetch_array($registro)){
	$fecha = $registro2['fecha'];
	$tipod = $registro2['idtipod'];
	$serie = $registro2['serie'];
	$nrodoc = $registro2['nrodocumento'];
	$codo = $registro2['idtipoo'];
	$cant = $registro2['cantidad'];
	if ($codo=='C'){
	$saldo= $saldo+$cant;
	$codo2="Compra";}
	else
	{$saldo= $saldo-$cant;
	$codo2="Venta - Salida";}
		echo '<tr><td align=center>'.$fecha.'</td>
	<td align=center>'.$serie.'</td>
	<td align=center>'.$nrodoc.'</td>
	<td align=center>'.$codo2.'</td>
	<td align=center>';if($codo=='C') {echo $cant;} echo '</td>
	<td align=center>';if($codo=='V') {echo $cant;} echo '</td>
	<td align=center>'.$saldo.'</td>
				</tr>';
	}
echo '</table>';
?>