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
$idu=$_POST['del'];
$act=0;
if(isset($idu))
{
 $sql="UPDATE usuario SET 
  activo='".$act."'
 	WHERE idu='".$idu."'";
    //mysqli_query($con,$sql);  
    execute($sql) or die (mysqli_error($con));
  echo "
    <script>
        alert('MODIFICACION EXITOSA!');
        document.location=(' list.php');
    </script>";     
  }else{
  echo "
    <script>
        alert('ERROR EN DATOS!');
        document.location=(' list.php');
    </script>"; 
  }  
?>