<?php
include_once(dirname(__FILE__).'/../../config.php');
$idempresa=$_SESSION['id_empresa'];
$desde = $_GET['desde'];
$hasta = $_GET['hasta'];
$desde = date('Y-m-d',strtotime($desde));
$hasta = date('Y-m-d',strtotime($hasta));

//COMPROBAMOS QUE LAS FECHAS EXISTAN
if(isset($desde)==false){
	$desde = $hasta;
}

if(isset($hasta)==false){
	$hasta = $desde;
}
require('../fpdf/fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('../recursos/tienda.gif' , 10 ,8, 10 , 13,'GIF');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(150, 10, 'BALANCED SCORE CARD :: EMPRESAS TEXTILES', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 10, 'Hoy: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(100, 8, 'REPORTE DE VENTAS', 0);
$pdf->Ln(10);
$pdf->Cell(60, 8, '', 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(100, 8, 'Cliente', 0);
$pdf->Cell(70, 8, 'Fecha', 0);
$pdf->Cell(70, 8, 'Total', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
//CONSULTA
if ($desde!=""){
$productos = mysqli_query($DB, "SELECT * FROM documento_venta dv,persona p WHERE dv.idcliente=p.idpersona and dv.idempresa='$idempresa' and fecha BETWEEN '$desde' AND '$hasta'");
} else {
$productos = mysqli_query($DB, "SELECT * FROM documento_venta dv,persona p WHERE dv.idcliente=p.idpersona and dv.idempresa='$idempresa' and fecha BETWEEN '2015-01-01' AND CURDATE()");
}
while($productos2 = mysqli_fetch_array($productos)){
	$pdf->Cell(100, 8, $productos2['razonsocial'], 0);
	$pdf->Cell(70, 8, $productos2['fecha'], 0);
	$pdf->Cell(70, 8, $productos2['total'], 0);
	$pdf->Ln(8);
}

$pdf->Output('reporteventas.pdf','D');
?>
