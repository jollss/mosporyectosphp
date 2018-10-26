<?php
include("../Config/library.php");
$con = Conectarse();  
$siac=$_POST['siac'];
$id=$_POST['id'];
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$hora = date("g");
$min = date("i");
$fecha=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;
/*
$filder=new Foliosiac();
$id_siac=$filder->obtenerIdSiac($con);
$filder->ingresarFolioSiac($id_siac,$siac,$id);
$filder->registrarFolioSiacBD($con);
*/
$sql="UPDATE venta SET 
  	folio_siac='$siac',fecha_siac='$fecha'
   	WHERE idventa='".$id."'";
if ($con->query($sql) === TRUE) { echo "Modificacion exitosa<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

//$filder->ingresaFolioSiac($id,$siac,$con);
//echo "id registro:".$id_siac." folio siac:".$siac." ID de filder:".$id;
echo "
<script>
  alert('SIAC REGISTRADO!');
  document.location=('inde.php');
</script>";

?>