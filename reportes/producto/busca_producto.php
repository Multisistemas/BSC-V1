<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa=$_SESSION['id_empresa'];

$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysqli_query($DB, "SELECT * FROM producto p,categoria c where p.idcategoria=c.idcategoria and p.idempresa='$idempresa' and producto LIKE '%$dato%' ORDER BY p.idproducto ASC limit 15");

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
			            </tr>';
if(mysqli_num_rows($registro)>0){
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
						  </tr>';
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>
