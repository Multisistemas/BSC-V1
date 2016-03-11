<?php
session_start();
$idempresa=$_SESSION['id_empresa'];
include('../conexion.php');

$id = $_POST['id'];

//ELIMINAMOS EL PRODUCTO

mysql_query("DELETE FROM producto WHERE idproducto = '$id'");

//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysql_query("SELECT * FROM producto p,categoria c,almacen a where p.idcategoria=c.idcategoria and p.idalmacen=a.idalmacen and p.idempresa='$idempresa' ORDER BY p.idproducto desc limit 15");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			                <th width="400">Producto</th>
							<th width="50">Precio Compra</th>
							<th width="50">Precio Venta</th>
							<th width="50">Precio Venta Unidad</th>
							<th width="50">Stock</th>
							<th width="50">Color</th>
							<th width="50">Referencia</th>
							<th width="50">Categoria</th>
							<th width="50">Almacen</th>
			                <th width="50">Opciones</th>
			            </tr>';
	while($registro2 = mysql_fetch_array($registro)){
		echo '<tr>
				<td>'.utf8_encode($registro2['producto']).'</td>
							<td>'.$registro2['preciocompra'].'</td>
							<td>'.$registro2['precioventa'].'</td>
							<td>'.$registro2['precioventau'].'</td>
							<td>'.$registro2['stock'].'</td>
							<td>'.utf8_encode($registro2['color']).'</td>
							<td>'.utf8_encode($registro2['referencia']).'</td>
							<td>'.$registro2['categoria'].'</td>
							<td>'.$registro2['almacen'].'</td>
							<td><a href="javascript:editarproducto('.$registro2['idproducto'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarproducto('.$registro2['idproducto'].');" class="glyphicon glyphicon-remove-circle"></a></td>
						  </tr>';
	}
echo '</table>';
?>