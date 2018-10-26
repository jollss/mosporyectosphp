<?php
include("../Config/library.php");
$con = Conectarse(); 
$venta=$_POST['ident'];
$notelmex=strtoupper($_POST['notelmex']);
$detalles=strtoupper($_POST['detalles']);
//$status=$_POST['estatus'];
$causas=new finVenta();
$idfinventa=$causas->obtenerIdFin($con);

$causas->ingresarFinVenta($idfinventa,$detalles,$notelmex,$venta);
//$causas->ver();
$causas->registrarBD($con);

echo "<form name=form action=statusEnd.php method=post>";
      echo "<input type=text name=ident value=".$venta.">";
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";

?>