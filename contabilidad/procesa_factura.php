<?php
include("../Config/library.php"); 

$con = Conectarse();  
$paqo=$_POST['paqo'];
$factura=$_POST['factura'];

$sql="UPDATE validar_os SET factura_os='$factura' WHERE paqo like '%".$paqo."%'";

if ($con->query($sql) === TRUE) { echo "Actualizado el factura"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
  
echo "<script> document.location=('con_factura.php'); </script>"; 
//echo "FIN";
?>