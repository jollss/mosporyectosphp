<?php
include("../Config/library.php");
$con = Conectarse(); 
$id=$_POST['ident'];
$cantidad=new Reclutadorcantidad();
$cantidad->obtenerReclutaBD($id,$con);
$total=$cantidad->regresaCantidad();
$reclutas=$cantidad->TotalReclutasBD($con);
if($total==0 or $total==''){
	$dato=$total+1;
	$cantidad->ingresarRCantidad($reclutas,$id,$dato);
	//$cantidad->verRCantidad();
	$cantidad->registroReclutaBD($con);
	echo "
            <script>
                alert('REGISTRO EXITOSO!');
              document.location=('addRecluta.php');   
            </script>";
}else{
	$dato=$total+1;
	$cantidad->obtenerReclutaBD($id,$con);
	//$cantidad->verRCantidad();
	$cantidad->modCantidad($dato,$id,$con);
	echo "
            <script>
                alert('REGISTRO EXITOSO!');
              document.location=('addRecluta.php');   
            </script>";
}
?>