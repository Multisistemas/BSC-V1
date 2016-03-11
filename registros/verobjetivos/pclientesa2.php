<?php session_start();?>
<link href="../css/misestilos.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
    	var datos = $.ajax({
    		url:'datosgraficapc.php',
    		type:'post',
    		dataType:'json',
    		async:false    		
    	}).responseText;
    	
    	datos = JSON.parse(datos);
    	google.load("visualization", "1", {packages:["corechart"]});
      	google.setOnLoadCallback(dibujarGrafico);
      
      	function dibujarGrafico() {
        	var data = google.visualization.arrayToDataTable(datos);

        	var options = {
          	title: 'PERSPECTIVA CLIENTES',
          	hAxis: {title: 'MESES', titleTextStyle: {color: 'green'}},
          	vAxis: {title: 'TOTAL CLIENTES', titleTextStyle: {color: '#FF0000'}},
          	backgroundColor:'#ffffcc',
          	legend:{position: 'bottom', textStyle: {color: 'blue', fontSize: 13}},
          	width:900,
            height:500
        	};

        	var grafico = new google.visualization.ColumnChart(document.getElementById('grafica'));
        	grafico.draw(data, options);
      	}
	</script>
<!--<script type="text/javascript" src="jquery-1.3.2.min.js"></script>-->
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
	<table border="0"  align="center" cellpadding="0" cellspacing="0" width="1200" id="Exportar_a_Excel">
       <tr>
         <td></td>
       </tr>
       <tr>
         <td colspan="3"></td>
       </tr>
       <tr>
         <td></td>
         <td ><br /><h1 class="intproh1" style="padding-left:25px;"><?php echo $_REQUEST["objetivo"];?></h1></td>
         <td></td>
       </tr>
	   <tr>
         <td colspan="3">
 <center><br />
 <div id="grafica"></div></center></td></tr></table>
<form action="ficheroExcel.php" method="post" target="_blank" id="FormularioExportacion">
<p align="center"><a href='#' onClick='window.print();'><img src="../../images/imprimir.png" border='0' title='Imprimir' width='30' height='30'></a>&nbsp;&nbsp;&nbsp;<img src="../../images/excel.jpg" class="botonExcel" width="30" height="30" title="Exportar a Excel"/></p>
<input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
</form>
</body>
</html>