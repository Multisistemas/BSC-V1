<?php
include('../conexion.php');

$id = $_POST['id'];

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysql_query("SELECT * FROM detalle_documentocompra dv,producto p where dv.idproducto=p.idproducto and iddocumento='$id'");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Producto</th>
				<th width="50">Color</th>
				<th width="50">Cantidad</th>
				<th width="50">Precio</th>
				<th width="100">Sub Total</th>
            </tr>';
	while($registro2 = mysql_fetch_array($registro)){
	$subtotal=$registro2['cantidad']*$registro2['precio'];
	$total=$total+$subtotal;
		echo '<tr>
				<td>'.utf8_encode($registro2['producto']).'</td>
				<td>'.$registro2['color'].'</td>
				<td>'.$registro2['cantidad'].'</td>
				<td>'.$registro2['precio'].'</td>
				<td>'.$subtotal.'</td>
				</tr>';
	}
echo '<tr><td colspan=4 style="text-align:right; font-weight:bold;">Total</td><td style="font-weight:bold;">S/. '.$total.'</td></tr>';
echo '</table>';
?>