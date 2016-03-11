<?php
session_start();
$idempresa=$_SESSION['id_empresa'];
$iduser=$_SESSION['id_usu'];
include('../conexion.php');
$idper = $_POST['idpersona'];
$fecha = $_POST['fecha'];
//VERIFICAMOS EL PROCESO

		mysql_query("INSERT INTO documento_venta (idcliente,fecha,idempresa)VALUES('$idper','$fecha','$idempresa')");
		$registro = mysql_query("SELECT max(iddocumento) as maxi FROM documento_venta");
		$registro2 = mysql_fetch_array($registro);
		$iddoc=$registro2['maxi'];
		
		$registro3 = mysql_query("SELECT idproducto,cantidad,precio FROM temporal where idusuario='$iduser'");
						
		while($registro4 = mysql_fetch_array($registro3)){
		$can=$registro4['cantidad'];
		$precio=$registro4['precio'];
		$subtotal=$can*$precio;
		$total=$total+$subtotal;
		$idpro=$registro4['idproducto'];
		mysql_query("insert into detalle_documentoventa(iddocumento,idproducto,cantidad,precio) values('$iddoc','$idpro','$can','$precio')");
		mysql_query("insert into kardex(fecha,idtipod,idtipoo,serie,nrodocumento,idproducto,cantidad,precio,idusuario) values('$fecha','$tip','V','$serie','$nrodoc','$idpro','$can','$precio','$iduser')");
		mysql_query("update producto set stock=stock-'$can' where idproducto='$idpro'");
		}
		mysql_query("update documento_venta set total='$total' where iddocumento='$iddoc'");
		mysql_query("delete from temporal where idusuario='$iduser'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysql_query("select t.idproducto,p.producto,t.cantidad,p.precioventau from temporal t,producto p where t.idproducto=p.idproducto and t.idusuario='$iduser'");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			                <th width="50">Eliminar</th>
							<th width="300">Producto</th>
							<th width="50">Cantidad</th>
							<th width="50">Precio Venta</th>
							<th width="50">Sub Total</th>
						</tr>';
	while($registro2 = mysql_fetch_array($registro)){
	$subtotal=$registro2['cantidad']*$registro2['precioventau'];
		echo '<tr>
							<td><a href="javascript:eliminarproducto('.$registro2['idproducto'].');" class="glyphicon glyphicon-remove-circle"></a></td>
							<td>'.utf8_encode($registro2['producto']).'</td>
							<td>'.$registro2['cantidad'].'</td>
							<td>'.$registro2['precioventau'].'</td>
							<td>'.$subtotal.'</td>
						  </tr>';
		$totalv = $totalv + $subtotal;
	}
echo '<tr><td colspan="4" style="text-align:right;font-weight:bold;">Total</td><td>'.$totalv.'</td></tr>';
echo '</table>';
?>