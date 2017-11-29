<?php
  	include("registros/Function.php");
		$dni=$_REQUEST["txtdni"];
		if ($dni!=""){
		$DB=OpenConexion();
		$sql="SELECT * FROM usuario WHERE dni='".$dni."'";
		$rs=mysqli_query($DB, $sql);
		$fila =mysqli_fetch_object($rs);
		$id = $fila->idusuario;
		if ($id!=""){
		$fecha=date("Y-m-d h:m");
		$tipo=$_REQUEST["tipo"];
		$opc=$_REQUEST["opc"];
		$sqli="insert into asistencia(fecha,tipo,opcion,idusuario) values('".$fecha."','".$tipo."','".$opc."','".$id."')";
		mysqli_query($DB, $sqli);
		echo "<META http-equiv='refresh' content='0; url=index.php'>";	
		}
		else
		{
		$msg="El DNI ingresado no se encuentra registrado";
		echo "<META http-equiv='refresh' content='5; url=index.php'>";
		}
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
<title>.:. Registro de Asistencia de Personal.:.</title>
</head>
<body onLoad="inicio()">
<p>&nbsp;</p>
<form name="form1" id="form1" method="post" action="registrarasistencia.php">
  <table width="688" border="0" align="center">
  <tr>
  </tr>
  <tr>
  <td class="estilocpanel" align="center"><p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><h2>Registro de Asistencia de Personal <?php echo date("Y-m-d");?></h2></td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
  </tr>
      <tr>
        <td>
        <table width="582" height="148" align="center" class="tab-content table-striped">
<tr>
            <td width="59" height="38" class='pinstabtdit'><label>Ingrese DNI:</label></td>
              <td width="350"><input name="txtdni" id="txtdni" type="text"  class="form-control"required=""/></td>
              <td width="297" rowspan="5"><img src="images/foto-login.jpg" width="318" height="199" /></td>
          </tr>
		  <tr>
            <td width="209"class='pinstabtdit'><input type="radio" name="tipo" class="pinstabtdit" value="I"/><label>Ingreso</label></td>
              <td width="209" class='pinstabtdit'><input type="radio" name="tipo" class="pinstabtdit" value="S"/><label>Salida</label></td>
			  
          </tr>
		  <tr>
            <td width="59" height="38" class='pinstabtdit' colspan="2"><input type="checkbox" name="opc" class="pinstabtdit" value="1"/><label>Marcar como capacitaciones</label></td>
          </tr>
            <tr>
              <td height="24"><input name="Submit" type="submit" class="btn btn-info" value="Marcar"/></td>
              <td>&nbsp;</td>
            </tr>
              <tr>
              <td height="26">&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
              <tr>
              <td colspan="2" class="pinstabtdit"><?php echo "$msg";?></td>
             
              </tr>
              <tr>
              <td height="24">&nbsp;</td>
              <td>&nbsp;</td>
          </tr>
        </table>
         
        </td>
          <TD width="0"></TD>
    </tr>
      <tr>
        <td></td>
        <TD></TD>
      </tr>
      <tr>
        <td height="21">&nbsp;</td>
      </tr>
  </table>
  </td>
  </tr>
</table>
</form>
</body>
</html>