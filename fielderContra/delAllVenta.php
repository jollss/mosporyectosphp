<?php
include("../Config/library.php");
$con = Conectarse();  
//$id=0;
$venta=new Ventas();
$venta->obtenerVentaBD($id,$con);
$idventa=$venta->regresaIdVenta();
$datosC=new Filder();
$datosC->obtenerFilderVBD($idventa,$con);
$idfilder=$datosC-> regresaIdFilder();
$siacF=new Foliosiac();
$siacF->obtenerSiacBD($idfilder,$con);
$tienda=new TiendaComercial(); 
$tienda->obtenerTiendaBD($idfilder,$con);
$asignacion=new AsignacionBajante();
$asignacion->obtenerAsignacionBD($idventa,$con);
echo "ID VENTA:".$idventa." -  IDFILDER:".$idfilder;
$venta->delAllVenta($id,$con);
//delAllVenta($id,$con)
echo "ID VENTA:".$idventa." -  IDFILDER:".$idfilder;
?>