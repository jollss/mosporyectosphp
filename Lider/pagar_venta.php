<?php
include("../Config/library.php");
$con = Conectarse(); 
date_default_timezone_set('America/Mexico_City');
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$fecha=$dia."/".$mes."/".$aaaa;

//var_dump($_POST['pagos']);
$total=count($_POST['pagos']);
for ($i=0; $i < $total; $i++) { 
	$idventa=$_POST['pagos'][$i];
	$sql="UPDATE venta SET venta_pagada=1, fecha_pago='$fecha',pago_por='$iduser' WHERE idventa='$idventa'";
	if ($con->query($sql) === TRUE) { echo "Pago registrado correcto<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

}
echo "
  <script>
      alert('Nomina registrada');
      document.location=('pagar.php'); 
  </script>"; 
?>