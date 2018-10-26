<?php
session_start();
include("Config/conexion2.php");
include( 'Models/usuario.php');
$self = $_SERVER['PHP_SELF']; //Obtenemos la página en la que nos encontramos
header("refresh:12; url=$self");
$con = Conectarse();
$correo = $_SESSION['mail'];
$user = $_SESSION['username'];
$idus=0;
$tos=0;
$Yo = new Usuario();
$Yo->obtenerUsuarioCorreoBD($correo,$con);
$iduser=$Yo->regresaIdu();
$contrase=($_POST['pass']);
$idcontrase=($_POST['idu']);
//echo $contrase;
//echo "<br>";
//echo $iduser;
//echo "<br>";
//echo $idcontrase;
if($contrase=='' and $idcontrase!='' and $idcontrase!=$iduser){
  echo "
    <script>
       alert('que paso hackerman No te sientas !');

         document.location=('rh/inde.php');
    </script>";
}
else if($contrase=='' and $idcontrase!='' and $idcontrase==$iduser){
  echo "
    <script>
       alert('Medio Hackerman no cuentas !');

         document.location=('rh/inde.php');
    </script>";
}
else{
//echo $contrase;
//echo "<br>";
//echo $idcontrase;
$contrasenna = md5($contrase);
$fechaHoy = date('j-n-Y'). " " .date('g:i:s A');
 $sql = "UPDATE usuario SET pssw='$contrasenna',fecha_modi='$fechaHoy', bandera_contrase='si' WHERE idu='$idcontrase'";
 //print_r($sql);

$result = $con->query($sql);
//  print_r($result);
if($result==1){
 echo "
   <script>
     alert('Modificacion correcta favor de cerrar todas las pestañas!');
      document.location=('login.html');
    </script>";
  }

}
?>
