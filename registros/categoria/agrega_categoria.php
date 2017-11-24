<?php
include('../conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$categoria = $_POST['categoria'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
	$registro3 = mysqli_query($link, "SELECT categoria FROM categoria where categoria='$categoria'");
	$val=mysqli_num_rows($registro3);
	if ($val>0){echo "<script language=�JavaScript�> 
                alert('Categoria ya existe'); 
                </script>";} else {
		mysqli_query($link, "INSERT INTO categoria (categoria)VALUES('$categoria')");}
	break;
	
	case 'Edicion':
		mysqli_query($link, "UPDATE categoria SET categoria = '$categoria' WHERE idcategoria = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($link, "SELECT * FROM categoria ORDER BY idcategoria ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Categoria</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['categoria'].'</td>
				<td><a href="javascript:editarcategoria('.$registro2['idcategoria'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarcategoria('.$registro2['idcategoria'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>