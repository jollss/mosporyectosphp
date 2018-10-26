<?php
include("../Config/conexion2.php");  
require_once '../Config/conexion.php';
$con = Conectarse();  
$idos=$_POST['id'];
$valor=0;
$id=0;
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
	    require_once("Multiupload.php");
	    $files = $_FILES['userfile']['name'];
      /*===============================================*/
      foreach ($files as & $valor) {
      	$con->real_query("SELECT idadjunto FROM adjunto_os ORDER BY idadjunto");
                  $resultado = $con->use_result();
		    while ($row = $resultado->fetch_assoc()){
		      $id=$row['idadjunto'];
		    }$id=$id+1;

      	$upload = new Multiupload();
	    	$isUpload = $upload->upFiles($files,$idos);
	    	 $sql="INSERT INTO adjunto_os (idadjunto,
	    	 	nombreimg,os_idos)
			    VALUES
			    ('".$id."','".$isUpload."','".$idos."')";
			    //mysqli_query($con,$sql);  
			    execute($sql) or die (mysqli_error($con));  
		    $valor = $valor +1;
		}
		$_POST['ident']=$idos; 
      echo "
      <script>
          alert('REGISTRO EXITOSO!');
      </script>";   
      
      echo "<form name=form action=dataos.php method=post>";
      echo "<input type=text name=ident value=".$idos.">";
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";
/*
 echo "
    <script>
        alert('REGISTRO EXITOSO!');
        document.location=(' dataosuall.php');
    </script>";   
    */
?>