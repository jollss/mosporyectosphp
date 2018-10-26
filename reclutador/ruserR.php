<?php
include("../Config/library.php"); 
  $con = Conectarse();  

$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
/*===============================================*/
$tipo="REGISTRO";
$edad=$_POST['edad'];
$nombre=strtoupper($_POST['name']);
$ap=strtoupper($_POST['ap']);
$am=strtoupper($_POST['am']);
$tel=$_POST['tel'];
/*-------------------------------------------*/
$correo=$_POST['correo'];
$entero_vacante=$_POST['entero_vacante'];
$fuente=$_POST['fuente'];
$referencia=$_POST['referencia'];
/*--------------------------------------------*/
$sexo=$_POST['sexo'];
$dir=strtoupper($_POST['dir']);
if(isset($nombre) && isset($ap)&& isset($am)&& isset($tel)&& isset($dir)
  && isset($edad))
{
  $reclutar=new Reclutamiento();
  $id=$reclutar->ultimoReclutamiento($con);
  $reclutar->ingresaRecluta($id,$nombre,$ap,$am,$tel,$edad,$dir,$sexo,$tipo,$correo,$entero_vacante,
    $fuente,$referencia,$iduser);
  $reclutar->registroReclutarBD($con);
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