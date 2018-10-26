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
$pssw="202cb962ac59075b964b07152d234b70";//md5($_POST['pssw']);
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
//$rfc=strtoupper($_POST['rfc']);
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
$tipo_pago=strtoupper($_POST['tipo_pago']);
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
  $existe=$UsuarioR->existeUsuario($mail,$con);
  $existeN=$UsuarioR->existeNombreUsuario($nombre,$ap,$am,$con);
    if($existeN==1){
      echo "
      <script>
          alert('NOMBRE Y APELLIDOS YA EXISTENTES!');
          document.location=('ruserF.php');
      </script>";
    }if($existeN==0){
        if($existe==1){
            echo "
              <script>
                  alert('CORREO MOS YA EXISTENTE!');
                  document.location=('ruserF.php');
              </script>";
        }if($existe==0){
          echo "-----------------------------------------1111";
          $sql1="SELECT * FROM usuario ORDER BY idu";
          $resultado=$con->query($sql1);
          while($row = $resultado->fetch_assoc())
          {
            $idu=$row['idu'];
          }
          $idu=$idu+1;
            $NuevoUsuario=new Infuser();
            $idinfo=$NuevoUsuario->obtenerIdInfuser($con);
            $NuevoUsuario->ingresarUsuario($idu,$mail,$nombre,$ap,$am,
              $pssw,$ncuenta,$cel,$tel,$dateingreso,$dateseguro,$dir,
              $estado_civil,$estatura,$licencia,$curp,$tel_emerg,$checador,
              $tipo_personal,$tipo);
            $NuevoUsuario->ingresarInfuser($departamento,$hora_entrada,$hora_salida,$tipo_contrato,
              $fecha_nacimiento,$nacionalidad,$sexo,$peso,
              $correo_alterno,$nss,$ife,$rfc,$vig_licencia,
              $salario,$idu);
            //$NuevoUsuario->verInfuser();
            //$NuevoUsuario->verUsuario();
            $NuevoUsuario->registrarUsuarioBD($con);
            echo "-----------------------------------------2222";
            $NuevoUsuario->registrarInfouserBD($con);
            echo "-----------------------------------------3333";
            $Cantidades=new Cantidades();
            $Cantidades->crear($idu);
            $Cantidades->registrarCantidadesBD($con);
            echo "-----------------------------------------4444";
            $pssw="202cb962ac59075b964b07152d234b70";//md5($_POST['pssw']);
            $sql="UPDATE usuario SET 
            id_zona=1,rfc='$rfc',tipo_pago='$tipo_pago',pssw='$pssw'
            WHERE idu='".$idu."'";
            if ($con->query($sql) === TRUE) { echo "Zona correcta<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
           echo "
              <script>
                  alert('REGISTRO EXITOSO!');
                  document.location=('ruserF.php');
              </script>"; 
        } 
    } 
  }else{
    
  echo "
    <script>
        alert('ERROR EN DATOS!');
        document.location=('ruserF.php');
    </script>";    
  }  
?>