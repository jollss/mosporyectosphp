<?php
include("../Config/library.php");
$con = Conectarse();  

$principal=$_POST['principal'];
$secundario=$_POST['secundario'];
$claro_video=$_POST['claro_video'];
$estado=$_POST['estado'];
$modem=$_POST['modem'];
$rosetas=$_POST['rosetas'];
$metraje=$_POST['metraje'];
$cableado=$_POST['cableado'];

$orden=$_POST['os_idorden'];
$detalle=strtoupper($_POST['detalles']);


$id=0;
$detalles=new Dataos();
$detalles->obtenerDataosBD($orden,$con);

$adjunto=new Adjunto_os();
$aux=$adjunto->ExisteAdjuntoBD($orden,$con);
if($aux==0){
  echo "
  <script>
      alert('FALTAN IMAGENES!');
      document.location=(' dataosuall.php');
  </script>"; 
}else{
  /*===============================================*/
  
  if(isset($orden) && isset($estado)&& isset($detalles))
  {
  $dataOS=new Dataos();
  $dataOS->obtenerOsBD($orden,$con);
  //$tecnico=
  $dataOS->obtenerDataosOsBD($orden,$con);
  $tecnico=$dataOS->regresaTecnicoAsignacionIdu();
  $tipo_os=$dataOS->regresaTipoOs();
  
  $cantidad = new Cantidades();
  $cantidad->obtenerCantidadesBD($tecnico,$con);
  $cantidad->actualizaCantidadesMenosBD($tipo_os,$tecnico,$con);

  $dataOS->modPrincipal($principal,$orden,$con);
  $dataOS->modSecundario($secundario,$orden,$con);
  $dataOS->modClaroV($claro_video,$orden,$con);
  $dataOS->modEstatus($estado,$orden,$con);
  $dataOS->modObservaciones($detalle,$orden,$con);
  $dataOS->modFecha($orden,$con);

  $material=new  Material();
  $id=$material->totalesMaterial($con);
  $material->ingresarMaterial($id,$orden,$modem,$rosetas,$metraje);
  
  $material->registrarMaterialBD($con);
  
      $_POST['ident']=$orden; 
      echo "
      <script>
          alert('REGISTRO EXITOSO!');
      </script>";   
      
      echo "<form name=form action=dataos.php method=post>";
      echo "<input type=text name=ident value=".$orden.">";
      echo "</form>";
      echo "<script language=javascript>document.form.submit();</script>";
      
      //document.location=(' dataosuall.php');
      //header("Location: dataos.php?ident=".$_POST['ident']); 
    }else{
    echo "
      <script>
          alert('ERROR EN DATOS!');
          document.location=(' dataosuall.php');
      </script>"; 
    } 
} 
?>
