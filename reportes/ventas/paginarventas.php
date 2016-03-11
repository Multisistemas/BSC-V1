<?php
session_start();
$idempresa=$_SESSION['id_empresa'];
	include('../conexion.php');
	$paginaActual = $_POST['partida'];

    $nroProductos = mysql_num_rows(mysql_query("SELECT * FROM documento_venta dv,persona p WHERE dv.idcliente=p.idpersona and dv.idempresa='$idempresa'"));
    $nroLotes = 80;
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

  	$registro = mysql_query("SELECT * FROM documento_venta dv,persona p WHERE dv.idcliente=p.idpersona and dv.idempresa='$idempresa' LIMIT $limit, $nroLotes ");


  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			            <tr>
            	<th width="200">Cliente</th>
				<th width="200">Fecha</th>
				<th width="200">Total</th>
				<th width="200">Ver Detalle</th>
            </tr>';
				
	while($registro2 = mysql_fetch_array($registro)){
		$tabla = $tabla.'<tr>
				<td>'.utf8_encode($registro2['razonsocial']).'</td>
				<td>'.$registro2['fecha'].'</td>
				<td>'.$registro2['total'].'</td>
				<td><button onclick="javascript:verdetalle('.utf8_encode($registro2['iddocumento']).');" class="btn btn-block btn-primary btn-ls"><i class="glyphicon glyphicon-eye-open"></i> Ver detalle</button></td>
				</tr>';		
	}
        

    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>