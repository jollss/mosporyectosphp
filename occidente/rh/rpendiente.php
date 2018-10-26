<?php
include("../Config/library.php"); 
$con = Conectarse(); 
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

$title=strtoupper($_POST['title']);
$detalle=strtoupper($_POST['detalle']);
if(isset($title) && isset($detalle))
{
  $Usuario=new Usuario();
  $Yo=new Usuario();
  $Pendiente=new Pendiente();
  $Usuario->obtenerUsuarioCorreoBD($mail,$con);
  $Yo->obtenerUsuarioCorreoBD($mail,$con);
  $de=$Usuario->regresaIdu();
  $iduser=$Usuario->regresaIdu();
  $Pendiente->obtenerIdPendiente($con);
  $id= $Pendiente->regresaIdpe();
  $Pendiente->ingresarPendiente($id,$title,$detalle,$de,$iduser);
  $Pendiente->registrarPendienteBD($con);

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