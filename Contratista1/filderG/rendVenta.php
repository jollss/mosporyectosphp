<?php
include("../Config/library.php");
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$estatus=0;
$servicio=strtoupper($_POST['servicio']);
$detalles =strtoupper($_POST['detalles']);
$idventa=$_POST['idventa'];
if(isset($servicio) && isset($detalles))
{
  $venta=new Fase8();
  $ultimo=$venta->obtenerUltimo($con);
  $venta->ingresaVentas($ultimo,$folio,$iduser,$name,$ap,$am,$dir,$datos,
        $tel1,$tel2,$tel3,$estatus);
  //$venta->verVentas();
  $id=$venta->regresaIdVenta();
  $venta->registrarVentaBD($con);
  $venta->cambiarVendedor($id,$nombreV,$con);
         echo "
            <script>
                alert('REGISTRO EXITOSO!');
              document.location=('inde.php');   
            </script>";
 
}else{
  echo "
  <script>
      alert('ERROR EN DATOS!');
      document.location=('inde.php'); 
  </script>"; 
}
?>