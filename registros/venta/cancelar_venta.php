<?php
session_start();
$iduser=$_SESSION['id_usu'];
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysqli_query($link, "DELETE FROM temporal WHERE idusuario = '$iduser'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($link, "select t.idproducto,p.producto,t.cantidad,p.precioventau from temporal t,producto p where t.idproducto=p.idproducto and t.idusuario='$iduser'");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			                <th width="50">Eliminar</th>
							<th width="300">Producto</th>
							<th width="50">Cantidad</th>
							<th width="50">Precio Venta</th>
							<th width="50">Sub Total</th>
						</tr>';
	while($registro2 = mysqli_fetch_array($registro)){
	$subtotal=$registro2['cantidad']*$registro2['precioventau'];
		echo '<tr>
				<td><a href="javascript:eliminarproducto('.$registro2['idproducto'].');" class="glyphicon glyphicon-remove-circle"></a></td>
							<td>'.utf8_encode($registro2['producto']).'</td>
							<td>'.$registro2['cantidad'].'</td>
							<td>'.$registro2['precioventau'].'</td>
							<td>'.$subtotal.'</td>
						  </tr>';
			$total = $total + $subtotal;
	}
echo '<tr><td colspan="4">Total</td><td>'.$total.'</td></tr>';
echo '</table>';
?>