<?php
include("../Config/library.php"); 
/*PROCESADO DE REASIGNACION*/
$con = Conectarse();  
$estado=1;
$asignado=$_POST['user'];//actual asignado
$iduser=$_POST['asignado'];//asignado nuevo
$os=$_POST['os'];//idmos
$orden=$_POST['orden'];//idmos
$tipo_os=strtoupper($_POST['tipo_os']);//tipo de orden
echo "tecnico actual:".$iduser."-nuevo tecnico:".$asignado."-Orden:".$orden."-Tipo nuevo:".$tipo_os;
$idc=0;

$mail = $_SESSION['mail'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idyo=$Yo->regresaIdu();
date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $h = date("g");
    $min = date("i");
    $hora=$h.":".$min;
if(isset($iduser) && isset($os))
{
  /*
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require_once("multiupload.php");
    $files = $_FILES['userfile']['name'];
    $upload = new Multiupload();
    $isUpload = $upload->upFiles($files,$os);
    
}else{
    throw new Exception("Error Processing Request", 1);
} 
*/
  $ter_optica='';
  $puerto='';
  $s_onta='';
  $principal='';
  $secundario='';
  $claro_video='';
  $cantidad=new Cantidades();
  $dataos=new Dataos();
  $dataos->obtenerDataosOsBD($orden,$con);
  $tipoOs=$dataos->regresaTipoOs();
  echo "<br>".$tipoOs;
    $cantidad->obtenerCantidadesBD($iduser,$con);
    $cobre=$cantidad->regresaCobre();
    $fibra=$cantidad->regresaFibra();
    $hibrida=$cantidad->regresaHibrida();
    $psr=$cantidad->regresaPsr();
    $voz=$cantidad->regresaVoz();
    $tecnica=$cantidad->regresaTecnica();
    echo "<br>".
    "
    COBRE ".$cobre."<br>
    FIBRA ".$fibra."<br>
    HIBRIDA ".$hibrida."<br>
    PSR ".$psr."<br>
    VOZ ".$voz."<br>
    TECNICA" .$tecnica."<br>
    "
    ."<br>";
    //$dataos->obtenerDataosOsBD($orden,$con);
    //$dataos->verDataos();
    
  $cantidad->actualizaCantidadesBD($tipo_os,$asignado,$con);//asigna una os
  $cantidad->actualizaCantidadesMenosBD($tipoOs,$iduser,$con);//quita la anterior
  
  $dataos->modTecnico($asignado,$orden,$con);
  $osModel=new Os();
  $osModel->asignarOs($asignado,$orden,$con);
  /*
  $dataos->obtenerDataosOsBD($orden,$con);
  //$dataos->verDataos();
  $osn=new Os();
  $osn->asignarOs($asignado,$orden,$con);
*/
if(!isset($_POST['filial_asignada'])){

}else{
  /*
  $nom_auxiliar=$_POST['nom_auxiliar'];
  $filial_asignada=$_POST['filial_asignada'];
  $venta=$_POST['ident'];
  $fase6 = new Fase6();
  $idfase6=$fase6->ultimaFse6($con);
  //$fase6->ingresarFase6($idfase6,$filial_asignada,$nom_auxiliar,$iduser,$isUpload,$venta);
  $fase6->modTecnico($iduser,$os,$con);
  //$fase6->verFase6();
  $fase6->registrarFase6BD($con);
  */
}


    echo "
    <script>
        alert('REGISTRO CORRECTO!');
        document.location=('reAdd.php');
   </script>";
  
}else{
  
  echo "
  <script>
      alert('ERROR EN DATOS!');
      document.location=('reAdd.php');
  </script>"; 
 
}  
?>