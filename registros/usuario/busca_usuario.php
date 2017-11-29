<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa=$_SESSION['id_empresa'];

$dato = $_POST['dato'];

//EJECUTAMOS LA CONSULTA DE BUSQUEDA

$registro = mysqli_query($DB, "SELECT * FROM usuario u,tipousuario tu,area a,empresa e where u.idtipousuario=tu.idtipousuario and u.idarea=a.idarea and u.idempresa=e.idempresa and u.idempresa='$idempresa' and login like '%$dato%' ORDER BY idusuario ASC");

//CREAMOS NUESTRA VISTA Y LA DEVOLVEMOS AL AJAX

echo '<table class="table table-striped table-condensed table-hover">
        	<tr>
			                <th width="50">Login</th>
							<th width="50">DNI</th>
							<th width="50">Nombres</th>
							<th width="50">Apellidos</th>
							<th width="50">Email</th>
							<th width="50">Tipo Usuario</th>
							<th width="50">Area</th>
							<th width="50">Empresa</th>
			                <th width="50">Opciones</th>
			            </tr>';
if(mysqli_num_rows($registro)>0){
	while($registro2 = mysqli_fetch_array($registro)){
		echo '<tr>
							<td>'.$registro2['login'].'</td>
							<td>'.$registro2['dni'].'</td>
							<td>'.$registro2['nombres'].'</td>
							<td>'.$registro2['apellidos'].'</td>
							<td>'.$registro2['correo'].'</td>
							<td>'.$registro2['tipousuario'].'</td>
							<td>'.$registro2['area'].'</td>
							<td>'.$registro2['razonsocial'].'</td>
				<td><a href="javascript:editarusuario('.$registro2['idusuario'].');" class="glyphicon glyphicon-edit"></a> <a href="javascript:eliminarusuario('.$registro2['idusuario'].');" class="glyphicon glyphicon-remove-circle"></a></td>
						  </tr>';
	}
}else{
	echo '<tr>
				<td colspan="6">No se encontraron resultados</td>
			</tr>';
}
echo '</table>';
?>
