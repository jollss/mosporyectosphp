<?php
include("../Config/library.php");
$con = Conectarse();  
$id=$_POST['ident'];
//echo $id;
$rCantidad=new Reclutadorcantidad();
$rCantidad->obtenerReclutaBD($id,$con);
$canti=$rCantidad->regresaCantidad();
if($canti==0 or $canti==''){
	$canti=$canti+1;
	$total=$rCantidad->TotalReclutasBD($con);
	$rCantidad->ingresarRCantidad($total,$id,$canti);
	//$rCantidad->verRCantidad();
	$rCantidad->registroReclutaBD($con);
}else{
	$canti=$canti+1;
	$rCantidad->modCantidad($canti,$id,$con);
	//$rCantidad->verRCantidad();
}
          //alert('REGISTRO EXITOSO!');
echo "
      <script>
          document.location=('addRecluta.php');
      </script>";   
?>