<?php
  	include("registros/Function.php");
	$iduser=$_REQUEST["iduser"];
		$clave=$_REQUEST["txtreset"];
		$user=$_REQUEST["txtuser"];
		if ($clave!=""){
		$link=OpenConexion();
		$con=md5($clave);
		$sqli="update usuario set clave='".$con."' where idusuario='".$user."'";
		mysql_query($sqli,$link);
		echo "<META http-equiv='refresh' content='0; url=index.php'>";
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
<title>.:. SISTEMA DE RECUPERACION DE CONTRASEÑA.:.</title>
</head>
<body onLoad="inicio()">
<p>&nbsp;</p>
<form name="form1" id="form1" method="post" action="reset.php">
  <table width="688" border="0" align="center" class="tab-content table-striped">
  <tr>
  </tr>
  <tr>
  <td class="estilocpanel" align="center"><p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2" class='intproh1' align="center"><h2>Usuario registrado ingrese nueva contraseña</h2></td>
  </tr>
  <tr>
    <td height="21">&nbsp;</td>
  </tr>
      <tr>
        <td>
        <table width="582" height="148" align="center">
<tr>
            <td width="59" height="38" class='pinstabtdit'><label>Ingrese Nueva Contraseña:</label></td>
              <td width="210"><input name="txtreset" id="txtreset" type="password"  class="form-control" /></td>
              <td width="297" rowspan="5"><img src="images/foto-login.jpg" width="318" height="199" /></td>
			  <input type="hidden" name="txtuser" value="<?php echo "$iduser";?>" />
          </tr>
            <tr>
              <td height="24"><input name="Submit" type="submit" class="btn btn-info" value="Resetear"/></td>
              <td>&nbsp;</td>
            </tr>
              <tr>
              <td height="26">&nbsp;</td>
              <td>&nbsp;</td>
              </tr>
              <tr>
              <td>&nbsp;</td>
              <td></td>
              </tr>
              <tr>
              <td height="24">&nbsp;</td>
              <td>&nbsp;</td>
          </tr>
        </table>
          <div align="left"></div>
        </td>
          <TD width="0"></TD>
    </tr>
      <tr>
        <td><div align="center"></div></td>
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