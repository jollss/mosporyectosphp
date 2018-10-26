<?php
include("../Config/library.php"); 
$con = Conectarse(); 
$idp=$_POST['ident'];
if(isset($idp))
{
  $Pendiente=new Pendiente();
  $Pendiente->borrarPendiente($idp,$con);
  
  echo "
    <script>
        alert('MODIFICACION EXITOSA!');
        document.location=('inde.php');
    </script>";     
  }else{
  echo "
    <script>
        alert('ERROR EN DATOS!');
        document.location=(' config.php');
    </script>"; 
  }  
?>