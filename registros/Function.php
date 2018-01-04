<?php
include_once(dirname(__FILE__).'../../config.php');
global $CFG, $DB, $DB;

function OpenConexion(){
	global $CFG;
	$DB=mysqli_connect($CFG->dbhost, $CFG->dbuser, $CFG->dbpass) or die("Error de conexion al servidor");
	$db=mysqli_select_db($DB, $CFG->dbname) or die("Error de conexion a la BD");
	return $DB;
}

function CloseConexion(){
	global $DB;
	mysqli_close($DB);
}

function autogeneradolote($tabla,$campocodigo,$numcaracteres){
Global $DB;
	$numcaracteres=$numcaracteres*(-1);
	$rsTabla=mysqli_query($DB, "select count($campocodigo) from $tabla");
	$ATabla=mysqli_fetch_array($rsTabla);
	$nreg=$ATabla[0];
	if($nreg>0)	{
		$rsTabla=mysqli_query($DB, "select $campocodigo from $tabla");
		mysqli_data_seek($rsTabla,$nreg-1);
		$ATabla=mysqli_fetch_array($rsTabla);
	}
	$cod=$ATabla[0]+50;
	$cod="00000000000000".$cod;
	$generado=substr($cod,$numcaracteres);
	mysqli_free_result($rsTabla);
	return $generado;
}

function autogenerado($tabla,$campocodigo,$numcaracteres){
Global $DB;
	$numcaracteres=$numcaracteres*(-1);
	$rsTabla=mysqli_query($DB, "select count($campocodigo) from $tabla");
	$ATabla=mysqli_fetch_array($rsTabla);
	$nreg=$ATabla[0];
	if($nreg>0)	{
		$rsTabla=mysqli_query($DB, "select $campocodigo from $tabla");
		mysqli_data_seek($rsTabla,$nreg-1);
		$ATabla=mysqli_fetch_array($rsTabla);
	}
	$cod=$ATabla[0]+1;
	$cod="00000000000000".$cod;
	$generado=substr($cod,$numcaracteres);
	mysqli_free_result($rsTabla);
	return $generado;
}

function Msg($title,$message){
	echo "<html><head><title>Message</title><link href='../estilos/style.css' rel=stylesheet type='text/css'><LINK href='{$CFG->wwwroot}/dist/css/AdminLTE.min.css type=text/css rel=stylesheet></head><body>";
	echo "<div align=center><br><br><br>";
	echo "<table width=40% border=0 cellspacing=0 cellpadding=2>";
	echo "<br><br><br><br><br><br><br><br><br><tr class=T><td align=center height=30>$title</td></tr>";
	echo "<tr><td align=center height=30>$message</td></tr>";
	echo "<tr><td>&nbsp;</td></tr>";
	echo "<tr class=T><td>&nbsp;</td></tr>";
	echo "</table>";
	echo "</div></body></html>";
}
function paginar($sql,$tabla,$mantenimiento) {
Global $ordenarpor;
Global $ordenactual;
Global $sentido;
Global $pagina;
	$limite=6;
	$rs=mysqli_query($DB, $sql) or die("Error en la consulta");
	$totalfilas = mysqli_num_rows($rs);
	if(empty($pagina))$pagina = 1;
	$filainicial =  $pagina*$limite-($limite);
if(empty($ordenarpor))$ordenarpor = "1";
if($ordenactual==$ordenarpor){
	if($sentido=="Desc")		{
		$sentido="Asc";
	}else{
		$sentido="Desc";
	}
}else{
		$sentido="Asc";
}
$ordenactual=$ordenarpor;
	$rs_lim=mysqli_query($DB, "$sql Order By $ordenarpor $sentido Limit $filainicial, $limite") or die ("Error en el ordenamiento...");
	MostrarTabla($rs_lim,$tabla,$pagina,$ordenactual,$sentido);

	if($pagina != 1) {
		$paginaprevia= $pagina - 1;
	}
	echo "<table border=0 cellpadding=0 cellspacing=0 width=100%><tr align=center><td>";
	echo "<font class=text>P&aacute;ginas:&nbsp;</b></font>";
	$numpaginas = ceil($totalfilas/$limite);
	for($i=1; $i <= $numpaginas; $i++) {
		if($i!=$pagina){
			echo "<font color=#006699 size=2><b><A HREF=".$PHP_SELF."?pagina=".$i."&ordenarpor=".$ordenarpor."&ordenacual=".$ordenactual."&sentido=".$sentido.">".$i."</A></b></font>&nbsp;";
		}else{
			echo "<font color=red size=2><b>$i</b></font>&nbsp;";
		}
	}
	echo "</td></tr></table>";
	if(($totalfilas-($limite*$pagina)) > 0){
		$paginasgte = $pagina + 1;
	}
mysqli_free_result($rs);
}

function Title($title){
	echo "<table width=100% border=0 cellspacing=2 cellpadding=0>";
  echo "<tr align=center><td><font class=text><b>$title</b></td></tr>";
}

function MostrarTabla($rs,$tabla,$pagina,$ordenactual,$sentido){
	$campos=mysqli_num_fields($rs);
	$numfilas=mysqli_num_rows($rs);
	$ancho='580';if($campos<=3)$ancho='580';
	echo "<form name=frmList action='grabar.php' method=post>";
	 echo "<center><table border=0 cellpadding=0 cellspacing=0 width=590>
       <tr>
         <td><img src=../imagenes/spacer.gif width=1 height=1 border=0></td>
       </tr>
       <tr>
        <td colspan=3><img  src=../imagenes/cuadro1.jpg width=590 height=5 border=0></td>
       </tr>
       <tr>
         	<td><img src=../imagenes/cuadro1.jpg width=6 height=22 border=0></td>
	 <td background=../imagenes/cabecera.jpg><center><font class=textblanco>Registros:<b> ".$numfilas."</font></b></center></td>
         	<td><img src=../imagenes/cuadro1.jpg width=2 height=22 border=0 ></td>
       </tr>
       <tr>
         <td colspan=3><img src=../imagenes/cuadro5.jpg width=590 height=6 border=0 ></td>
       </tr>
       <tr>
   	 <td background=../imagenes/cabecera.jpg></td>
        <td align=center>";
	echo "<table cellPadding=2 cellSpacing=0 width=$ancho>";
	echo "<tr><td width=60%><input type='hidden' name='pag' value='$tabla'>";
	echo "</tr></table>";
	echo "<table cellPadding=2 cellSpacing=1  width=$ancho border=1 bordercolor=#69A6D8>";
	echo "<tr class=Mtr2>";
		echo "<td>&nbsp;<input name='allbox' type='checkbox' onClick='seleccionartodo();' title='Seleccionar o anular la selecci�n de todos los registros'></td>";
		for($i=0;$i<$campos;$i++){
			$campo=mysqli_field_name($rs,$i);
			echo "<td ><a href=".$PHP_SELF."?pagina=".$pagina."&ordenarpor=".($i+1)."&ordenactual=".$ordenactual."&sentido=".$sentido." title='Ordenar por ".$campo."'>".$campo."</a></td>";
		}
	echo "</tr>";
	while($filas=mysqli_fetch_array($rs)){
		echo "<tr>";
			echo "<td width=30>&nbsp;<input type='checkbox' name='check[]' value=".$filas[0]." onClick='seleccionaruno(this);'></td>";
			for($i=0;$i<$campos;$i++){
				if($i==0){
					echo "<td class=text><a href=".strtolower($tabla).".php?id=".$filas[0]."&sw=2><img src='../imagenes/editar.jpg' border=0 alt='Modificar'>$filas[$i]</a></td>";
				}else{
					echo "<td class=text>".$filas[$i]."</td>";
				}
			}
		echo "</tr>";
	}
	echo "</table>";
	echo "</td>
	      <td background=../imagenes/cabecera.jpg></td>
       </tr>
       <tr>
         <td colspan=3><img src=../imagenes/cuadro8.jpg width=590 height=9 border=0></td>
       </tr>
     </table>";
	echo "</center>";
	echo "</form>";
	include('mantenimiento.php');
	echo "<center><font class=text>";
}

function llenarcombo($tabla,$campos,$condicion,$seleccionado,$parametroselect,$name){
Global $DB;
$rs = mysqli_query($DB, "select $campos from $tabla".$condicion);
echo "<select name=".$name." ".$parametroselect." class=form-control id=".$name.">";
echo "<option value=''>Seleccione</option>";
	while($cur = mysqli_fetch_array($rs)){
		$seleccionar="";
		if($cur[0]==$seleccionado) $seleccionar="selected";
		echo "<option value=".$cur[0]." ".$seleccionar.">".$cur[1]."</option>";
	}
echo "</select>";
mysqli_free_result($rs);
}

function llenarchecks($tabla,$campos){
Global $DB;
$rsc = mysqli_query($DB, "select $campos from $tabla".$condicion);
	while($curc = mysqli_fetch_array($rsc)){
		echo "<input type='checkbox' value=".$curc[0]." name='chkservicio[]' checked='checked' class='inputcheck ng-pristine ng-valid' ng-model='checked'><span>".$curc[1]."</span>&nbsp;";
	}

mysqli_free_result($rsc);
}

function llenaranios($value, $desde=2015, $hasta=2025, $name = 'anio'){
	echo "<select name=".$name." class='form-control input-sm' id=".$name.">";
	echo "<option value=''>Seleccione</option>";
		for($i=$desde; $i<=$hasta; $i++) {
			$seleccionar="";
			if($i == $value) {
				$seleccionar="selected";
			}
			echo "<option value=".$i." ".$seleccionar.">".$i."</option>";
		}
	echo "</select>";
}

function tablaperspectiva($idempresa, $idarea, $idperspectiva, $anio, $mes){
	global $DB;
	
	$np_result = mysqli_query($DB, "SELECT * FROM perspectivas WHERE idperspectiva = '$idperspectiva'");
	$np_row = mysqli_fetch_assoc($np_result);
	
    echo "<div class='box'>
                    <div class='box-header'>
                      <h3 class='box-title'>Perspectiva $np_row[nombre]</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class='box-body no-padding'>
                      <table class='table table-condensed'>
                        <tbody><tr>
                          <th>Objetivo</th>
                          <th>Meta</th>
                          <th>Actual</th>
                          <th>Delta %</th>
                          <th>Indicador</th>
                        </tr>";
	if (!isset($mes)) {
	    $mes = '01';
	} else {
	    if (isset($_REQUEST['mes'])) {
	        $mes = $_REQUEST['mes'];
	    }
	}
	if ($anio == '') {
	    $anio = date('Y');
	} else {
	    if (isset($_REQUEST['anio'])) {
	        $mes = $_REQUEST['anio'];
	    }
	}
	if ($idarea == 5) {
	    $rs = mysqli_query($DB, "SELECT * FROM objetivos o,detalle_objetivos do where o.idobjetivo=do.idobjetivo and anio = '$anio' and mes = '$mes' and idempresa='$idempresa' and (idarea=4 or idarea=2) and idperspectiva='$idperspectiva'");
	} else {
	    $rs = mysqli_query($DB, "SELECT * FROM objetivos o,detalle_objetivos do where o.idobjetivo=do.idobjetivo and anio = '$anio' and mes = '$mes' and idempresa='$idempresa' and (idarea='$idarea' or idarea=5) and idperspectiva='$idperspectiva'");
	}
	$o = 0;
	while ($fila = mysqli_fetch_array($rs)) {
	    $o        = $o + 1;
	    //$fila=mysqli_fetch_array($rs);
	    $objetivo = $fila[1];
	    $meta     = $fila[6];

	    echo "<tr><td>";
	    echo $objetivo;
		echo "</td>";
	    echo "<td>";
	    echo $meta;
		echo "</td>";
		
	    if ($mes == '') {
	        $mes = '01';
	    } else {
	        if (isset($_REQUEST['mes'])) {
	            $mes = $_REQUEST['mes'];
	        }
	    }
	    $totalv = 0;
	    $totalc = 0;
	    if ($o == 1 or $o == 4) {
	        $rs2    = mysqli_query($DB, "select sum(total) as totalventas from documento_venta where year(fecha)='$anio' and month(fecha)='$mes' and idempresa='$idempresa'");
	        $fila2  = mysqli_fetch_array($rs2);
	        $totalv = $fila2[0];
	        $rs3    = mysqli_query($DB, "select sum(total) as totalcompras from documento_compra where year(fecha)='$anio' and month(fecha)='$mes' and idempresa='$idempresa'");
	        $fila3  = mysqli_fetch_array($rs3);
	        $totalc = $fila3[0];
	        if ($o == 4) {
	            $actual = $totalv - $totalc - 500;
	        } else {
	            $actual = $totalv - $totalc;
	        }
	        if ($actual > 0) {
	            $porc = (($actual * 100) / $meta);
	        }
	    } else {
	        if ($o == 2) {
	            $rs2    = mysqli_query($DB, "SELECT sum(cantidad) as cantidad FROM documento_venta d,detalle_documentoventa dv where d.iddocumento=dv.iddocumento and year(fecha)='$anio' and month(fecha)='$mes' and d.idempresa='$idempresa'");
	            $fila3  = mysqli_fetch_array($rs2);
	            $totalv = $fila3[0];
	            $actual = $totalv;
	            if ($actual > 0) {
	                $porc = (($actual * 100) / $meta);
	            }
	        } else {
	            if ($o == 5) {
	                $rs2    = mysqli_query($DB, "select sum(cantidad) as totalventas from documento_venta d,detalle_documentoventa dv where d.iddocumento=dv.iddocumento and year(fecha)='$anio' and month(fecha)='$mes' and idempresa='$idempresa'");
	                $fila2  = mysqli_fetch_array($rs2);
	                $totalv = $fila2[0];
	                $rs3    = mysqli_query($DB, "select sum(cantidad) as totalcompras from documento_compra d,detalle_documentocompra dc where d.iddocumento=dc.iddocumento and year(fecha)='$anio' and month(fecha)='$mes' and idempresa='$idempresa'");
	                $fila3  = mysqli_fetch_array($rs3);
	                $totalc = $fila3[0];
	                $actual = $totalv + $totalc;
	                if ($actual > 0) {
	                    $porc = (($actual * 100) / $meta);
	                }
	            } else {
	                $rs2    = mysqli_query($DB, "SELECT sum(cantidad) as cantidad FROM documento_compra d,detalle_documentocompra dv where d.iddocumento=dv.iddocumento and year(fecha)='$anio' and month(fecha)='$mes' and d.idempresa='$idempresa'");
	                $fila3  = mysqli_fetch_array($rs2);
	                $totalc = $fila3[0];
	                $actual = $totalc;
	                if ($actual > 0) {
	                    $porc = (($actual * 100) / $meta);
	                }
	            }
	        }
	    }

	   echo "<td>";
	    if (isset($actual))
	        echo $actual;
       echo "</td>";
	   echo "<td>";
	    if (isset($porc))
	        printf('%.1f', $porc);
	   echo "</td>";
	    echo "<td><img src='http://chart.apis.google.com/chart?chs=250x150&cht=gom&chd=t:";
	    if (isset($porc))
	        printf('%.2f', $porc);
	echo "&chl=A' height='50' width='100'/></td></tr>";
	   
	}
    echo "</tbody></table>
	                    </div>
	                    <!-- /.box-body -->
	                    </div>";
}

?>
