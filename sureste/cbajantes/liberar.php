<?php
include("../Config/library.php"); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$idmos=$_POST['idmos'];
function execute($sql,$con){
		if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
}		
if(isset($idmos))
{
 $sql="UPDATE adjunto_os SET 
  nombreimg=''
  WHERE os_idos='".$idmos."'";
  $sql2="UPDATE adjunto_os SET 
  os_idos='0'
  WHERE nombreimg=''";
  $sql3="UPDATE dataos SET 
  estatus='0',ddos='',mmos='',yearos='',horaos='',principal='',secundario=''
  WHERE id_orden='".$idmos."'";
execute($sql,$con);
execute($sql2,$con);
execute($sql3,$con);

  echo "
    <script>
        alert('MODIFICACION EXITOSA!');
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