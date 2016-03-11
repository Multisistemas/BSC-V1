<?php
session_start();
$idempresa=$_SESSION['id_empresa'];
$filtro = $_GET['filtro'];
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
$pdf->Cell(100, 8, 'REPORTE DE PRODUCTOS', 0);
$pdf->Ln(10);
$pdf->Cell(60, 8, '', 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(50, 8, 'Producto', 0);
$pdf->Cell(20, 8, 'P. Compra', 0);
$pdf->Cell(20, 8, 'P. Venta', 0);
$pdf->Cell(20, 8, 'P. Venta U.', 0);
$pdf->Cell(25, 8, 'Stock', 0);
$pdf->Cell(20, 8, 'Color', 0);
$pdf->Cell(15, 8, 'Referencia', 0);
$pdf->Cell(25, 8, 'Categoria', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
//CONSULTA
if ($filtro!=""){
$productos = mysql_query("SELECT * FROM producto p,categoria c WHERE p.idcategoria=c.idcategoria and p.idempresa='$idempresa' and producto like '%$filtro%'");
} else {
$productos = mysql_query("SELECT * FROM producto p,categoria c WHERE p.idcategoria=c.idcategoria and idempresa='$idempresa'");
}
while($productos2 = mysql_fetch_array($productos)){
	$pdf->Cell(50, 8, $productos2['producto'], 0);
	$pdf->Cell(20, 8, 'S/. '.$productos2['preciocompra'], 0);
	$pdf->Cell(20, 8, 'S/. '.$productos2['precioventa'], 0);
	$pdf->Cell(20, 8, 'S/. '.$productos2['precioventau'], 0);
	$pdf->Cell(25, 8, $productos2['stock'], 0);
	$pdf->Cell(20, 8, $productos2['color'], 0);
	$pdf->Cell(15, 8, $productos2['referencia'], 0);
	$pdf->Cell(25, 8, $productos2['categoria'], 0);
	$pdf->Ln(8);
}

$pdf->Output('reporteproductos.pdf','D');
?>