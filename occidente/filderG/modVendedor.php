<?php
include("../Config/library.php");
$con = Conectarse(); 
$idvendedor=$_POST['idV'];
$idventa=$_POST['idventas'];
//echo $idvendedor."---".$idventa;
$venta=new ventas();
$venta->cambiarVendedor($idventa,$idvendedor,$con);

echo "<form name=form action=statusEnd.php method=post>";
echo "<input type=text name=ident value=".$idventa.">";
echo "</form>";
echo "<script language=javascript>document.form.submit();</script>";

?>