<?php
include("../Config/library.php");
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$idventas=$_POST['idventa'];

$delarea=$_POST['delarea'];

$contesto=$_POST['contesto'];
//$nomcliente=$_POST['nomcliente'];
$nomatiende=$_POST['nomatiende'];
$servicio=$_POST['servicio'];
$paquete=$_POST['paquete'];
$direccion=$_POST['calle_num'];
$colonia=$_POST['colonia'];
$municipio=$_POST['municipio'];
$cp=$_POST['CP'];
$aprox=$_POST['aprox'];
$detalles=$_POST['detalles'];
$gastos_instalacion=$_POST['gastos_inst'];
$tiempo_instalacion=$_POST['aprox'];

  /*===============================================*/
  if(isset($idventas)&& isset($servicio))
  {
    /*
    $filder=new Filder();
    $filder->cambiarAtiende($idventas,$nomatiende,$con); 
    $filder->cambiarServicio($idventas,$servicio,$con); 
    $filder->cambiarPaquete($idventas,$paquete,$con); 
    $filder->cambiarDireccion($idventas,$direccion,$con); 
    $filder->cambiarColonia($idventas,$colonia,$con); 
    $filder->cambiarMunicipio($idventas,$municipio,$con); 
    $filder->cambiarCp($idventas,$cp,$con); 
    $filder->cambiarGastosIns($idventas,$gastos_instalacion,$con); 
    $filder->cambiarTiempoIns($idventas,$tiempo_instalacion,$con); 
    $filder->cambiarObs($idventas,$detalles,$con); 
    */
    $sql="UPDATE venta SET 
    atiende='$nomatiende',servicio='$servicio',paquete='$paquete',direccion_v='$direccion',
    colonia='$colonia',municipio='$municipio',cp='$cp',gastos_instalacion='$gastos_instalacion',
    tiempo_instalacion='$tiempo_instalacion',venta_validar_area='$delarea',
    contesto='$contesto',
    observaciones='$detalles'
    WHERE idventa='".$idventas."'";
if ($con->query($sql) === TRUE) { echo "Modificacion exitosa<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

    /*$id=$filder->obtenerId($con);
    $filder->ingresaFilder($id,$contesto,$iduser,$nomcliente,$nomatiende,$servicio,$paquete,
      $direccion,$colonia,$municipio,$cp,$gastos_instalacion,$tiempo_instalacion,$detalles,$idventas);
    $filder->registrarFilderBD($con);

    if($contesto=='SI'){
      $venta=new Ventas();
      $venta->cambiarEstatus($idventas,$con);
    }
    */
    
    echo "
      <script>
          alert('REGISTRADO!');
          document.location=('listadoVentas.php');
      </script>"; 
      
    }else{
      
    echo "
      <script>
          alert('ERROR EN DATOS!');
          document.location=('listadoVentas.php');
      </script>"; 
      
    } 
?>
