<?php
include_once(dirname(__FILE__).'/../../config.php');
$iduser=$_SESSION['id_usu'];

$idpro = $_POST['idpro'];
$can = $_POST['can'];
//VERIFICAMOS EL PROCESO

		mysqli_query($DB, "INSERT INTO temporal (idproducto,idusuario,cantidad)VALUES('$idpro','$iduser','$can')");
$registrop = mysqli_query($DB, "select precioventa from producto where idproducto='$idpro'");
$arrayp=mysqli_fetch_array($registrop);
$precio=$arrayp['precioventa'];
		mysqli_query($DB, "UPDATE temporal set precio='$precio' where idproducto='$idpro' and idusuario='$iduser'");

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
echo '<tr><td colspan="4" style="text-align:right;font-weight:bold;">Total</td><td>'.$total.'</td></tr>';
echo '</table>';
?>
