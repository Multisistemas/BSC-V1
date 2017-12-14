<?php
/*
header("Content-type: application/vnd.ms-excel; name='excel'");
header("Content-Disposition: filename=ficheroExcel.xls");
*/
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=archivoCSV.csv');
header("Pragma: no-cache");
header("Expires: 0");

echo $_POST['datos_a_enviar'];
?>