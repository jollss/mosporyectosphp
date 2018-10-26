<?php
@session_start();
if (session_id() ==''){ 
    session_start();
}
if($_SESSION['username']=="")
{
  header("Location: ../login.html");
}
include("../Config/conexion2.php");  
  require_once '../Config/conexion.php';
  $con = Conectarse();  

function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$iduser=$_POST['iduser'];
$nombre=strtoupper($_POST['name']);
$ap=strtoupper($_POST['ap']);
$am=strtoupper($_POST['am']);
$pssw=md5($_POST['pssw']);
if(isset($nombre) && isset($ap)&& isset($am)&& isset($pssw)&& isset($iduser))
{
 $sql="UPDATE usuario SET 
  nombre='".$nombre."', 
 	apaterno='".$ap."',
  amaterno='".$am."',
  pssw='".$pssw."'
 	WHERE idu='".$iduser."'";
    //mysqli_query($con,$sql);  
    execute($sql) or die (mysqli_error($con));
  echo "
    <script>
        alert('MODIFICACION EXITOSA! Por favor sal e ingresa de nuevo para ver cambios reflejados.');
        document.location=('inde.php');
    </script>";     
  }else{
  echo "
    <script>
        alert('ERROR EN DATOS!');
        document.location=('config.php');
    </script>"; 
  }  
?>