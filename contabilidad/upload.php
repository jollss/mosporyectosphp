<?php
include("../Config/library.php");
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
        $AdjuntoImg=new Adjunto_os();
        $totalAdjuntos=$AdjuntoImg->TotalAdjuntosBD($con);
        //echo $totalAdjuntos;
        $upload = new Multiupload();
        $isUpload = $upload->upFiles($files,$idos);
        
        $AdjuntoImg->ingresaAdjuntoOs($totalAdjuntos,$isUpload,$idos);
        $AdjuntoImg->registrarAdjuntoOsBD($con);
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