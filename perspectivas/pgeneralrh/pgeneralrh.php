<?php session_start();?>
<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<script language="javascript">
$(document).ready(function() {
	$(".botonExcel").click(function(event) {
		$("#datos_a_enviar").val( $("<div>").append( $("#Exportar_a_Excel").eq(0).clone()).html());
		$("#FormularioExportacion").submit();
});
});
</script>
<style type="text/css">
.botonExcel{cursor:pointer;}
</style>
 <?php
   	//include("../Function.php");
	//$link=OpenConexion();
	$idempresa=$_SESSION['id_empresa'];
	$idarea=4;
?>
<form action="index.php" method="post">
<table id='Exportar_a_Excel'><tr><td>
<div align="left" style="position:relative;">
<center><table width='600' bgcolor='#FFF' height='auto' align='center' cellpadding='0' cellspacing='0' id='Exportar_a_Excel' border='0' class="table table-striped table-condensed table-hover">
	<tr>
	<th class='chintabrestit' colspan="5">Seleccione Mes&nbsp;&nbsp;<select name="mes" class="pinstabtdinp">
	  <option value="01" <?php if($_POST['mes']=='01') { ?> selected="selected" <?php ;} ?>>Enero</option>
	  <option value="02" <?php if($_POST['mes']=='02') { ?> selected="selected" <?php ;} ?>>Febrero</option>
	  <option value="03" <?php if($_POST['mes']=='03') { ?> selected="selected" <?php ;} ?>>Marzo</option>
	  <option value="04" <?php if($_POST['mes']=='04') { ?> selected="selected" <?php ;} ?>>Abril</option>
	  <option value="05" <?php if($_POST['mes']=='05') { ?> selected="selected" <?php ;} ?>>Mayo</option>
	  <option value="06" <?php if($_POST['mes']=='06') { ?> selected="selected" <?php ;} ?>>Junio</option>
	  <option value="07" <?php if($_POST['mes']=='07') { ?> selected="selected" <?php ;} ?>>Julio</option>
	  <option value="08" <?php if($_POST['mes']=='08') { ?> selected="selected" <?php ;} ?>>Agosto</option>
	  <option value="09" <?php if($_POST['mes']=='09') { ?> selected="selected" <?php ;} ?>>Septiembre</option>
	  <option value="10" <?php if($_POST['mes']=='10') { ?> selected="selected" <?php ;} ?>>Octubre</option>
	  <option value="11" <?php if($_POST['mes']=='11') { ?> selected="selected" <?php ;} ?>>Noviembre</option>
	  <option value="12" <?php if($_POST['mes']=='12') { ?> selected="selected" <?php ;} ?>>Diciembre</option>
	  </select>&nbsp;&nbsp;<input name="button" type="submit" class="pinstabtdbtn3" value="Ver" /></th>
	</tr>
	<tr><td colspan="5"><h3>Perspectiva Financiera</h3></td><td>&nbsp;</td></tr>
	<tr>
	<th class='chintabrestit'>Objetivo</th>
	<th class='chintabrestit'>Meta</th>
	<th class='chintabrestit'>Actual</th>
	<th class='chintabrestit'>&Delta; %</th>
	<th class='chintabrestit'>Indicador</th>
	<tr>
 <?php
 if ($mes==""){$mes='01';} else {
 $mes=$_REQUEST['mes'];}
 if ($idarea==5){
 $rs=mysqli_query($link, "SELECT * FROM objetivos o,detalle_objetivos do where o.idobjetivo=do.idobjetivo and mes='$mes' and idempresa='$idempresa' and idarea=4 and idperspectiva='1'");
 }
 else
 {
	$rs=mysqli_query($link, "SELECT * FROM objetivos o,detalle_objetivos do where o.idobjetivo=do.idobjetivo and mes='$mes' and idempresa='$idempresa' and idarea='$idarea' and idperspectiva='1'");
	}
	while ($fila=mysqli_fetch_array($rs)){
	$o=$o+1;
	//$fila=mysqli_fetch_array($rs);
	$objetivo=$fila[1];
	$meta=$fila[6];
	?>
         <td class='chintabrescont'><?php echo utf8_encode($objetivo);?></td>
         <td class='chintabrescont'><?php echo $meta;?></td>
<?php
 if ($mes==""){$mes='01';} else {
 $mes=$_REQUEST['mes'];}
 $totalv=0;
 $totalc=0;
 if ($o==1){
	$rs2=mysqli_query($link, "select sum(total) as totalventas from documento_venta where month(fecha)='$mes' and idempresa='$idempresa'");
	$fila2=mysqli_fetch_array($rs2);
	$totalv=$fila2[0];
	$rs3=mysqli_query($link, "select sum(total) as totalcompras from documento_compra where month(fecha)='$mes' and idempresa='$idempresa'");
	$fila3=mysqli_fetch_array($rs3);
	$totalc=$fila3[0];
	$actual=$totalv-$totalc;
	if ($actual>0){
	$porc=(($actual*100)/$meta);}
	} else {if($o==2){
	$rs2=mysqli_query($link, "SELECT sum(cantidad) as cantidad FROM documento_venta d,detalle_documentoventa dv where d.iddocumento=dv.iddocumento  and month(fecha)='$mes' and d.idempresa='$idempresa'");
	$fila3=mysqli_fetch_array($rs2);
	$totalv=$fila3[0];
	$actual=$totalv;
	if ($actual>0){
	$porc=(($actual*100)/$meta);}
	}
	else
	{
	$rs2=mysqli_query($link, "SELECT sum(cantidad) as cantidad FROM documento_compra d,detalle_documentocompra dv where d.iddocumento=dv.iddocumento and month(fecha)='$mes' and d.idempresa='$idempresa'");
	$fila3=mysqli_fetch_array($rs2);
	$totalc=$fila3[0];
	$actual=$totalc;
	if ($actual>0){
	$porc=(($actual*100)/$meta);}
	}
	}
	?>
	<td class='chintabrescont'><?php echo $actual;?></td>
	<td class='chintabrescont'><?php printf("%.1f",$porc);?></td>
	<td class='chintabrescont'><img src="http://chart.apis.google.com/chart?chs=250x150&cht=gom&chd=t:<?php printf("%.2f",$porc);?>&chl=A" height="50" width="100"/></td>
	   </tr><?php } ?>
	   <!--Fin perspectiva 1-->
	   <tr><td colspan="5"><h3>Perspectiva Clientes</h3></td><td>&nbsp;</td></tr>
	<tr>
	<th class='chintabrestit'>Objetivo</th>
	<th class='chintabrestit'>Meta</th>
	<th class='chintabrestit'>Actual</th>
	<th class='chintabrestit'>&Delta; %</th>
	<th class='chintabrestit'>Indicador</th>
	<tr>
 <?php
 if ($mes==""){$mes='01';} else {
 $mes=$_REQUEST['mes'];}
 if ($idarea==5){
 $rs4=mysqli_query($link, "SELECT * FROM objetivos o,detalle_objetivos do where o.idobjetivo=do.idobjetivo and mes='$mes' and idempresa='$idempresa' and idarea=4 and idperspectiva='2'");
 }
 else
 {
	$rs4=mysqli_query($link, "SELECT * FROM objetivos o,detalle_objetivos do where o.idobjetivo=do.idobjetivo and mes='$mes' and idempresa='$idempresa' and idarea='$idarea' and idperspectiva='2'");
	}
	while ($fila4=mysqli_fetch_array($rs4)){
	//$fila4=mysqli_fetch_array($rs4);
	$p=$p+1;
	$objetivoc=$fila4[1];
	$metac=$fila4[6];
	?>
         <td class='chintabrescont'><?php echo utf8_encode($objetivoc);?></td>
         <td class='chintabrescont'><?php echo $metac;?></td>
<?php
 if ($mes==""){$mes='01';} else {
 $mes=$_REQUEST['mes'];}
 if ($p==1){
 $rs5=mysqli_query($link, "select count(*) as cantidad from persona where idtipopersona='1' and idempresa='$idempresa' and month(fecharegistro)='$mes'");
	$fila5=mysqli_fetch_array($rs5);
	$totalcl=$fila5[0];
	if ($totalcl>0){
	$porcc=(($totalcl*100)/$metac);}
	} else {if($p==2){
	$rs5=mysqli_query($link, "select sum(cantidad) as cantidad from documento_venta d,detalle_documentoventa dv where d.iddocumento=dv.iddocumento and idempresa='$idempresa' and month(fecha)='$mes'");
	$fila5=mysqli_fetch_array($rs5);
	$totalvprh=$fila5[0];
	$rs55=mysqli_query($link, "select sum(cantidad) as cantidad from documento_compra d,detalle_documentocompra dc where d.iddocumento=dc.iddocumento and idempresa='$idempresa' and month(fecha)='$mes'");
	$fila55=mysqli_fetch_array($rs55);
	$totalcprh=$fila55[0];
	$totalcl=($totalcprh+4500)-$totalvprh;
	if ($totalcl>0){
	$porcc=(($totalcl*100)/$metac);}
	}
	else
	{
	$rs5=mysqli_query($link, "select count(*) as cantidad from documento_venta where month(fecha)='$mes' and idempresa='$idempresa'");
	$fila5=mysqli_fetch_array($rs5);
	$totalcl=$fila5[0];
	if ($totalcl>0){
	$porcc=(($totalcl*100)/$metac);}
	}
	}
	?>
	<td class='chintabrescont'><?php echo $totalcl;?></td>
	<td class='chintabrescont'><?php echo printf("%.1f",$porcc);?></td>
	<td class='chintabrescont'><img src="http://chart.apis.google.com/chart?chs=250x150&cht=gom&chd=t:<?php printf("%.2f",$porcc);?>&chl=A" height="50" width="100"/></td>
	   </tr>
	   <?php } ?>
	  </table></div></td><td>&nbsp;&nbsp;</td>
	   <td>
	   <div align="right">
	   <table width='600' bgcolor='#FFF' height='auto' align='center' cellpadding='0' cellspacing='0' border='0' class="table table-striped table-condensed table-hover">
	   <!--Fin perspectiva 2-->
	   <tr><td colspan="5">&nbsp;&nbsp;</td></tr>
	   <tr><td colspan="5"><h3>Perspectiva Procesos Internos</h3></td><td>&nbsp;</td></tr>
	<tr>
	<th class='chintabrestit'>Objetivo</th>
	<th class='chintabrestit'>Meta</th>
	<th class='chintabrestit'>Actual</th>
	<th class='chintabrestit'>&Delta; %</th>
	<th class='chintabrestit'>Indicador</th>
	<tr>
 <?php
 if ($mes==""){$mes='01';} else {
 $mes=$_REQUEST['mes'];}
 if ($idarea==5){
 $rs6=mysqli_query($link, "SELECT * FROM objetivos o,detalle_objetivos do where o.idobjetivo=do.idobjetivo and mes='$mes' and idempresa='$idempresa' and idarea=4 and idperspectiva='3'");
 }
 else
 {
	$rs6=mysqli_query($link, "SELECT * FROM objetivos o,detalle_objetivos do where o.idobjetivo=do.idobjetivo and mes='$mes' and idempresa='$idempresa' and idarea='$idarea' and idperspectiva='3'");
	}
	while ($fila6=mysqli_fetch_array($rs6)){
	$w=$w+1;
	//$fila6=mysqli_fetch_array($rs6);
	$objetivopi=$fila6[1];
	$metapi=$fila6[6];
	?>
         <td class='chintabrescont'><?php echo utf8_encode($objetivopi);?></td>
         <td class='chintabrescont'><?php echo $metapi;?></td>
<?php
 if ($mes==""){$mes='01';} else {
 $mes=$_REQUEST['mes'];}
  if ($w==1){
	$rs7=mysqli_query($link, "SELECT COUNT( * ) AS cantidad FROM documento_venta WHERE idempresa='$idempresa' and month(fecha)='$mes'");
	$fila7=mysqli_fetch_array($rs7);
	$totalpi=$fila7[0];
	if ($totalpi>0){
	$porcpi=(($totalpi*100)/$metapi);}
	} else {if($w==2){
	$rs7=mysqli_query($link, "select sum(cantidad) as cantidad from documento_venta d,detalle_documentoventa dv where d.iddocumento=dv.iddocumento and idempresa='$idempresa' and month(fecha)='$mes'");
	$fila7=mysqli_fetch_array($rs7);
	$totalvp=$fila7[0];
	$rs77=mysqli_query($link, "select sum(cantidad) as cantidad from documento_compra d,detalle_documentocompra dc where d.iddocumento=dc.iddocumento and idempresa='$idempresa' and month(fecha)='$mes'");
	$fila77=mysqli_fetch_array($rs77);
	$totalcp=$fila77[0];
	$totalpi=($totalcp+4500)-$totalvp;
	if ($totalpi>0){
	$porcpi=(($totalpi*100)/$metapi);}
	}
	else
	{
	$rs7=mysqli_query($link, "SELECT sum(cantidad) as cantidad FROM documento_compra d,detalle_documentocompra dv where d.iddocumento=dv.iddocumento and d.idempresa='$idempresa' and month(fecha)='$mes'");
	$fila7=mysqli_fetch_array($rs7);
	$totalpi=$fila7[0];
	if ($totalpi>0){
	$porcpi=(($totalpi*100)/$metapi);}
	}
	}
	?>
	<td class='chintabrescont'><?php echo $totalpi;?></td>
	<td class='chintabrescont'><?php echo printf("%.1f",$porcpi);?></td>
	<td class='chintabrescont'><img src="http://chart.apis.google.com/chart?chs=250x150&cht=gom&chd=t:<?php printf("%.2f",$porcpi);?>&chl=A" height="50" width="100"/></td>
	   </tr>
	   <?php } ?>
	   <!--Fin perspectiva 3-->
	   <tr><td colspan="5"><h3>Perspectiva Aprendizaje y Capacitaci&oacute;n</h3></td><td>&nbsp;</td></tr>
	<tr>
	<th class='chintabrestit'>Objetivo</th>
	<th class='chintabrestit'>Meta</th>
	<th class='chintabrestit'>Actual</th>
	<th class='chintabrestit'>&Delta; %</th>
	<th class='chintabrestit'>Indicador</th>
	<tr>
 <?php
 if ($mes==""){$mes='01';} else {
 $mes=$_REQUEST['mes'];}
 if ($idarea==5){
 $rs8=mysqli_query($link, "SELECT * FROM objetivos o,detalle_objetivos do where o.idobjetivo=do.idobjetivo and mes='$mes' and idempresa='$idempresa' and (idarea=2 or idarea=3 or idarea=4) and idperspectiva='4'");
 }
 else
 {
	$rs8=mysqli_query($link, "SELECT * FROM objetivos o,detalle_objetivos do where o.idobjetivo=do.idobjetivo and mes='$mes' and idempresa='$idempresa' and idarea='$idarea' and idperspectiva='4'");
	}
	while ($fila8=mysqli_fetch_array($rs8)){
	//$fila8=mysqli_fetch_array($rs8);
	$q=$q+1;
	$objetivoa=$fila8[1];
	$metaa=$fila8[6];
	?>
         <td class='chintabrescont'><?php echo utf8_encode($objetivoa);?></td>
         <td class='chintabrescont'><?php echo $metaa;?></td>
<?php
 if ($mes==""){$mes='01';} else {
 $mes=$_REQUEST['mes'];}
 if ($q==1){
	$rs9=mysqli_query($link, "select count(*) as cantidad from asistencia a,usuario u where a.idusuario=u.idusuario and opcion='1' and u.idempresa='$idempresa' and month(fecha)='$mes'");
	$fila9=mysqli_fetch_array($rs9);
	$totala=$fila9[0];
	if ($totala>0){
	$porca=(($totala*100)/$metaa);}
	} else {if($q==2){
	$rs9=mysqli_query($link, "select count(idasistencia) as cantidad,area from asistencia asi,area a,usuario u where u.idusuario=asi.idusuario and u.idarea=a.idarea and asi.opcion='1' and idempresa='$idempresa' and month(fecha)='$mes' group by area");
	$fila9=mysqli_fetch_array($rs9);
	$totala=$fila9[0];
	if ($totala>0){
	$porca=(($totala*100)/$metaa);}
	}
	else
	{
	$rs9=mysqli_query($link, "SELECT round(sum(total)/(select count(*) from usuario where idempresa='$idempresa')) as cantidad FROM documento_venta where idempresa='$idempresa' and month(fecha)='$mes'");
	$fila9=mysqli_fetch_array($rs9);
	$totala=$fila9[0];
	if ($totala>0){
	$porca=(($totala*100)/$metaa);}
	}
	}
	?>
	<td class='chintabrescont'><?php echo $totala;?></td>
	<td class='chintabrescont'><?php echo printf("%.1f",$porca);?></td>
	<td class='chintabrescont'><img src="http://chart.apis.google.com/chart?chs=250x150&cht=gom&chd=t:<?php printf("%.2f",$porca);?>&chl=A" height="50" width="100"/></td>
	   </tr>
	   <?php } ?>
	  </table></div></td></tr></table>
</form>
<div>
	   <form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
<p align="center"><a href='#' onClick='window.print();'><img src="../../images/imprimir.png" border='0' title='Imprimir' width='30' height='30'></a>&nbsp;&nbsp;&nbsp;<img src="../../images/excel.jpg" class="botonExcel" width="30" height="30" title="Exportar a Excel"/></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>
</div>