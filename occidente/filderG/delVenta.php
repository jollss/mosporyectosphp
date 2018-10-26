<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$idventa=$_POST['ident'];
$venta=new Ventas();
//echo $idventa;

$venta-> delAllVenta($idventa,$con);


/*echo "<form name=form action=statusEnd.php method=post>";
echo "<input type=text name=ident value=".$venta.">";
echo "</form>";
echo "<script language=javascript>document.form.submit();</script>";
*/
echo "
    <script>
        document.location=('listVentas.php');
    </script>";
?>