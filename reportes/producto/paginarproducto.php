<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa=$_SESSION['id_empresa'];
	$paginaActual = $_POST['partida'];

    $nroProductos = mysqli_num_rows(mysqli_query($DB, "SELECT * FROM producto p,categoria c where p.idcategoria=c.idcategoria and p.idempresa='$idempresa'"));
    $nroLotes = 15;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';

    if($paginaActual > 1){
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual-1).');">Anterior</a></li>';
    }
    for($i=1; $i<=$nroPaginas; $i++){
        if($i == $paginaActual){
            $lista = $lista.'<li class="active"><a href="javascript:pagination('.$i.');">'.$i.'</a></li>';
        }else{
            $lista = $lista.'<li><a href="javascript:pagination('.$i.');">'.$i.'</a></li>';
        }
    }
    if($paginaActual < $nroPaginas){
        $lista = $lista.'<li><a href="javascript:pagination('.($paginaActual+1).');">Siguiente</a></li>';
    }

  	if($paginaActual <= 1){
  		$limit = 0;
  	}else{
  		$limit = $nroLotes*($paginaActual-1);
  	}

  	$registro = mysqli_query($DB, "SELECT * FROM producto p,categoria c where p.idcategoria=c.idcategoria and p.idempresa='$idempresa' LIMIT $limit, $nroLotes ");


  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
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

	while($registro2 = mysqli_fetch_array($registro)){
		$tabla = $tabla.'<tr>
							<td>'.$registro2['producto'].'</td>
							<td>'.$registro2['preciocompra'].'</td>
							<td>'.$registro2['precioventa'].'</td>
							<td>'.$registro2['precioventau'].'</td>
							<td>'.$registro2['stock'].'</td>
							<td>'.$registro2['color'].'</td>
							<td>'.$registro2['referencia'].'</td>
							<td>'.$registro2['categoria'].'</td>
						  </tr>';
	}


    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>
