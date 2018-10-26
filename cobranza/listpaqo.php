<?php
ob_start();
include("../Config/library.php"); 
$con2 = Conectarse();  
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$hoy = $dia." ".$mes." ".$aaaa;
$nombre_archivo="../filtro/".$hoy.".csv";
if(file_exists($nombre_archivo)){
	unlink($nombre_archivo);
	$archivo = fopen($nombre_archivo, "a");
	$mensaje = "FOLIO PISA,PAQO";
	fwrite($archivo,$mensaje. "\n");
}else{
	$archivo = fopen($nombre_archivo, "a");
	$mensaje = "FOLIO PISA,PAQO";
	fwrite($archivo,$mensaje. "\n");
}
$con2->real_query("SELECT id_folio_pisa,paqo FROM validar_os where paqo<>''");// AND semana='$semana'");
$re = $con2->use_result();
while ($row2 = $re->fetch_assoc()){
//$mensaje = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$date."";
	$mensaje = $row2['id_folio_pisa'].",".$row2['paqo'];
	//echo $mensaje."<br>";
	$archivo = fopen($nombre_archivo, "a");
	fwrite($archivo,$mensaje. "\n");
	fclose($archivo);
}
header("Location: ../filtro/".$nombre_archivo);
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
ob_end_flush();
?>