<?php
include("../Config/library.php");
$con = Conectarse();  
$idos=$_POST['venta'];

/*function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}*/
	    require_once("Multiupload.php");
	    $files = $_FILES['userfile']['name'];
      /*===============================================*/
      foreach ($files as & $valor) {
        $AdjuntoImg=new Adjunto_venta();
        //$totalAdjuntos=$AdjuntoImg->TotalAdjuntosBD($con);
        $con->real_query("SELECT * FROM adjunto_venta");
            $r = $con->use_result();
            while ($l = $r->fetch_assoc()){
                $totalAdjuntos=$l['idaventa'];
            } 

        //echo $totalAdjuntos;
        $upload = new Multiupload();
        $isUpload = $upload->upFiles($files,$idos);
          if($isUpload==''){
            echo "
            <script>
                alert('IMAGEN NO VALIDA!');
            </script>"; 
            echo "<form name=form action=documentacionImg.php method=post>";
            echo "<input type=text name=ident value=".$idos.">";
            echo "</form>";
            echo "<script language=javascript>document.form.submit();</script>";
          }else{
            $totalAdjuntos=$totalAdjuntos+1;
            $AdjuntoImg->ingresaVentas($totalAdjuntos,$isUpload,$idos);
            //echo $idos."-".$isUpload."--".$totalAdjuntos;
            $AdjuntoImg->registrarVentaBD($con);
            //echo "<br>".$idos."-".$isUpload."--".$totalAdjuntos;
          }
        }
		
    
		$_POST['ident']=$idos; 
      echo "
      <script>
          alert('REGISTRO EXITOSO!');
      </script>";   
      
      echo "<form name=form action=documentacionImg.php method=post>";
      echo "<input type=text name=ident value=".$idos.">";
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";
?>