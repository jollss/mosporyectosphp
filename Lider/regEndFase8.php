<?php
include("../Config/library.php");
$con = Conectarse(); 
$venta=$_POST['ident'];
$tecnico=strtoupper($_POST['tecnico']);
$detalles=strtoupper($_POST['detalles']);
$status=strtoupper($_POST['estatus']);
if($status=='LIQUIDAR'){
	$fase7=new Fase7();
	$fase7->modEstatus($status,$venta,$con);
	$fase8=new Fase8();
	$id=$fase8->TotalDataosBD($con);
	$fase8->ingresaDataos($id,$tecnico,$detalles,
			$venta);
	$fase8->registroDataosBD($con);
}else{
	$fase7=new Fase7();
	$fase7->modEstatus($status,$venta,$con);
	$fase6=new Fase6();
	$fase6->obtenerFase6BD($venta,$con);
	$fase6->modTecnico($tecnico,$venta,$con);
	$fase8=new Fase8();
	$id=$fase8->TotalDataosBD($con);
	$fase8->ingresaDataos($id,$tecnico,$detalles,
			$venta);
	$fase8->registroDataosBD($con);
}
echo "<form name=form action=statusEnd.php method=post>";
      echo "<input type=text name=ident value=".$venta.">";
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";
?>