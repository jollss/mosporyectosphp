<?php
include("../Config/library.php");
$con = Conectarse();  
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$estatus=0;
$name=strtoupper($_POST['name']);
$ap =strtoupper($_POST['ap']);
$am =strtoupper($_POST['am']);
//$name=$name." ".$ap." ".$am;
$tel1 =$_POST['tel1'];
$tel2 =$_POST['tel2'];
$tel3 =$_POST['tel3'];
$folio =strtoupper($_POST['folio']);
$dir=strtoupper($_POST['dir']);
$datos=strtoupper($_POST['detalles']);
if(isset($name) && isset($ap)&& isset($am)&& isset($tel1)&& isset($dir)
  && isset($tel2)&& isset($folio)&& isset($tel3))
{
  $venta=new Ventas();
  $ultimo=$venta->obtenerUltimo($con);
  $venta->ingresaVentas($ultimo,$folio,$iduser,$name,$ap,$am,$dir,$datos,
        $tel1,$tel2,$tel3,$estatus);
  $venta->verVentas();
  $venta->registrarVentaBD($con);

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