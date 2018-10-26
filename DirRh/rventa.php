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
$terminal =strtoupper($_POST['terminal']);
$documentacion =strtoupper($_POST['documentacion']);
//$name=$name." ".$ap." ".$am;
$tel1 =$_POST['tel1'];
$tel2 =$_POST['tel2'];
$tel3 =$_POST['tel3'];

$latitud =$_POST['latitud'];
$longitud =$_POST['longitud'];

$folio =strtoupper($_POST['folio']);
$dir=strtoupper($_POST['dir']);
$datos=strtoupper($_POST['detalles']);
$area=strtoupper($_POST['area']);
$distrito=strtoupper($_POST['distrito']);
if(isset($name) && isset($ap)&& isset($am)&& isset($tel1)&& isset($dir)
  && isset($tel2)&& isset($folio)&& isset($tel3))
{
  $venta=new Ventas();
  $ultimo=$venta->obtenerUltimo($con);
  $venta->ingresaVentas($ultimo,$folio,$iduser,$name,$ap,$am,$dir,$datos,
        $terminal,$tel1,$tel2,$tel3,$estatus,$documentacion);
  //$venta->verVentas();
  $venta->registrarVentaBD($con);

  $venta->cambiarArea($ultimo,$area,$con);
  $venta->cambiarDistrito($ultimo,$distrito,$con);
  $sql1="SELECT * FROM ubicacion_venta";
  $resultado=$con->query($sql1);
  while($row = $resultado->fetch_assoc())
  {
    $id=$row['idubicacion'];
  }
  $id=$id+1;
  $sql="INSERT INTO ubicacion_venta 
             (idubicacion,longitud,latitud,idventa)
              VALUES
  ('".$id."','".$longitud."','".$latitud."','".$ultimo."')"; 
  if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

         /*echo "
            <script>
                alert('REGISTRO EXITOSO!');
              document.location=('inde.php');   
            </script>";
            */
echo "
<script>
    alert('REGISTRO EXITOSO!');
</script>"; 
echo "<form name=form action=documentacionImg.php method=post>";
echo "<input type=text name=ident value=".$ultimo.">";
echo "</form>";
echo "<script language=javascript>document.form.submit();</script>";            

}else{
  echo "
  <script>
      alert('ERROR EN DATOS!');
      document.location=('inde.php'); 
  </script>"; 
}
?>