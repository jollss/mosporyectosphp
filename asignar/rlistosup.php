<?php
@session_start();
if (session_id() ==''){ 
    session_start();
}
if($_SESSION['username']=="")
{
  header("Location: ../login.html");
}
include("../Config/conexion2.php");  
require_once '../Config/conexion.php';
$con = Conectarse();  
$con2 = Conectarse();  
$con3 = Conectarse();
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$idos=$_POST['id'];
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
$usu=$_POST['us'];
if(isset($usu))
{

    /**=============================================================================================*/
    
    $nombre =strtoupper($_POST['ncli']);
    $apc=strtoupper($_POST['apcli']);
    $amc=strtoupper($_POST['amcli']);
    $arcli=strtoupper($_POST['area']);
    $discli=strtoupper($_POST['distrito']);
    $telcli=strtoupper($_POST['telefono']);
    $idc=0;
    $con->real_query("SELECT * FROM cliente ORDER BY idcli");
          $resultado = $con->use_result();
      while ($row = $resultado->fetch_assoc()){
        $idc=$row['idcli'];
      }  
      $idc=$idc+1;

    $sql="INSERT INTO cliente (
          idcli,nombrecli,apcli,amcli,area,distrito,telcli)
          VALUES
          ('".$idc."','".$nombre."','".$apc."','".$amc."','".$arcli."','".$discli."','".$telcli."')"; 
          execute($sql) or die (mysqli_error($con)); 
          
    /**=============================================================================================*/
    
    $super=strtoupper($_POST['super']);
    $ncoo="";
    $apcoo="";
    $amcoo="";
    $con->real_query("SELECT * FROM usuario WHERE idu='$super'");
          $resultado = $con->use_result();
      while ($row = $resultado->fetch_assoc()){
        $nsup=$row['nombre'];
        $apsup=$row['apaterno'];
        $amsup=$row['amaterno'];
      }
    $idac=0;
    $con->real_query("SELECT * FROM acargo ORDER BY idcargo");
          $resultado = $con->use_result();
      while ($row = $resultado->fetch_assoc()){
        $idac=$row['idcargo'];
      }  $idac=$idc+1;

    $sql="INSERT INTO acargo (
          idcargo,nsupervisor,apsupervisor,amsupervisor,ncoordinador,apcoordinador,amcoordinador)
          VALUES
          ('".$idac."','".$nsup."','".$apsup."','".$amsup."','".$ncoo."','".$apcoo."','".$amcoo."')"; 
          execute($sql) or die (mysqli_error($con)); 
          
    /**=============================================================================================*/
    
        $zona=strtoupper($_POST['zona']);
    $idz=0;
    $con->real_query("SELECT * FROM zona ORDER BY idzona");
          $resultado = $con->use_result();
      while ($row = $resultado->fetch_assoc()){
        $idz=$row['idzona'];
      }  $idz=$idz+1;
    $sql="INSERT INTO zona (
          idzona,nombre)
          VALUES
          ('".$idz."','".$zona."')"; 
          execute($sql) or die (mysqli_error($con)); 
          
    /**=============================================================================================*/
    
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
    $idus=$_POST['us'];
    $statusos=0;
    $idos=0;
    $con->real_query("SELECT * FROM os ORDER BY idos");
          $resultado = $con->use_result();
      while ($row = $resultado->fetch_assoc()){
        $idos=$row['idos'];
      }  $idos=$idos+1;
    $sql="INSERT INTO os (
          idos,dd,mm,aaaa,status,
          supervisor,semana,usuario_idu,cliente_idcli,acargo_idcargo,zona_idzona)
          VALUES
          ('".$idos."','".$dia."','".$mes."','".$aaaa."','".$statusos."',
            '".$super."','".$semana."','".$idus."','".$idc."','".$idac."','".$idz."')"; 
          execute($sql) or die (mysqli_error($con)); 
          
/*===============================================*/
//solo se puede acceder si es una peticion post
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //llamamos a la clase multiupload
    require_once("multiupload.php");
    //array de campos file del formulario
    $files = $_FILES['userfile']['name'];
    //creamos una nueva instancia de la clase multiupload
    $upload = new Multiupload();
    //llamamos a la funcion upFiles y le pasamos el array de campos file del formulario
    $isUpload = $upload->upFiles($files,$idos);
    $sql="UPDATE os SET 
    fileos='".$isUpload."'
      WHERE idos='".$idos."'";
      //mysqli_query($con,$sql);  
      execute($sql) or die (mysqli_error($con));
                            
}else{
    throw new Exception("Error Processing Request", 1);
} 
    /**=============================================================================================*/
    
    $tipo=strtoupper($_POST['tipo']);
    $empresa=strtoupper($_POST['empresa']);
    $pisaplex=strtoupper($_POST['pisaplex']);
    $dilacion=strtoupper($_POST['dilacion']);
    $cope=strtoupper($_POST['cope']);

    $teroptica=strtoupper($_POST['teroptica']);
    $puerto=strtoupper($_POST['puerto']);
    $serie=strtoupper($_POST['serie']);
    $ftek=strtoupper($_POST['ftek']);
    $subterraneo=strtoupper($_POST['subterraneo']);
    $principal=strtoupper($_POST['principal']);
    $secundario=strtoupper($_POST['secundario']);
    $tipoins=strtoupper($_POST['tipoins']);
    $clarov=strtoupper($_POST['clarov']);

    $idoda=0;
    $con->real_query("SELECT * FROM osdata ORDER BY iddata");
          $resultado = $con->use_result();
      while ($row = $resultado->fetch_assoc()){
        $idoda=$row['iddata'];
      }  $idoda=$idoda+1;

    $sql="INSERT INTO osdata (
          iddata,pisaplex,dilacion,
          cope,empresa,tipo,
          termi_optica,puerto,serie,
          folio_tek,subterraneo,principal,
          secundario,claro_video,tipo_instalacion,
          os_idos)
          VALUES
          ('".$idoda."','".$pisaplex."','".$dilacion."',
            '".$cope."','".$empresa."','".$tipo."',
            '".$teroptica."','".$puerto."','".$serie."',
            '".$ftek."','".$subterraneo."','".$principal."',
            '".$secundario."','".$clarov."','".$tipoins."',
            '".$idos."')"; 
          execute($sql) or die (mysqli_error($con)); 
          /*======================*/          
          $con->real_query("SELECT * FROM cantidades WHERE usuario_idu='$idus'");
                $resultado = $con->use_result();
            while ($row = $resultado->fetch_assoc()){
              $cobres=$row['cobre'];
              $fibras=$row['fibra'];
              $hibris=$row['hibrida'];
              $tecnicas=$row['tecnica'];
              $vozs=$row['voz'];
              $psrs=$row['psr'];
            } 
            if($tipoins==1) {
              $cobres=$cobres+1;
              $sql="UPDATE cantidades SET 
              cobre='".$cobres."'
              WHERE usuario_idu='".$idus."'";
            }if($tipoins==2) {
              $fibras=$fibras+1;
              $sql="UPDATE cantidades SET 
              fibra='".$fibras."'
              WHERE usuario_idu='".$idus."'";
            }if($tipoins==3) {
              $hibris=$hibris+1;
              $sql="UPDATE cantidades SET 
              hibrida='".$hibris."'
              WHERE usuario_idu='".$idus."'";
            }if($tipoins==4) {
               $vozs=$vozs+1;
              $sql="UPDATE cantidades SET 
              voz='".$vozs."'
              WHERE usuario_idu='".$idus."'";
            }if($tipoins==5) {
              $psrs=$psrs+1;
              $sql="UPDATE cantidades SET 
              psr='".$psrs."'
              WHERE usuario_idu='".$idus."'";
            }if($tipoins==6) {
              $tecnicas=$tecnicas+1;
              $sql="UPDATE cantidades SET 
              tecnica='".$tecnicas."'
              WHERE usuario_idu='".$idus."'";
            }
            //mysqli_query($con,$sql);  
            execute($sql) or die (mysqli_error($con));
          //echo $cobres."<br>".$fibras."<br>".$hibris."<br>".$tecnicas."<br>".$vozs."<br>".$psrs;
    /**=============================================================================================*/
    
    $error=strtoupper($_POST['error']);
    $tiperror=strtoupper($_POST['tiperror']);
    $observ=strtoupper($_POST['observ']);
    $estpc=strtoupper($_POST['estpc']);
    $estpfo=strtoupper($_POST['estpfo']);
    $id_osdata=$idoda;
    $idoos=0;
    $con->real_query("SELECT * FROM other_os ORDER BY id_otheros");
          $resultado = $con->use_result();
      while ($row = $resultado->fetch_assoc()){
        $idoos=$row['id_otheros'];
      }  $idoos=$idoos+1;

    $sql="INSERT INTO other_os (
          id_otheros,erroros,tipificacion_erroros,
          observa_os,st_pagocob,st_pagofo,
          id_osdata)
          VALUES
          ('".$idoos."','".$error."','".$tiperror."',
            '".$observ."','".$estpc."','".$estpfo."',
            '".$id_osdata."')"; 
          execute($sql) or die (mysqli_error($con)); 
          
    /**=============================================================================================*/
    
    $idus=$_POST['us'];
    $revisado=0;
    $idchek=0;
    $user=0;
    $con->real_query("SELECT * FROM checklist ORDER BY idchek");
          $resultado = $con->use_result();
      while ($row = $resultado->fetch_assoc()){
        $idchek=$row['idchek'];
      }  $idchek=$idchek+1;
    $sql="INSERT INTO checklist (
          idchek,idors,idus,revisado)
          VALUES
          ('".$idchek."','".$idos."','".$user."','".$revisado."')"; 
          execute($sql) or die (mysqli_error($con)); 
          
    /**=============================================================================================*/
   

     echo "
          <script>
              alert('REGISTRO EXITOSO!');
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