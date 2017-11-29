<?php include_once(dirname(__FILE__).'/../../config.php');?>
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
	$idempresa=$_SESSION['id_empresa'];
	$idarea=$_SESSION['id_area'];
?>

	<?php if($idarea==4){?>
<center><table id='Exportar_a_Excel'><tr><td><table width='1200' bgcolor='#FFF' height='auto' align='center' cellpadding='0' cellspacing='0' border='0' class="table table-striped table-condensed table-hover">
	<tr>
	<th class='chintabrestit'>N&deg;</th>
	<th class='chintabrestit'>Objetivo</th>
	<th class='chintabrestit'>Perspectiva</th>
	<th class='chintabrestit'>&Aacute;rea</th>
	<th class='chintabrestit'>Enero</th>
	<th class='chintabrestit'>Febrero</th>
	<th class='chintabrestit'>Marzo</th>
	<th class='chintabrestit'>Abril</th>
	<th class='chintabrestit'>Mayo</th>
	<th class='chintabrestit'>Junio</th>
	<th class='chintabrestit'>Julio</th>
	<th class='chintabrestit'>Agosto</th>
	<th class='chintabrestit'>Septiembre</th>
	<th class='chintabrestit'>Octubre</th>
	<th class='chintabrestit'>Noviembre</th>
	<th class='chintabrestit'>Diciembre</th>
	<th class='chintabrestit'>Total Anual</th>
	<th class='chintabrestit'>Gr&aacute;fico</th>
	</tr>
 <?php
 if ($idarea==5){
	$rs=mysqli_query($DB, "SELECT * FROM objetivos o,perspectivas p,area a where o.idperspectiva=p.idperspectiva and o.idarea=a.idarea and idempresa='$idempresa' order by area");
	} else {
	$rs=mysqli_query($DB, "SELECT * FROM objetivos o,perspectivas p,area a where o.idperspectiva=p.idperspectiva and o.idarea=a.idarea and idempresa='$idempresa' and o.idarea='$idarea' order by area");
	}
	while ($fila=mysqli_fetch_array($rs)){
	$n=$n+1;
	$total=0;
	if ($k==3){$k=1;} else {$k=$k+1;}
	?><tr>
	<td class='chintabrescont'><?php echo $n;?></td>
         <td class='chintabrescont'><?php echo utf8_decode($fila[1]);?></td>
		 <td class='chintabrescont'><?php echo utf8_decode($fila[6]);?></td>
		 <td class='chintabrescont'><?php echo $fila[8];?></td>
		<?php
		$idobjetivo=$fila[0];
		$rs2=mysqli_query($DB, "SELECT * FROM detalle_objetivos where idobjetivo='$idobjetivo'");
		while ($fila2=mysqli_fetch_array($rs2)){?>
         <td class='chintabrescont'><?php echo $fila2[1];?></td>
       <?php $total=$total+$fila2[1];} ?>
	   <td class='chintabrescont'><?php echo $total;?></td>
	   <td class='chintabrescont'><a href="<?php if($fila[2]==1) {echo "pfinanciera";} else {if($fila[2]==2){echo "pclientes";} else {if($fila[2]==3){echo "pprocesosinternos";} else {echo "paprendizaje";}} }; ?><?php echo $k; ?>.php" class="pinstabtdit">Ver Gr&aacute;fico</a></td></tr><?php } ?>
	   </table>
	   <?php } else {if($idarea==2){ ?>
	   <center><table id='Exportar_a_Excel'><tr><td><table width='1200' bgcolor='#FFF' height='auto' align='center' cellpadding='0' cellspacing='0' border='0' class="table table-striped table-condensed table-hover">
	<tr>
<th class='chintabrestit'>N&deg;</th>
	<th class='chintabrestit'>Objetivo</th>
	<th class='chintabrestit'>Perspectiva</th>
	<th class='chintabrestit'>&Aacute;rea</th>
	<th class='chintabrestit'>Enero</th>
	<th class='chintabrestit'>Febrero</th>
	<th class='chintabrestit'>Marzo</th>
	<th class='chintabrestit'>Abril</th>
	<th class='chintabrestit'>Mayo</th>
	<th class='chintabrestit'>Junio</th>
	<th class='chintabrestit'>Julio</th>
	<th class='chintabrestit'>Agosto</th>
	<th class='chintabrestit'>Septiembre</th>
	<th class='chintabrestit'>Octubre</th>
	<th class='chintabrestit'>Noviembre</th>
	<th class='chintabrestit'>Diciembre</th>
	<th class='chintabrestit'>Total Anual</th>
	<th class='chintabrestit'>Gr&aacute;fico</th>
	</tr>
 <?php
 if ($idarea==5){
	$rs=mysqli_query($DB, "SELECT * FROM objetivos o,perspectivas p,area a where o.idperspectiva=p.idperspectiva and o.idarea=a.idarea and idempresa='$idempresa' order by area");
	} else {
	$rs=mysqli_query($DB, "SELECT * FROM objetivos o,perspectivas p,area a where o.idperspectiva=p.idperspectiva and o.idarea=a.idarea and idempresa='$idempresa' and o.idarea='$idarea' order by area");
	}
	while ($fila=mysqli_fetch_array($rs)){
$n=$n+1;
	$total=0;
	if ($k==3){$k=1;} else {$k=$k+1;}
	?><tr>
<td class='chintabrescont'><?php echo $n;?></td>
         <td class='chintabrescont'><?php echo utf8_decode($fila[1]);?></td>
		 <td class='chintabrescont'><?php echo utf8_decode($fila[6]);?></td>
		 <td class='chintabrescont'><?php echo $fila[8];?></td>
		<?php
		$idobjetivo=$fila[0];
		$rs2=mysqli_query($DB, "SELECT * FROM detalle_objetivos where idobjetivo='$idobjetivo'");
		while ($fila2=mysqli_fetch_array($rs2)){?>
         <td class='chintabrescont'><?php echo $fila2[1];?></td>
       <?php $total=$total+$fila2[1];} ?>
	   <td class='chintabrescont'><?php echo $total;?></td>
	   <td class='chintabrescont'><a href="<?php if($fila[2]==1) {echo "pfinancieraa";} else {if($fila[2]==2){echo "pclientesa";} else {if($fila[2]==3){echo "pprocesosinternos";} else {echo "paprendizaje";}} }; ?><?php echo $k; ?>.php" class="pinstabtdit">Ver Gr&aacute;fico</a></td></tr><?php } ?>
	   </table>
	   <?php } else { ?>
	   <center><table id='Exportar_a_Excel'><tr><td><table width='1200' bgcolor='#FFF' height='auto' align='center' cellpadding='0' cellspacing='0' border='0' class="table table-striped table-condensed table-hover">
	<tr>
<th class='chintabrestit'>N&deg;</th>
	<th class='chintabrestit'>Objetivo</th>
	<th class='chintabrestit'>Perspectiva</th>
	<th class='chintabrestit'>&Aacute;rea</th>
	<th class='chintabrestit'>Enero</th>
	<th class='chintabrestit'>Febrero</th>
	<th class='chintabrestit'>Marzo</th>
	<th class='chintabrestit'>Abril</th>
	<th class='chintabrestit'>Mayo</th>
	<th class='chintabrestit'>Junio</th>
	<th class='chintabrestit'>Julio</th>
	<th class='chintabrestit'>Agosto</th>
	<th class='chintabrestit'>Septiembre</th>
	<th class='chintabrestit'>Octubre</th>
	<th class='chintabrestit'>Noviembre</th>
	<th class='chintabrestit'>Diciembre</th>
	<th class='chintabrestit'>Total Anual</th>
	<th class='chintabrestit'>Gr&aacute;fico</th>
	</tr>
 <?php
 if ($idarea==5){
	$rs=mysqli_query($DB, "SELECT * FROM objetivos o,perspectivas p,area a where o.idperspectiva=p.idperspectiva and o.idarea=a.idarea and idempresa='$idempresa' order by area");
	} else {
	$rs=mysqli_query($DB, "SELECT * FROM objetivos o,perspectivas p,area a where o.idperspectiva=p.idperspectiva and o.idarea=a.idarea and idempresa='$idempresa' and o.idarea='$idarea' order by area");
	}
	while ($fila=mysqli_fetch_array($rs)){
$n=$n+1;
	$total=0;
	if ($k==3){$k=1;} else {$k=$k+1;}
	?><tr>
<td class='chintabrescont'><?php echo $n;?></td>
         <td class='chintabrescont'><?php echo utf8_decode($fila[1]);?></td>
		 <td class='chintabrescont'><?php echo utf8_decode($fila[6]);?></td>
		 <td class='chintabrescont'><?php echo $fila[8];?></td>
		<?php
		$idobjetivo=$fila[0];
		$rs2=mysqli_query($DB, "SELECT * FROM detalle_objetivos where idobjetivo='$idobjetivo'");
		while ($fila2=mysqli_fetch_array($rs2)){?>
         <td class='chintabrescont'><?php echo $fila2[1];?></td>
       <?php $total=$total+$fila2[1];} ?>
	   <td class='chintabrescont'><?php echo $total;?></td>
	   <td class='chintabrescont'><a href="<?php if($fila[2]==1) {echo "pfinancieraa";} else {if($fila[2]==2){echo "pclientesa";} else {if($fila[2]==3){echo "pprocesosinternos";} else {echo "paprendizaje";}} }; ?><?php echo $k; ?>.php" class="pinstabtdit">Ver Gr&aacute;fico</a></td></tr><?php } ?>
	   </table>
	   <?php }} ?>

	   <form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
<p align="center"><a href='#' onClick='window.print();'><img src="../../images/imprimir.png" border='0' title='Imprimir' width='30' height='30'></a>&nbsp;&nbsp;&nbsp;<img src="../../images/excel.jpg" class="botonExcel" width="30" height="30" title="Exportar a Excel"/></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>
