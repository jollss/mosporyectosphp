<?php
include("../Config/library.php"); 
$con = Conectarse(); 
/*===============================================*/
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require_once("multiupload.php");
    $files = $_FILES['userfile']['name'];
    $upload = new Multiupload();
    $isUpload = $upload->upFiles($files);
}else{
    throw new Exception("Error Processing Request", 1);
} 
/*===============================================*/
$activo=1;
$tipo=$_POST['tipo'];
$checador=$_POST['checador'];
$pssw=md5($_POST['pssw']);
$nombre=strtoupper($_POST['name']);
$ap=strtoupper($_POST['ap']);
$am=strtoupper($_POST['am']);
$mail=$_POST['correo'];
$dateingreso=$_POST['dateingreso'];
$dateseguro=$_POST['dateseguro'];
$dir=$_POST['dir'];
$ncuenta=$_POST['ncuenta'];
$cel=$_POST['celular'];
$tel=$_POST['tel'];
$estado_civil=strtoupper($_POST['estado_civil']);
$estatura=strtoupper($_POST['estatura']);
$licencia=strtoupper($_POST['licencia']);
$curp=strtoupper($_POST['curp']);
$tel_emerg=$_POST['tel_emerg'];
/*
=======================
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
$tipo_personal=strtoupper($_POST['tipo_personal']);
if(isset($nombre) && isset($ap)&& isset($am)&& isset($pssw)&& isset($activo)
  && isset($tipo)&& isset($mail))
{
  $UsuarioR=new Usuario();
  $UsuarioR->obtenerIdu($con);
  $id= $UsuarioR->regresaIdu();  
  $NuevoUsuario=new Infuser();
  $idinfo=$NuevoUsuario->obtenerIdInfuser($con);
  $NuevoUsuario->ingresarUsuario($id,$mail,$nombre,$ap,$am,
    $pssw,$ncuenta,$cel,$tel,$dateingreso,$dateseguro,$dir,
    $estado_civil,$estatura,$licencia,$curp,$tel_emerg,$checador,
    $tipo_personal,$tipo);
  $NuevoUsuario->ingresarInfuser($departamento,$hora_entrada,$hora_salida,$tipo_contrato,
    $fecha_nacimiento,$nacionalidad,$sexo,$peso,
    $correo_alterno,$nss,$ife,$rfc,$vig_licencia,
    $salario,$id);
  //$NuevoUsuario->verInfuser();
  //$NuevoUsuario->verUsuario();
  $NuevoUsuario->registrarUsuarioBD($con);
  $NuevoUsuario->registrarInfouserBD($con);
  $Cantidades=new Cantidades();
  $Cantidades->crear($id);
  $Cantidades->registrarCantidadesBD($con);
 echo "
    <script>
        alert('REGISTRO EXITOSO!');
        document.location=('ruserF.php');
    </script>";   

  }else{
    
  echo "
    <script>
        alert('ERROR EN DATOS!');
        document.location=('ruserF.php');
    </script>";    
  }  
?>