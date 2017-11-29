<?php
session_start();
$iduser=$_SESSION['id_usu'];
include_once(dirname(__FILE__).'/../../config.php');

$id = $_POST['id'];
$preventa = $_POST['pre'];
$x = $_POST['val'];

//ELIMINAMOS EL PRODUCTO

mysqli_query($DB, "UPDATE temporal set precio = '$preventa' WHERE idproducto = '$id' and idusuario='$iduser'");
		
//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($DB, "select t.idproducto,p.producto,t.cantidad,t.precio from temporal t,producto p where t.idproducto=p.idproducto and t.idusuario='$iduser'");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			                <th width="50">Eliminar</th>
							<th width="300">Producto</th>
							<th width="50">Cantidad</th>
							<th width="50">Precio Venta</th>
							<th width="50">Sub Total</th>
						</tr>';
		$x=0;
	while($registro2 = mysqli_fetch_array($registro)){
	$subtotal=$registro2['cantidad']*$registro2['precio'];
		echo '<tr>
				<td><a href="javascript:eliminarproducto('.$registro2['idproducto'].');" class="glyphicon glyphicon-remove-circle"></a></td>
							<td>'.utf8_encode($registro2['producto']).'</td>
							<td>'.$registro2['cantidad'].'</td>
							<td><input type="number" class="col-xs-8" value='.$registro2['precio'].' id="preventa'.$x.'">&nbsp;<a href="javascript:actualizarproducto('.$registro2['idproducto'].','.$x.');" class="glyphicon glyphicon-refresh"></a></td>
							<td>'.$subtotal.'</td>
						  </tr>';
			$total = $total + $subtotal;
			$x=$x+1;
	}
echo '<tr><td colspan="4">Total</td><td>'.$total.'</td></tr>';
echo '</table>';
?>