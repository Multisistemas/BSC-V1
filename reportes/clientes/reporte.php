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
$pdf->Cell(100, 8, 'REPORTE DE CLIENTES', 0);
$pdf->Ln(10);
$pdf->Cell(60, 8, '', 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(20, 8, 'RUC', 0);
$pdf->Cell(50, 8, 'Razon Social', 0);
$pdf->Cell(50, 8, 'Direccion', 0);
$pdf->Cell(15, 8, 'Telefono', 0);
$pdf->Cell(20, 8, 'Movil', 0);
$pdf->Cell(30, 8, 'Correo', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
//CONSULTA
if ($filtro!=""){
$productos = mysql_query("SELECT * FROM persona where idempresa='$idempresa' and idtipopersona='1' and razonsocial like '%$filtro%'");
} else {
$productos = mysql_query("SELECT * FROM persona where idempresa='$idempresa' and idtipopersona='1'");
}
while($productos2 = mysql_fetch_array($productos)){
	$pdf->Cell(20, 8, $productos2['ruc'], 0);
	$pdf->Cell(50, 8, $productos2['razonsocial'], 0);
	$pdf->Cell(50, 8, $productos2['direccion'], 0);
	$pdf->Cell(15, 8, $productos2['telefono'], 0);
	$pdf->Cell(20, 8, $productos2['movil'], 0);
	$pdf->Cell(30, 8, $productos2['email'], 0);
	$pdf->Ln(8);
}

$pdf->Output('reporteclientes.pdf','D');
?>