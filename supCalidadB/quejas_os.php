<?php
include("../Config/library.php"); 
$con = Conectarse(); 
$idqueja=$_POST['id_queja'];
$idmos=$_POST['idmos'];
$folio_pisa=$_POST['folio_pisa'];
$id_orden=$_POST['id_orden'];
$dato=$_POST['dato'];
$opcion=$_POST['opcion'];
$accion=$_POST['accion'];
$comentario=strtoupper($_POST['coment']);
function execute($query){ 
  $con = Conectarse();  
  return mysqli_query($con,$query);
}

date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$fecha=$dia."/".$mes."/".$aaaa;
if($accion=="INSERT"){
	$sql="INSERT INTO quejas_os (
		    id_queja,folio_pisa_os,id_mos_os,
		    id_orden_os,estatus,fecha,coment_queja)
		    VALUES
		    ('".$idqueja."','".$folio_pisa."','".$idmos."',
		     '".$id_orden."','".$opcion."','".$fecha."','".$comentario."'
		     )";
	execute($sql) or die (mysqli_error($con));
	echo "
	<script>
	    document.location=('buscar.php?dato=".$dato."');
	</script>"; 
}if($accion=="UPDATE"){
	$sql="UPDATE quejas_os SET estatus='".$opcion."',fecha='".$fecha."',coment_queja='".$comentario."'
	 WHERE folio_pisa_os='".$folio_pisa."'";
	 execute($sql) or die (mysqli_error($con));
	echo "
	<script>
	    document.location=('buscar.php?dato=".$dato."');
	</script>"; 
}




?>