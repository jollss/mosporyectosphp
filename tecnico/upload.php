<?php
include("../Config/library.php");
$con = Conectarse();
$idos=$_POST['id'];

$id=0;
function execute($query){
      $con = Conectarse();
      return mysqli_query($con,$query);
}
function existe($nombre,$id){
  $con = Conectarse();
  $con->real_query("SELECT * FROM adjunto_os WHERE nombreimg='$nombre' AND os_idos='$id'");
  $r = $con->use_result();
  while ($l = $r->fetch_assoc()){
      $nombres=$l['nombreimg'];
  }
  echo $nombres."<br>";
  if(isset($nombres)){
    return 1;
  }if(!isset($nombres)){
    return 0;
  }
}
	    //$files = $_FILES['userfile']['name'];
function subir($files,$nombre,$con,$idoss,$i){
      $valor=0;
      $n=0;
      //var_dump($files);
      //foreach ($files as & $valor) {

          $AdjuntoImg=new Adjunto_os();
          $con->real_query("SELECT * FROM adjunto_os");
              $r = $con->use_result();
              while ($l = $r->fetch_assoc()){
                  $totalAdjuntos=$l['idadjunto'];
              }

              /*
            require_once("Multiupload.php");
            $upload = new Multiupload();
            $isUpload = $upload->upFiles($files,$idos,$n);
            echo $isUpload;
            */

            $isUpload=sube($i,$files,$nombre);
            //echo $isUpload;
              if($isUpload==0){
                /*
                echo "
                <script>
                    alert('IMAGEN NO VALIDA!');
                </script>";
                echo "<form name=form action=dataos.php method=post>";
                echo "<input type=text name=ident value=".$idoss.">";
                echo "</form>";
                echo "<script language=javascript>document.form.submit();</script>";
                */
              }else{

                  $totalAdjuntos=$totalAdjuntos+1;
                  $AdjuntoImg->ingresaAdjuntoOs($totalAdjuntos,$isUpload,$idoss);
                  $AdjuntoImg->registrarAdjuntoOsBD($con);

              }

          $n=$n+1;
        //}
}

function sube($i,$file,$nameImg){
    //var_dump($file);
    $url="../os/";
    //echo $i." ".$file[$i]." ".$nameImg;
    $_FILES["userfile"]["name"]=$file;
    $trozos[$i] = explode(".", $_FILES["userfile"]["name"][$i]);
    $extension[$i] = end($trozos[$i]);
    if(checkExtension($_FILES['userfile']['name'][$i],$extension[$i],$nameImg) === TRUE)
    {
        /*==================================================================*/
        $_FILES['userfile']['name'][$i] = $nameImg. '.' . end($trozos[$i]);
        //var_dump($_FILES['userfile']);
      $esta=existe($_FILES['userfile']['name'][$i],$nameImg);
      echo "====================<br>";
      echo $_FILES['userfile']['name'][$i]."<br>";
      echo $esta."<br>";
       if($esta==0){
          //comprobamos si el archivo ha subido
          if(move_uploaded_file($_FILES['userfile']['tmp_name'][$i],$url.$_FILES['userfile']['name'][$i]))
          {
              $filename=$_FILES['userfile']['name'][$i];
              return $filename;
          }
        }if($esta==1){
          echo "<br>ya existe la imagen<br>";
        }
    }else{
        return 0;
    }
}
function checkExtension($files,$extension,$idmod)
{
    //aqui podemos añadir las extensiones que deseemos permitir
    $extensiones = array("jpg","png","gif","pdf","JPG","jpeg","JPEG");
    if(in_array(strtolower($extension), $extensiones))
    {
        return TRUE;
    }else{
        return FALSE;
    }
}
      $files = $_FILES['userfile']['name'];
      $contador=count($files);
      //echo $contador;
      for ($i=0; $i < $contador; $i++) {
        //echo $i."<br>";
        $nameImg=$idos."_".$i;
        subir($_FILES['userfile']['name'],$nameImg,$con,$idos,$i);
      }
      /*
        if($files[0]<>''){
          $nameImg=$idos."_OS";
          var_dump($_FILES['userfile']['name'][0]);
          subir($_FILES['userfile']['name'],$nameImg,$con,$idos,0);
        }if($files[1]<>''){
          $nameImg=$idos."_TRAYECTORIA";
          subir($_FILES['userfile']['name'],$nameImg,$con,$idos,1);
        }if($files[2]<>''){
          $nameImg=$idos."_ROCETA";
          subir($_FILES['userfile']['name'],$nameImg,$con,$idos,2);
        }if($files[3]<>''){
          $nameImg=$idos."_TERMINAL";
          subir($_FILES['userfile']['name'],$nameImg,$con,$idos,3);
        }if($files[4]<>''){
          $nameImg=$idos."_MODEM";
          subir($_FILES['userfile']['name'],$nameImg,$con,$idos,4);
        }if($files[5]<>''){
          $nameImg=$idos."_MEDIDOR";
          subir($_FILES['userfile']['name'],$nameImg,$con,$idos,5);
        }if($files[6]<>''){
          $nameImg=$idos."_GOTERO";
          subir($_FILES['userfile']['name'],$nameImg,$con,$idos,6);
        }
      */
      //}
      /*===============================================*/
      //var_dump($files);


		$_POST['ident']=$idos;
      echo "
      <script>
          alert('REGISTRO EXITOSO!');
      </script>";

      echo "<form name=form action=dataos.php method=post>";
      echo "<input type=text name=ident value=".$idos.">";
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";

?>
