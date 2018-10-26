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

function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$vacacion_in=$_POST['vacacion_in'];
$vacacion_end=$_POST['vacacion_end'];
$cubre=$_POST['cubre'];
$tipo_pago=$_POST['tipo_pago'];

$iduser=$_POST['iduser'];
$tipo=$_POST['tipo'];
$pssw=$_POST['pssw'];
$nombre=strtoupper($_POST['name']);
$ap=strtoupper($_POST['ap']);
$am=strtoupper($_POST['am']);
$mail=$_POST['correo'];
$dateingreso=$_POST['dateingreso'];
$dateseguro=$_POST['dateseguro'];
$dir=strtoupper($_POST['dir']);
$ncuenta=$_POST['ncuenta'];
$cel=$_POST['celular'];
$tel=$_POST['tel'];
$estado_civil=strtoupper($_POST['estado_civil']);
$estatura=strtoupper($_POST['estatura']);
$licencia=strtoupper($_POST['licencia']);
$curp=strtoupper($_POST['curp']);
$rfc=strtoupper($_POST['rfc']);
echo $curp;
$tel_emerg=$_POST['tel_emerg'];
$tipo_personal=strtoupper($_POST['tipo_personal']);
/*
$nsup=strtoupper($_POST['namesuper']);
$apsup=strtoupper($_POST['apsuper']);
$amsup=strtoupper($_POST['amsuper']);
$fullnsuper=$nsup." ".$apsup." ".$amsup;
*/
$departamento=strtoupper($_POST['departamento']);
$hora_entrada=strtoupper($_POST['hora_entrada']);
$hora_salida=strtoupper($_POST['hora_salida']);
$tipo_contrato=strtoupper($_POST['tipo_contrato']);
$fecha_nacimiento=strtoupper($_POST['fecha_nacimiento']);
$nacionalidad=strtoupper($_POST['nacionalidad']);
$sexo=strtoupper($_POST['sexo']);
$peso=strtoupper($_POST['peso']);
$correo_alterno=$mail;
$nss=strtoupper($_POST['nss']);
$ife=strtoupper($_POST['ife']);
$rfc=strtoupper($_POST['rfc']);
$vig_licencia=strtoupper($_POST['vig_licencia']);
$salario=strtoupper($_POST['salario']);
if(isset($nombre) && isset($ap)&& isset($am)&& isset($pssw)&& isset($iduser))
{
  //echo $tipo."<br>".$mail."<br>".$nombre."<br>".$ap."<br>".$am."<br>".$pssw."<br>".$ncuenta."<br>".$cel."<br>";
  //echo $tel."<br>".$dateingreso."<br>".$dateseguro."<br>".$dir."<br>".$estado_civil."<br>".$estatura."<br>".$licencia."<br>";
  //echo $curp."<br>".$tel_emerg."<br>".$iduser."<br>";
  /*================================================================*/ 
  $con = Conectarse();
 $sql="UPDATE usuario SET 
    tipo_idtipo='".$tipo."', 
    correo='".$mail."',
    nombre='".$nombre."',
    apaterno='".$ap."',
    amaterno='".$am."',
    pssw='".$pssw."',
    nocuenta='".$ncuenta."',
    cel='".$cel."',
    tel='".$tel."',fecha_ingreso='".$dateingreso."',
    fecha_seguro='".$dateseguro."',direccion='".$dir."',
    estado_civil='".$estado_civil."',estatura='".$estatura."',
    licencia='".$licencia."',curp='".$curp."',rfc='".$rfc."',
    tel_emerg='".$tel_emerg."',tipo_personal='".$tipo_personal."'
    ,cubre='".$cubre."',vacaciones_in='".$vacacion_in."',vacaciones_end='".$vacacion_end."'
    ,tipo_pago='".$tipo_pago."'
    WHERE idu='".$iduser."'
  ";
    //mysqli_query($con,$sql);  
    //execute($sql) or die (mysqli_error($con));  
    if ($con->query($sql) === TRUE) { echo "New UPDATE created successfully on DATAOS<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
    echo $iduser;
/*================================================================*/
$con = Conectarse();
$sql="UPDATE infuser SET
    departamento='".$departamento."',
    hora_entrada='".$hora_entrada."',
    hora_salida='".$hora_salida."',
    tipo_contrato='".$tipo_contrato."',fecha_nacimiento='".$fecha_nacimiento."',
    nacionalidad='".$nacionalidad."',sexo= '".$sexo."',peso='".$peso."',
    correo_alterno= '".$correo_alterno."',nss='".$nss."',ife= '".$ife."',
    rfc='".$rfc."',vig_licencia= '".$vig_licencia."',salario= '".$salario."'
     WHERE usuario_iduu='".$iduser."'
     ";
    //execute($sql) or die (mysqli_error($con));   
  if ($con->query($sql) === TRUE) { echo "New UPDATE created successfully on DATAOS<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
/*================================================================*/
  echo "
    <script>
        alert('MODIFICACION EXITOSA!');
        document.location=(' in.php');
    </script>";  
    
    
  }else{
  echo "
    <script>
        alert('ERROR EN DATOS!');
        document.location=(' data.php');
    </script>"; 
    
  }  
?>