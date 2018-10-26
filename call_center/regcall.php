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


$cope=strtoupper($_POST['cope']);
$expediente=strtoupper($_POST['expediente']);
$telefono=strtoupper($_POST['telefono']);
$nombre_cli=strtoupper($_POST['nombre_cli']);
$distrito=strtoupper($_POST['distrito']);
$calle=strtoupper($_POST['calle']);
$numero=$_POST['numero'];
$num_interior=$_POST['num_interior'];
$sub_interior=$_POST['sub_numero'];
$colonia=strtoupper($_POST['colonia']);
$supervisor=strtoupper($_POST['supervisor']);
$estatus=strtoupper($_POST['estatus']);
$observaciones=strtoupper($_POST['observaciones']);
$tecnico=strtoupper($_POST['tecnico']);
$estado_call=3;
$aux=0;
if(isset($nombre_cli) && isset($telefono))
{
   $con->real_query("SELECT id_callc FROM call_center ORDER BY id_callc");
                  $resultado = $con->use_result();
    while ($row = $resultado->fetch_assoc()){
        $id=$row['id_callc'];
      }
      $id=$id+1;
    
    $con->real_query("SELECT * FROM call_center ORDER BY distrito");
                      $resultado = $con->use_result();
    while ($row = $resultado->fetch_assoc()){
      $anteriord=$row['distrito'];
        if($distrito==$anteriord) 
        {
            $con2->real_query("SELECT consecutivo FROM call_center WHERE distrito='$anteriord' ORDER BY consecutivo");
                      $r = $con2->use_result();
            while ($l = $r->fetch_assoc()){
                $idc=$l['consecutivo'];
            }
            $aux=$idc+1;   
        }else{
          $idc=1;
        }
    }
      if($aux>1){

      $sql="INSERT INTO call_center (
                id_callc,consecutivo,cope,expediente,
                telefono,nombre_cli,distrito,calle,
                numero,num_interior,sub_numero,colonia,supervisor,estatus,observaciones,tecnico,estado_call)
                VALUES
                ('".$id."','".$aux."','".$cope."','".$expediente."',
                 '".$telefono."','".$nombre_cli."','".$distrito."','".$calle."',
                 '".$numero."','".$num_interior."','".$sub_interior."','".$colonia."','".$supervisor."',
                 '".$estatus."','".$observaciones."','".$tecnico."','".$estado_call."'
                 )";
                execute($sql) or die (mysqli_error($con));
      }else{

                 
      $sql="INSERT INTO call_center (
                id_callc,consecutivo,cope,expediente,
                telefono,nombre_cli,distrito,calle,
                numero,num_interior,sub_numero,colonia,supervisor,estatus,observaciones,tecnico,estado_call)
                VALUES
                ('".$id."','".$idc."','".$cope."','".$expediente."',
                 '".$telefono."','".$nombre_cli."','".$distrito."','".$calle."',
                 '".$numero."','".$num_interior."','".$sub_interior."','".$colonia."','".$supervisor."',
                 '".$estatus."','".$observaciones."','".$tecnico."','".$estado_call."'
                 )";
                execute($sql) or die (mysqli_error($con));
                echo "error";
      }

       echo "
          <script>
              alert('REGISTRO EXITOSO!');
              document.location=('regCallF.php');
          </script>";      
  }else{
  
  echo "
    <script>
        alert('ERROR EN DATOS!');
        document.location=('regCallF.php');
    </script>"; 
  
  }  
?>