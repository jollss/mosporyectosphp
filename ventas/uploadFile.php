<?php
include("../Config/library.php");
$con = Conectarse();  
$idos=$_POST['solicitud'];



//var_dump($_POST);
//var_dump($_FILES);
if(isset($_POST['longitud']) and isset($_POST['latitud'])){
  $longitud=$_POST['longitud'];
  $latitud=$_POST['latitud'];
  $id_venta=$_POST['solicitud'];

  $con->real_query("SELECT * FROM venta WHERE folio_ventas='$id_venta'");
  $r = $con->use_result();
  while ($l = $r->fetch_assoc()){
      $totalAdjuntos=$l['folio_ventas'];
  }
  echo $totalAdjuntos."string";
  if($totalAdjuntos<>$id_venta){
      require_once("Multiupload.php");
      $files = $_FILES['userfile']['name'];
      /*===============================================*/
      $totalAdjuntos=0;
      
      foreach ($files as & $valor) {
            $con->real_query("SELECT * FROM adjunto_venta order by idaventa");
            $r = $con->use_result();
            while ($l = $r->fetch_assoc()){
                $totalAdjuntos=$l['idaventa'];
            }
            $upload = new Multiupload();
            $isUpload = $upload->upFiles($files,$idos);
          if($isUpload==''){
            
            echo "
            <script>
                console.log('error en la carga de la imagen');
            </script>"; 
          }else{
            $AdjuntoImg = new Adjunto_venta();
            $totalAdjuntos=$totalAdjuntos+1;
            //echo $totalAdjuntos."<br>";
            $AdjuntoImg->ingresaVentas($totalAdjuntos,$isUpload,$idos);
            $AdjuntoImg->registrarVentaBD($con);
          }
        }
        
      echo "
      <script>
          alert('REGISTRO EXITOSO!');
      </script>";   
  
      echo "<form name=form action=inde.php method=get>";
      echo "<input type=text name=return value=".$idos.">";
      echo "<input type=text name=longitud value=".$longitud.">";
      echo "<input type=text name=latitud value=".$latitud.">";
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";
  }if($totalAdjuntos==$id_venta){
     echo "
      <script>
          alert('DATOS INCORRECTOS!');
      </script>";   
  
      echo "<form name=form action=inde.php method=get>";
     
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";
  }
      
}if(!isset($longitud) and !isset($latitud) and !isset($_POST['validar'])) {
     require_once("Multiupload.php");
      $files = $_FILES['userfile']['name'];
      /*===============================================*/
      $totalAdjuntos=0;
      
      foreach ($files as & $valor) {
            $con->real_query("SELECT * FROM adjunto_venta order by idaventa");
            $r = $con->use_result();
            while ($l = $r->fetch_assoc()){
                $totalAdjuntos=$l['idaventa'];
            }
            $upload = new Multiupload();
            $isUpload = $upload->upFiles($files,$idos);
          if($isUpload==''){
            
            echo "
            <script>
                console.log('error en la carga de la imagen');
            </script>"; 
          }else{
            $AdjuntoImg = new Adjunto_venta();
            $totalAdjuntos=$totalAdjuntos+1;
            //echo $totalAdjuntos."<br>";
            $AdjuntoImg->ingresaVentas($totalAdjuntos,$isUpload,$idos);
            $AdjuntoImg->registrarVentaBD($con);
          }
        }
        echo "bbbbbbbbbbbbb";
        
      echo "
      <script>
          alert('REGISTRO EXITOSO!');
          location.href='inde.php';
      </script>";   
      
}if(isset($_POST['validar']) and $_POST['validar']=='SI' and isset($_POST['venta'])) {
     require_once("Multiupload.php");
      $files = $_FILES['userfile']['name'];
      /*===============================================*/
      $totalAdjuntos=0;
      
      $ventass=$_POST['venta'];
      foreach ($files as & $valor) {
            $con->real_query("SELECT * FROM adjunto_venta order by idaventa");
            $r = $con->use_result();
            while ($l = $r->fetch_assoc()){
                $totalAdjuntos=$l['idaventa'];
            }
            $upload = new Multiupload();
            $isUpload = $upload->upFiles($files,$idos);
          if($isUpload==''){
            
            echo "
            <script>
                console.log('error en la carga de la imagen');
            </script>"; 
          }else{
            $AdjuntoImg = new Adjunto_venta();
            $totalAdjuntos=$totalAdjuntos+1;
            $AdjuntoImg->ingresaVentas($totalAdjuntos,$isUpload,$idos);
            $AdjuntoImg->registrarVentaBD($con);
          }
        }
        
      echo "<form name=form action=inde.php method=post>";
      echo "<input type=text name=ident value=".$ventass.">";
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";  
      
      echo $idos;
}

?>