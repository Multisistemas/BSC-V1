<?php
session_start();
$idempresa=$_SESSION['id_empresa'];
$idpro = $_GET['idpro'];

require('../fpdf/fpdf.php');
require('../conexion.php');

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
$pdf->Cell(100, 8, 'KARDEX DE PRODUCTOS', 0);
$pdf->Ln(10);
$pdf->Cell(60, 8, '', 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 8, 'Fecha', 0);
$pdf->Cell(20, 8, 'Serie', 0);
$pdf->Cell(20, 8, 'Numero', 0);
$pdf->Cell(30, 8, 'Tipo Operacion', 0);
$pdf->Cell(20, 8, 'Entradas', 0);
$pdf->Cell(20, 8, 'Salidas', 0);
$pdf->Cell(20, 8, 'Saldo Final', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
//CONSULTA
if ($desde!=""){
$productos = mysqli_query($DB, "SELECT k.fecha,k.serie,k.nrodocumento,k.cantidad,k.idtipod,k.idtipoo FROM kardex k WHERE idproducto='$idpro' ORDER BY fecha,idkardex");
} else {
$productos = mysqli_query($DB, "SELECT k.fecha,k.serie,k.nrodocumento,k.cantidad,k.idtipod,k.idtipoo FROM kardex k WHERE idproducto='$idpro' ORDER BY fecha,idkardex");
}
while($productos2 = mysqli_fetch_array($productos)){
$fecha = $productos2['fecha'];
	$tipod = $productos['idtipod'];
	$serie = $productos2['serie'];
	$nrodoc = $productos2['nrodocumento'];
	$codo = $productos2['idtipoo'];
	if ($codo=='C'){
	$cant = $productos2['cantidad'];
	$saldo= $saldo+$cant;
	$codo2="Compra";}
	else
	{$cantv = $productos2['cantidad'];
	$saldo= $saldo-$cantv;
	$codo2="Venta - Salida";}
	$pdf->Cell(20, 8, $fecha, 0);
	$pdf->Cell(20, 8, $serie, 0);
	$pdf->Cell(20, 8, $nrodoc, 0);
	$pdf->Cell(30, 8, $codo2, 0);
	$pdf->Cell(20, 8, $cant, 0);
	$pdf->Cell(20, 8, $cantv, 0);
	$pdf->Cell(20, 8, $saldo, 0);
	$pdf->Ln(8);
}

$pdf->Output('reportekardex.pdf','D');
?>