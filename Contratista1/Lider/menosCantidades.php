<?php
include("../Config/library.php");
$con = Conectarse();  
$id=$_POST['ident'];
$rCantidad=new Reclutadorcantidad();
$rCantidad->obtenerReclutaBD($id,$con);
$canti=$rCantidad->regresaCantidad();
if($canti==0 or $canti==''){
	echo "
      <script>
          document.location=('addRecluta.php');
      </script>"; 
}else{
	$canti=$canti-1;
	$rCantidad->modCantidad($canti,$id,$con);
	echo "
      <script>
          document.location=('addRecluta.php');
    </script>";   
}
?>