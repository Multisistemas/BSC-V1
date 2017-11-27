<?php
session_start();
$idempresa=$_SESSION['id_empresa'];
include_once(dirname(__FILE__).'/../../config.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$producto = $_POST['producto'];
$precioc = $_POST['precioc'];
$preciov = $_POST['preciov'];
$preciovu = $_POST['preciovu'];
$stock = $_POST['stock'];
$color = $_POST['color'];
$ref = $_POST['ref'];
$idcategoria = $_POST['idcategoria'];
$idalmacen = $_POST['idalmacen'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
		mysqli_query($link, "INSERT INTO producto (producto,preciocompra,precioventa,precioventau,stock,color,referencia,idcategoria,idalmacen,idempresa)VALUES('$producto','$precioc','$preciov','$preciovu','$stock','$color','$ref','$idcategoria','$idalmacen','$idempresa')");
	break;
	
	case 'Edicion':
		mysqli_query($link, "UPDATE producto SET producto = '$producto', preciocompra='$precioc',precioventa='$preciov',precioventau='$preciovu',stock='$stock',color='$color',referencia='$ref',idcategoria='$idcategoria',idalmacen='$idalmacen' WHERE idproducto = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($link, "SELECT * FROM producto p,categoria c,almacen a where p.idcategoria=c.idcategoria and p.idalmacen=a.idalmacen and p.idempresa='$idempresa' ORDER BY p.idproducto desc limit 15");

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
	while($registro2 = mysqli_fetch_array($registro)){
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