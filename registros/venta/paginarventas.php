<?php
session_start();
$iduser=$_SESSION['id_usu'];
	include('../conexion.php');
	$paginaActual = $_POST['partida'];

    $nroProductos = mysql_num_rows(mysql_query("select t.idproducto,p.producto,t.cantidad,p.precioventau from temporal t,producto p where t.idproducto=p.idproducto and t.idusuario='$iduser'"));
    $nroLotes = 10;
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

  	$registro = mysql_query("select t.idproducto,p.producto,t.cantidad,t.precio from temporal t,producto p where t.idproducto=p.idproducto and t.idusuario='$iduser' LIMIT $limit, $nroLotes ");


  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			            <tr>
			                <th width="50">Eliminar</th>
							<th width="300">Producto</th>
							<th width="50">Cantidad</th>
							<th width="50">Precio Venta</th>
							<th width="50">Sub Total</th>
						</tr>';
		$x=0;		
	while($registro2 = mysql_fetch_array($registro)){
		$subtotal=$registro2['cantidad']*$registro2['precio'];
		$tabla = $tabla.'<tr>
							<td><a href="javascript:eliminarproducto('.$registro2['idproducto'].');" class="glyphicon glyphicon-remove-circle"></a></td>
							<td>'.utf8_encode($registro2['producto']).'</td>
							<td>'.$registro2['cantidad'].'</td>
							<td><input type="number" class="col-xs-8" value='.$registro2['precio'].' id="preventa'.$x.'">&nbsp;<a href="javascript:actualizarproducto('.$registro2['idproducto'].','.$x.');" class="glyphicon glyphicon-refresh"></a></td>
							<td>'.$subtotal.'</td>
						  </tr>';
		$total = $total + $subtotal;
		$x=$x+1;
	}
    $tabla = $tabla.'<tr><td colspan="4" style="text-align:right;font-weight:bold;">Total</td><td style="text-align:center;font-weight:bold;color:red;">'.$total.'</td></tr>';

    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>