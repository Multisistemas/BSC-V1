<?php
include('../conexion.php');
$id = $_POST['id'];
$proceso = $_POST['pro'];
$tipopersona = $_POST['tipopersona'];
//VERIFICAMOS EL PROCESO

switch($proceso){
	case 'Registro':
	$registro3 = mysqli_query($link, "SELECT tipopersona FROM tipopersona where tipopersona='$tipopersona'");
	$val=mysqli_num_rows($registro3);
	if ($val>0){echo "<script language=�JavaScript�> 
                alert('Tipo Cliente/Proveedor ya existe'); 
                </script>";} else {
		mysqli_query($link, "INSERT INTO tipopersona (tipopersona)VALUES('$tipopersona')");}
	break;
	
	case 'Edicion':
		mysqli_query($link, "UPDATE tipopersona SET tipopersona = '$tipopersona' WHERE idtipopersona = '$id'");
	break;
}


//ACTUALIZAMOS LOS REGISTROS Y LOS OBTENEMOS

$registro = mysqli_query($link, "SELECT * FROM tipopersona ORDER BY idtipopersona ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
            	<th width="300">Tipo Persona</th>
				<th width="50">Opciones</th>
            </tr>';
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
				<td>'.$registro2['tipopersona'].'</td>
				<td><a href="javascript:editartipopersona('.$registro2['idtipopersona'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminartipopersona('.$registro2['idtipopersona'].');" class="glyphicon glyphicon-remove-circle"></a></td>
				</tr>';
	}
echo '</table>';
?>