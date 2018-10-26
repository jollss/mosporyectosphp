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
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}

$idCall=strtoupper($_POST['ident']);
$respodnio=strtoupper($_POST['p_res']);
$servicio=strtoupper($_POST['servicio']);
$desc=strtoupper($_POST['descripcion']);
$id=0;
if(isset($respodnio) && isset($id))
{
   $con->real_query("SELECT id_cc FROM data_callcenter ORDER BY id_cc");
                  $resultado = $con->use_result();
    while ($row = $resultado->fetch_assoc()){
        $id=$row['id_cc'];
      }
      $id=$id+1;
      if($servicio=='SI'){$estado_call=1;}
      if($servicio=='NO'){$estado_call=1;}
      if($servicio=='NA'){$estado_call=2;}
      
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hh=date('G');
    $min=date('i');
    $semana = date("W");
    $hora=$hh.":".$min;

    $sql="UPDATE call_center SET 
    observaciones='".$desc."',
    estado_call='".$estado_call."'
    WHERE id_callc='".$idCall."'";
    execute($sql) or die (mysqli_error($con));
    
    $sql="UPDATE data_callcenter SET 
    dd='".$dia."',
    mm='".$mes."',
    aaaa='".$aaaa."',
    hora='".$hora."',
    p_atendio='".$respodnio."',
    servicio='".$servicio."',
    descri='".$desc."'
    WHERE call_center_id_calc='".$idCall."'";
    execute($sql) or die (mysqli_error($con));
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