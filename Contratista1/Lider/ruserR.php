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
  $cnxe = Conectarse();

function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$cnxe->real_query("SELECT * FROM usuario WHERE correo = '$mail'");
$result = $cnxe->use_result();
while ($line = $result->fetch_assoc()){
    $iduser=$line['idu'];
}
$idreclutamiento=$iduser;
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
/*===============================================*/
$tipo=$_POST['tipo'];
$edad=$_POST['edad'];
$nombre=strtoupper($_POST['name']);
$ap=strtoupper($_POST['ap']);
$am=strtoupper($_POST['am']);
$tel=$_POST['tel'];
$sexo=$_POST['sexo'];
$mail=$_POST['correo'];
$fecha=$dia."/".$mes."/".$aaaa;
$dir=strtoupper($_POST['dir']);
if(isset($nombre) && isset($ap)&& isset($am)&& isset($tel)&& isset($dir)
  && isset($edad)&& isset($mail))
{
   $con->real_query("SELECT idreclutamiento FROM reclutamiento ORDER BY idreclutamiento");
                  $resultado = $con->use_result();
    while ($row = $resultado->fetch_assoc()){
    $id=$row['idreclutamiento'];
    }
    $id=$id+1;
    $aux=0;
     $con->real_query("SELECT * FROM reclutamiento WHERE nombre='$nombre' AND apepaterno='$ap' AND apematerno='$am'");
                      $resultado = $con->use_result();
    while ($row = $resultado->fetch_assoc()){
    $aux=1;
    }
    if($aux==1)
    {
      echo "
        <script>
            alert('PERSONA YA EXISTENTE!');
            document.location=('inde.php');
        </script>"; 
    }else{
         $sql="INSERT INTO reclutamiento (
            idreclutamiento,nombre,apepaterno,apematerno,
            rtelefono,redad,rdir,rsexo,
            rfase,rfecha,id_reclutar)
            VALUES
            ('".$id."','".$nombre."','".$ap."','".$am."',
             '".$tel."','".$edad."','".$dir."','".$sexo."',
             '".$tipo."','".$fecha."','".$idreclutamiento."'
             )";
            execute($sql) or die (mysqli_error($con));  
         echo "
            <script>
                alert('REGISTRO EXITOSO!');
                document.location=('inde.php');
            </script>"; 
        }    
}else{
  echo "
  <script>
      alert('ERROR EN DATOS!');
      document.location=('inde.php');
  </script>"; 
}
?>