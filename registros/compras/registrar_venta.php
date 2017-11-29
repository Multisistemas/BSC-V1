<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa=$_SESSION['id_empresa'];
$iduser=$_SESSION['id_usu'];

$idper = $_POST['idpersona'];
$fecha = $_POST['fecha'];
//VERIFICAMOS EL PROCESO

		mysqli_query($DB, "INSERT INTO documento_compra (idproveedor,fecha,idempresa)VALUES('$idper','$fecha','$idempresa')");
		$registro = mysqli_query($DB, "SELECT max(iddocumento) as maxi FROM documento_compra");
		$registro2 = mysqli_fetch_array($registro);
		$iddoc=$registro2['maxi'];

		$registro3 = mysqli_query($DB, "SELECT idproducto,cantidad,precio FROM temporal where idusuario='$iduser'");

		while($registro4 = mysqli_fetch_array($registro3)){
		$can=$registro4['cantidad'];
		$precio=$registro4['precio'];
		$subtotal=$can*$precio;
		$total=$total+$subtotal;
		$idpro=$registro4['idproducto'];
		mysqli_query($DB, "insert into detalle_documentocompra(iddocumento,idproducto,cantidad,precio) values('$iddoc','$idpro','$can','$precio')");
		mysqli_query($DB, "insert into kardex(fecha,idtipod,idtipoo,serie,nrodocumento,idproducto,cantidad,precio,idusuario) values('$fecha','$tip','C','$serie','$nrodoc','$idpro','$can','$precio','$iduser')");
		mysqli_query($DB, "update producto set stock=stock+'$can' where idproducto='$idpro'");
		}
		mysqli_query($DB, "update documento_compra set total='$total' where iddocumento='$iddoc'");
		mysqli_query($DB, "delete from temporal where idusuario='$iduser'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($DB, "select t.idproducto,p.producto,t.cantidad,p.preciocompra from temporal t,producto p where t.idproducto=p.idproducto and t.idusuario='$iduser'");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			                <th width="50">Eliminar</th>
							<th width="300">Producto</th>
							<th width="50">Cantidad</th>
							<th width="50">Precio Compra</th>
							<th width="50">Sub Total</th>
						</tr>';
	while($registro2 = mysqli_fetch_array($registro)){
	$subtotal=$registro2['cantidad']*$registro2['precioventa'];
		echo '<tr>
							<td><a href="javascript:eliminarproducto('.$registro2['idproducto'].');" class="glyphicon glyphicon-remove-circle"></a></td>
							<td>'.utf8_encode($registro2['producto']).'</td>
							<td>'.$registro2['cantidad'].'</td>
							<td>'.$registro2['preciocompra'].'</td>
							<td>'.$subtotal.'</td>
						  </tr>';
		$totalv = $totalv + $subtotal;
	}
echo '<tr><td colspan="4" style="text-align:right;font-weight:bold;">Total</td><td>'.$totalv.'</td></tr>';
echo '</table>';
?>
