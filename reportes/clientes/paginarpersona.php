<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa = $_SESSION['id_empresa'];

	$paginaActual = $_POST['partida'];

    $nroProductos = mysqli_num_rows(mysqli_query($DB, "SELECT * FROM persona where idtipopersona='1' and idempresa='$idempresa'"));
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

  	$registro = mysqli_query($DB, "SELECT * FROM persona where idtipopersona='1' and idempresa='$idempresa' LIMIT $limit, $nroLotes ");


  	$tabla = $tabla.'<table class="table table-striped table-condensed table-hover">
			            <tr>
			                <th width="50">RUC</th>
							<th width="50">Razon Social</th>
							<th width="50">Direcci&oacute;n</th>
							<th width="50">Tel&eacute;fono</th>
							<th width="50">Movil</th>
							<th width="50">Correo</th>
			            </tr>';

	while($registro2 = mysqli_fetch_array($registro)){
		$tabla = $tabla.'<tr>
							<td>'.$registro2['ruc'].'</td>
							<td>'.$registro2['razonsocial'].'</td>
							<td>'.$registro2['direccion'].'</td>
							<td>'.$registro2['telefono'].'</td>
							<td>'.$registro2['movil'].'</td>
							<td>'.$registro2['email'].'</td>
						  </tr>';
	}


    $tabla = $tabla.'</table>';



    $array = array(0 => $tabla,
    			   1 => $lista);

    echo json_encode($array);
?>
