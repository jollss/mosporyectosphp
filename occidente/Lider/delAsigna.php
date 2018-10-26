<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$iduser=$_POST['ident'];//id tecnico
$idsuper=$_POST['idsuper'];
function execute($query){
          $con = Conectarse();  
          return mysqli_query($con,$query);
    }
if(isset($iduser) && isset($iduser))
{
 $sql="UPDATE usuario SET 
  asignado='0'
 	WHERE idu='".$iduser."'";
    //mysqli_query($con,$sql);  
    execute($sql) or die (mysqli_error($con));
    /*echo "
    <script>
        document.location=('inde.php');
    </script>";     
    */
    echo "<form name=form action=fAsignar.php method=post>";
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