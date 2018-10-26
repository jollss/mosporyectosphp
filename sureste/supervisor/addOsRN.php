<?php
include("../Config/library.php"); 
$con = Conectarse();  
$estado=1;
$iduser=$_POST['user'];
$os=$_POST['os'];
$cope=strtoupper($_POST['cope']);
$expediente=strtoupper($_POST['expediente']);
$folio_pisa=strtoupper($_POST['foliopisa']);
$folio_pisaplex=strtoupper($_POST['foliopisaplex']);
$telefono=strtoupper($_POST['tel']);
$cliente=strtoupper($_POST['cliente']);
$tipo_tarea=strtoupper($_POST['tipo_tarea']);
$distrito=strtoupper($_POST['distrito']);
$zona=strtoupper($_POST['zona']);
$dilacion_etapa=strtoupper($_POST['dilacion_etapa']);
$dilacion=strtoupper($_POST['dilacion']);
$tipo_os=strtoupper($_POST['tipo_os']);
$idc=0;
      $id=0;
    //$es=$orden->existe($folio_pisa,$con);
    $con->real_query("SELECT * FROM os");
    $r = $con->use_result();
    while ($l = $r->fetch_assoc()){
        $id=$l['idmos'];
    } 
      $os=$id+1;
      $id=$id+1;
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
  $orden=new Os();
    $orden->ingresarOs($os,$cope,$expediente,$folio_pisa,$folio_pisaplex,
      $telefono,$cliente,$tipo_tarea,$tipo_tarea,$distrito,$zona,
      $dilacion_etapa,$dilacion,$idyo,$iduser);
  //$orden->registrarOsBD($con);
    $es=$orden->existe($folio_pisa,$con);
    //echo "ID:".$id;
    if($es==1){
        echo "
        <script>
            alert('ERROR EN DATOS, FOLIO PISA EXISTENTE!');
            document.location=('addOs.php');
        </script>"; 
    }else{
      if ($_SERVER['REQUEST_METHOD'] == 'POST')
      {
          require_once("multiupload.php");
          $files = $_FILES['userfile']['name'];
          $upload = new Multiupload();
          $isUpload = $upload->upFiles($files,$os);
          
      }else{
          throw new Exception("Error Processing Request", 1);
      } 
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
        $dataos=new Dataos();
          $total=$dataos->TotalDataosBD($con);
          //$dataos->ingresaDataos($total,$idyo,$iduser,'0','',$os,$isUpload,$tipo_os);
        //$dataos->registroDataosBD($con);
          $tos=0;
          date_default_timezone_set('America/Mexico_City');
          $dia=date('j');
          $mes=date('n');
          $aaaa=date('Y');
          $hora = date("g");
          $min = date("i");
          $horas=$hora.":".$min;
          
        $check=new Checklist();
          $idchek=$check->ultimoChecklist($con);
          $check->ingresaChecklist($idchek,$os,'0');
        $check->registroChecklistBD($con);

      echo "id de orden:".$id."<br>";
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hora = date("g");
    $min = date("i");
    
    $sql="INSERT INTO os (
      idmos,cope,expediente,
      ddcarga,mmcarga,yearcarga,folio_pisaplex,
      folio_pisa,telefono,cliente,
      tipo_tarea,tecnologia,distrito,zona,
      dilacion_etapa,dilacion,usuario_idu,pagados,asignado,estado_os)
      VALUES
      ('".$id."','".$cope."','".$expediente."',
       '".$dia."','".$mes."','".$aaaa."','".$folio_pisaplex."',
       '".$folio_pisa."','".$telefono."','".$cliente."',
       '".$tipo_tarea."','NA','".$distrito."','".$zona."',
       '".$dilacion_etapa."','".$dilacion."','".$idyo."','0','".$iduser."',
       '0'
       )";
      if ($con->query($sql) === TRUE) {
          echo "New record created successfully<br>";
      } else {
          //echo "Error: " . $sql . "<br>" . $conn->error;
        if (!mysqli_query($con, $sql)) {
            printf("Errormessage: %s\n", mysqli_error($con));
            echo "<br>";
        }
      }
      
      $orden->asignarOs($iduser,$os,$con);
      $tos=0;
      $con->real_query("SELECT * FROM dataos");
      $resultado = $con->use_result();
      while ($row = $resultado->fetch_assoc()){
          $tos=$row['iddataos'];
      }
      $tos=$tos+1;
      
       $sql="INSERT INTO dataos (
          iddataos,supervisor_idu,tecnico_asignado_idu,
          estatus,observaciones,
          ddos,mmos,yearos,horaos,id_orden,file_os,ddasig,mmasig,yearasig,
          principal,secundario,claro_video,tipo_os,alfanumerico,serie)
          VALUES
          ('".$tos."','".$idyo."','".$iduser."',
            '0','',
            '".$dia."','".$mes."','".$aaaa."','".$horas."',
            '".$id."','".$isUpload."',
            '".$dia."','".$mes."','".$aaaa."',
            '','','','".$tipo_os."','',''
            )"; 
      if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
      //echo "id de dataos:".$tos." para la orden ".$id."<br>";
    }
  
      
    echo "
    <script>
        alert('REGISTRO CORRECTO!');
        document.location=('addOs.php');
   </script>";
  
}else{
  
  echo "
  <script>
      alert('ERROR EN DATOS!');
      document.location=('addOs.php');
  </script>"; 

}  
?>