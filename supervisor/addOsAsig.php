<?php
include("../Config/library.php"); 
$con = Conectarse();  
$estado=1;
$iduser=$_POST['user'];
$os=$_POST['os'];
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
    $isUpload = $upload->upFiles($files,$os);
    
}else{
    throw new Exception("Error Processing Request", 1);
} 
  //$cope=strtoupper($_POST['cope']);
  //$central=strtoupper($_POST['central']);
  $tipo_os=strtoupper($_POST['tipo_os']);
  $ter_optica='';
  $puerto='';
  $s_onta='';
  $principal='';
  $secundario='';
  $claro_video='';
  $cantidad=new Cantidades();
  $cantidad->obtenerCantidadesBD($iduser,$con);
  $cobre=$cantidad->regresaCobre();
  $fibra=$cantidad->regresaFibra();
  $hibrida=$cantidad->regresaHibrida();
  $psr=$cantidad->regresaPsr();
  $voz=$cantidad->regresaVoz();
  $tecnica=$cantidad->regresaTecnica();

  $cantidad->actualizaCantidadesBD($tipo_os,$iduser,$con);
  /*
    $con->real_query("SELECT * FROM dataos ORDER BY iddataos");
    $resultado = $con->use_result();
    while ($row = $resultado->fetch_assoc()){
        $idc=$row['iddataos'];
    }  
    if($tipo_os=='COBRE'){
      $sql="UPDATE cantidades SET 
        cobre=cobre+1
        WHERE usuario_idu='".$iduser."'";
        execute($sql) or die (mysqli_error($con));
    }
    if($tipo_os=='FIBRA'){
      $sql="UPDATE cantidades SET 
        fibra=fibra+1
        WHERE usuario_idu='".$iduser."'";
        execute($sql) or die (mysqli_error($con));
    }
    if($tipo_os=='HIBRIDA'){
      $sql="UPDATE cantidades SET 
        hibrida=hibrida+1
        WHERE usuario_idu='".$iduser."'";
        execute($sql) or die (mysqli_error($con));
    }
    if($tipo_os=='VOZ'){
      $sql="UPDATE cantidades SET 
        voz=voz+1
        WHERE usuario_idu='".$iduser."'";
        execute($sql) or die (mysqli_error($con));
    }
    if($tipo_os=='PSR'){
      $sql="UPDATE cantidades SET 
        psr=psr+1
        WHERE usuario_idu='".$iduser."'";
        execute($sql) or die (mysqli_error($con));
    }
    if($tipo_os=='TECNICA'){
      $sql="UPDATE cantidades SET 
        tecnica=tecnica+1
        WHERE usuario_idu='".$iduser."'";
        execute($sql) or die (mysqli_error($con));
    }
    */
    //echo "crear==<br>";
    $dataos=new Dataos();
    //echo "total==<br>";
    $total=$dataos->TotalDataosBD($con);
    //echo "ingresa==<br>";
    $dataos->ingresaDataos($total,$idyo,$iduser,'0','',$os,$isUpload,$tipo_os);
    //$dataos->ingresaDataos($total,$idyo,$iduser,'0','',$os,$isUpload,$tipo_os);
    //echo "($total,$idyo,$iduser,'0','',$os,$isUpload,$tipo_os)";
    //echo "registroDataosBD==<br>";
    
    $dataos->registroDataosBD($con);
    /*
    $check=new Checklist();
    
    $idchek=$check->ultimoChecklist($con);
    
    $check->ingresaChecklist($idchek,$os,'0');
    
    $check->registroChecklistBD($con);
    */
    $orden=new Os();
    //echo "($iduser,$os)";
    $orden->asignarOs($iduser,$os,$con);
    

    echo "
    <script language='javascript'> 
        alert('MODIFICACION EXITOSA!');
        document.location=('addOs.php');
    </script>";
      
}else{
  ?>
  
  <script language='JavaScript'> 
      alert('ERROR EN DATOS!');
      document.location=('addOs.php');
  </script>
  
  <?php
}  
?>