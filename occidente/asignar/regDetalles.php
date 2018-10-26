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
  $cnx = Conectarse(); 
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');  
$orden=$_POST['os_idorden'];
$estado=$_POST['estado'];
$modem=$_POST['modem'];
$rosetas=$_POST['rosetas'];
$metraje=$_POST['metraje'];
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$aux=0;
$id=0;
$cnx->real_query("SELECT * FROM adjunto_os WHERE os_idos = '$orden'");
            $result = $cnx->use_result();
            while ($line = $result->fetch_assoc()){
              $aux=$aux+1;
              /*if($line['nombreimg']){
                  echo "
                  <script>
                      alert('ERROR EN DATOS!');
                      document.location=(' dataosuall.php');
                  </script>";  
              }*/
            }
if($aux==0){
  echo "
  <script>
      alert('FALTAN IMAGENES!');
      document.location=(' dataosuall.php');
  </script>"; 
}else{
  /*===============================================*/
  $detalles=strtoupper($_POST['detalles']);
  if(isset($orden) && isset($estado)&& isset($detalles))
  {
     $con->real_query("SELECT idtd FROM tecnico_detalle ORDER BY idtd");
                    $resultado = $con->use_result();
  while ($row = $resultado->fetch_assoc()){
  $id=$row['idtd'];
  }
  $id=$id+1;
$fecha_c=$dia."/".$mes."/".$aaaa;
   $sql="INSERT INTO tecnico_detalle (
      idtd,os_idorden,estado,detalles_orden,fecha_cierre)
      VALUES
      ('".$id."','".$orden."','".$estado."','".$detalles."','".$fecha_c."'
       )";
      execute($sql) or die (mysqli_error($con));

  $id=0;
   $con->real_query("SELECT idmaterial FROM material ORDER BY idmaterial");
                    $resultado = $con->use_result();
  while ($row = $resultado->fetch_assoc()){
  $id=$row['idmaterial'];
  }
  $id=$id+1;

   $sql="INSERT INTO material (
      idmaterial,metraje,rosetas,modem,idordens)
      VALUES
      ('".$id."','".$metraje."','".$rosetas."','".$modem."','".$orden."')";
      execute($sql) or die (mysqli_error($con)); 
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