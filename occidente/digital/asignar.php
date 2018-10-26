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
$iduser=$_POST['iduser'];//id tecnico
$idsuper=$_POST['idsuper'];
if(isset($iduser) && isset($iduser))
{
 $sql="UPDATE usuario SET 
  asignado='".$idsuper."'
 	WHERE idu='".$iduser."'";
    //mysqli_query($con,$sql);  
    execute($sql) or die (mysqli_error($con));
  echo "
    <script>
        alert('Tecnico asignado');
    </script>";     
    echo "<form name=form action=infoos.php method=post>";
      echo "<input type=text name=ident value=".$idsuper.">";
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";
  }else{
  echo "
    <script>
        alert('ERROR EN DATOS!');
        document.location=(' inde.php');
    </script>"; 
  }  
?>